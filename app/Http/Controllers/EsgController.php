<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EsgController extends Controller
{
    private array $modules = [
        'departments' => ['title' => 'Departments', 'table' => 'departments', 'fields' => ['department_name', 'code', 'head', 'parent_department_id', 'employee_count', 'status']],
        'categories' => ['title' => 'Categories', 'table' => 'categories', 'fields' => ['name', 'type', 'status']],
        'emission-factors' => ['title' => 'Emission Factors', 'table' => 'emission_factors', 'fields' => ['source', 'unit', 'factor', 'status']],
        'products' => ['title' => 'Products', 'table' => 'products', 'fields' => ['name', 'category', 'co2_factor', 'description', 'status']],
        'environmental-goals' => ['title' => 'Environmental Goals', 'table' => 'environmental_goals', 'fields' => ['title', 'target', 'deadline', 'status']],
        'policies' => ['title' => 'Policies', 'table' => 'policies', 'fields' => ['title', 'description', 'pdf', 'status']],
        'challenges' => ['title' => 'Challenges', 'table' => 'challenges', 'fields' => ['title', 'category', 'xp', 'difficulty', 'deadline', 'status']],
        'csr-activities' => ['title' => 'CSR Activities', 'table' => 'csr_activities', 'fields' => ['title', 'category', 'points', 'activity_date', 'status']],
        'purchases' => ['title' => 'Purchase Entry', 'table' => 'purchases', 'fields' => ['department_id', 'supplier', 'product_id', 'quantity', 'entry_date']],
        'manufacturing' => ['title' => 'Manufacturing Entry', 'table' => 'manufacturing_entries', 'fields' => ['department_id', 'product_id', 'units_produced', 'electricity_used', 'fuel_used', 'entry_date']],
        'expenses' => ['title' => 'Expense Entry', 'table' => 'expense_entries', 'fields' => ['department_id', 'expense_type', 'amount', 'entry_date']],
        'fleet' => ['title' => 'Fleet Entry', 'table' => 'fleet_entries', 'fields' => ['department_id', 'vehicle', 'fuel_used', 'distance', 'driver', 'entry_date']],
        'audits' => ['title' => 'Audits', 'table' => 'audits', 'fields' => ['department_id', 'title', 'findings', 'score', 'audit_date', 'status']],
        'compliance-issues' => ['title' => 'Compliance Issues', 'table' => 'compliance_issues', 'fields' => ['department_id', 'audit_id', 'title', 'severity', 'status']],
    ];

    public function dashboard(): View
    {
        $scores = DB::table('department_scores')
            ->join('departments', 'departments.id', '=', 'department_scores.department_id')
            ->select('department_scores.*', 'departments.department_name')
            ->latest('score_date')
            ->limit(8)
            ->get();

        return view('dashboard', [
            'cards' => [
                'Departments' => DB::table('departments')->count(),
                'Employees' => DB::table('users')->where('role', 'employee')->count(),
                'Carbon Emission' => round((float) DB::table('carbon_transactions')->sum('co2_emission'), 2).' kg CO2',
                'CSR Activities' => DB::table('csr_activities')->count(),
                'Challenges' => DB::table('challenges')->count(),
                'Audits' => DB::table('audits')->count(),
                'Compliance Issues' => DB::table('compliance_issues')->where('status', 'open')->count(),
            ],
            'scores' => $scores,
            'carbonTrend' => DB::table('carbon_transactions')
                ->selectRaw('DATE_FORMAT(transaction_date, "%Y-%m") as month, SUM(co2_emission) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->limit(6)
                ->get(),
            'leaderboard' => DB::table('employee_activities')
                ->join('users', 'users.id', '=', 'employee_activities.user_id')
                ->select('users.name', DB::raw('SUM(points) as points'))
                ->where('employee_activities.status', 'approved')
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('points')
                ->limit(5)
                ->get(),
        ]);
    }

    public function index(string $module): View
    {
        $config = $this->config($module);

        return view('modules.index', [
            'module' => $module,
            'config' => $config,
            'rows' => DB::table($config['table'])->latest()->paginate(10),
            'options' => $this->options(),
        ]);
    }

    public function store(Request $request, string $module): RedirectResponse
    {
        $config = $this->config($module);
        $data = $request->only($config['fields']);
        $data = array_map(fn ($value) => $value === '' ? null : $value, $data);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $id = DB::table($config['table'])->insertGetId($data);

        if (in_array($module, ['purchases', 'manufacturing', 'expenses', 'fleet'], true)) {
            $this->createCarbonTransaction($module, $id, $data);
        }

        if (in_array($module, ['audits', 'compliance-issues'], true)) {
            $this->recalculateDepartmentScore((int) $data['department_id']);
        }

        return back()->with('status', $config['title'].' saved.');
    }

    public function activities(): View
    {
        return view('activities.index', [
            'policies' => DB::table('policies')->where('status', 'active')->latest()->get(),
            'challenges' => DB::table('challenges')->where('status', 'active')->latest()->get(),
            'csrActivities' => DB::table('csr_activities')->where('status', 'active')->latest()->get(),
            'submissions' => DB::table('employee_activities')->join('users', 'users.id', '=', 'employee_activities.user_id')
                ->select('employee_activities.*', 'users.name as employee_name')
                ->latest('employee_activities.created_at')
                ->get(),
        ]);
    }

    public function joinActivity(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'activity_type' => ['required', 'in:policy,challenge,csr'],
            'activity_id' => ['required', 'integer'],
            'proof_url' => ['nullable', 'string', 'max:255'],
        ]);

        $source = match ($data['activity_type']) {
            'policy' => DB::table('policies')->find($data['activity_id']),
            'challenge' => DB::table('challenges')->find($data['activity_id']),
            default => DB::table('csr_activities')->find($data['activity_id']),
        };

        abort_unless($source, 404);

        $points = $data['activity_type'] === 'challenge' ? ($source->xp ?? 0) : ($source->points ?? 0);
        $status = $data['activity_type'] === 'policy' ? 'approved' : 'pending_approval';

        DB::table('employee_activities')->insert([
            'user_id' => Auth::id(),
            'department_id' => Auth::user()->department_id,
            'activity_type' => $data['activity_type'],
            'activity_id' => $data['activity_id'],
            'activity_title' => $source->title,
            'status' => $status,
            'proof_url' => $data['proof_url'] ?? null,
            'points' => $points,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (Auth::user()->department_id) {
            $this->recalculateDepartmentScore((int) Auth::user()->department_id);
        }

        return back()->with('status', 'Activity recorded.');
    }

    public function approveActivity(int $id): RedirectResponse
    {
        $activity = DB::table('employee_activities')->find($id);
        abort_unless($activity, 404);

        DB::table('employee_activities')->where('id', $id)->update(['status' => 'approved', 'updated_at' => now()]);

        if ($activity->department_id) {
            $this->recalculateDepartmentScore((int) $activity->department_id);
        }

        return back()->with('status', 'Activity approved.');
    }

    public function contact(): View
    {
        return view('static.contact');
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // In a real app, you would send an email or store this in the DB.
        // For now, just redirecting back with a success message.
        return back()->with('success', 'Thank you for your message. We will get back to you shortly.');
    }
       public function about(): View
    {
        return view('static.about');
    }
       public function mission(): View
    {
        return view('static.mission');
    }
           public function documentation(): View
    {
        return view('static.documentation');
    }
       public function EGreports(): View
    {
        return view('static.reports');
    }
     public function faq(): View
    {
        return view('static.faq');
    }
    public function userquide(): View
    {
        return view('static.userquide');
    }
    
    public function  privacy_policy(): View
    {
        return view('static.privacy-policy');
    }

      public function  terms(): View
    {
        return view('static.terms');
    }
 
      public function  data_protection(): View
    {
        return view('static.data-protection');
    }


    public function scores(): RedirectResponse
    {
        DB::table('departments')->pluck('id')->each(fn ($id) => $this->recalculateDepartmentScore((int) $id));

        return back()->with('status', 'ESG scores recalculated.');
    }

    public function reports(string $type): StreamedResponse
    {
        $allowed = ['environmental', 'social', 'governance', 'summary'];
        abort_unless(in_array($type, $allowed, true), 404);

        return response()->streamDownload(function () use ($type) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Department', 'Environmental', 'Social', 'Governance', 'Department Total', 'Overall', 'Date']);
            DB::table('department_scores')
                ->join('departments', 'departments.id', '=', 'department_scores.department_id')
                ->select('departments.department_name', 'department_scores.*')
                ->orderByDesc('score_date')
                ->get()
                ->each(fn ($row) => fputcsv($out, [
                    $row->department_name,
                    $row->environmental,
                    $row->social,
                    $row->governance,
                    $row->department_total,
                    $row->overall,
                    $row->score_date,
                ]));
            fclose($out);
        }, $type.'-esg-report.csv', ['Content-Type' => 'text/csv']);
    }

    private function createCarbonTransaction(string $module, int $id, array $data): void
    {
        [$sourceName, $quantity, $factor] = match ($module) {
            'purchases' => $this->purchaseCarbonInputs($data),
            'manufacturing' => ['Manufacturing electricity and fuel', ((float) $data['electricity_used']) + ((float) $data['fuel_used']), $this->factor('Electricity')],
            'expenses' => [$data['expense_type'], (float) $data['amount'], 0.02],
            'fleet' => ['Fleet fuel', (float) $data['fuel_used'], $this->factor('Diesel')],
        };

        DB::table('carbon_transactions')->insert([
            'department_id' => $data['department_id'],
            'source_type' => Str::studly($module),
            'source_id' => $id,
            'source_name' => $sourceName,
            'quantity' => $quantity,
            'emission_factor' => $factor,
            'co2_emission' => round($quantity * $factor, 2),
            'transaction_date' => $data['entry_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->recalculateDepartmentScore((int) $data['department_id']);
    }

    private function purchaseCarbonInputs(array $data): array
    {
        $product = DB::table('products')->find($data['product_id']);
        $factor = $product?->co2_factor ?: $this->factor($product?->name ?? 'Diesel');

        return [$product?->name ?? 'Purchase', (float) $data['quantity'], (float) $factor];
    }

    private function factor(string $source): float
    {
        return (float) (DB::table('emission_factors')->where('source', $source)->value('factor') ?? 1);
    }

    private function recalculateDepartmentScore(int $departmentId): void
    {
        $carbon = (float) DB::table('carbon_transactions')->where('department_id', $departmentId)->sum('co2_emission');
        $goalBonus = DB::table('environmental_goals')->where('status', 'completed')->count() * 2;
        $environmental = max(0, min(100, 100 - ($carbon / 100) + $goalBonus));

        $socialPoints = (int) DB::table('employee_activities')->where('department_id', $departmentId)->where('status', 'approved')->sum('points');
        $social = max(0, min(100, 50 + ($socialPoints / 10)));

        $auditAverage = (float) DB::table('audits')->where('department_id', $departmentId)->avg('score');
        $openIssues = DB::table('compliance_issues')->where('department_id', $departmentId)->where('status', 'open')->count();
        $policyAccepted = DB::table('employee_activities')->where('department_id', $departmentId)->where('activity_type', 'policy')->where('status', 'approved')->count();
        $governance = max(0, min(100, ($auditAverage ?: 75) + min(10, $policyAccepted) - ($openIssues * 5)));

        $overall = ($environmental * 0.4) + ($social * 0.3) + ($governance * 0.3);

        DB::table('department_scores')->insert([
            'department_id' => $departmentId,
            'environmental' => round($environmental, 2),
            'social' => round($social, 2),
            'governance' => round($governance, 2),
            'department_total' => round($environmental + $social + $governance, 2),
            'overall' => round($overall, 2),
            'score_date' => today(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function config(string $module): array
    {
        abort_unless(isset($this->modules[$module]), 404);

        return $this->modules[$module];
    }

    private function options(): array
    {
        return [
            'departments' => DB::table('departments')->orderBy('department_name')->get(),
            'products' => DB::table('products')->orderBy('name')->get(),
            'audits' => DB::table('audits')->orderByDesc('audit_date')->get(),
        ];
    }
}
