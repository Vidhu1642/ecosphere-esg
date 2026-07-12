<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EcoSphere ESG') }}</title>
    <style>
        :root { --ink:#17211b; --muted:#68756d; --line:#dfe7e2; --panel:#ffffff; --bg:#f5f8f2; --green:#1f7a4d; --blue:#245c8f; --gold:#a56912; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: Arial, Helvetica, sans-serif; color:var(--ink); background:var(--bg); }
        a { color:inherit; text-decoration:none; }
        .shell { display:grid; grid-template-columns:260px 1fr; min-height:100vh; }
        aside { background:#10251b; color:#eef7f0; padding:22px; position:sticky; top:0; height:100vh; overflow:auto; }
        .brand { font-size:22px; font-weight:700; margin-bottom:22px; }
        .nav-title { color:#9fb5a8; font-size:12px; text-transform:uppercase; margin:20px 0 8px; }
        .nav a, .logout { display:block; width:100%; padding:9px 10px; border-radius:6px; color:#eef7f0; background:transparent; border:0; text-align:left; font:inherit; cursor:pointer; }
        .nav a:hover, .logout:hover { background:#1d3a2c; }
        main { padding:26px; }
        .topbar { display:flex; justify-content:space-between; gap:16px; align-items:center; margin-bottom:22px; }
        h1 { margin:0; font-size:28px; }
        h2 { margin:0 0 14px; font-size:18px; }
        .muted { color:var(--muted); }
        .grid { display:grid; gap:16px; }
        .cards { grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); }
        .three { grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }
        .card, .panel { background:var(--panel); border:1px solid var(--line); border-radius:8px; padding:16px; }
        .metric { font-size:26px; font-weight:700; margin-top:8px; }
        .two { grid-template-columns: minmax(0, 1.2fr) minmax(280px, .8fr); }
        table { width:100%; border-collapse:collapse; background:white; border:1px solid var(--line); border-radius:8px; overflow:hidden; }
        th, td { text-align:left; border-bottom:1px solid var(--line); padding:10px; font-size:14px; vertical-align:top; }
        th { background:#edf3ef; color:#3d5145; }
        label { display:block; font-size:13px; font-weight:700; margin-bottom:6px; }
        input, select, textarea { width:100%; padding:9px 10px; border:1px solid #cdd8d1; border-radius:6px; background:white; }
        textarea { min-height:78px; }
        .form-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap:12px; align-items:end; }
        button, .button { display:inline-block; border:0; border-radius:6px; background:var(--green); color:white; padding:10px 14px; font-weight:700; cursor:pointer; }
        .button.secondary { background:var(--blue); }
        .button.gold { background:var(--gold); }
        .alert { background:#e8f5ec; border:1px solid #b8dfc3; color:#235d38; padding:10px 12px; border-radius:6px; margin-bottom:16px; }
        .auth { min-height:100vh; display:grid; place-items:center; padding:22px; }
        .auth-card { width:min(460px, 100%); background:white; border:1px solid var(--line); border-radius:8px; padding:24px; }
        .actions { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        @media (max-width: 900px) { .shell { grid-template-columns:1fr; } aside { position:relative; height:auto; } .two { grid-template-columns:1fr; } }
    </style>
</head>
<body>
@auth
    <div class="shell">
        <aside>
            <div class="brand">EcoSphere ESG</div>
            <div class="nav">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <div class="nav-title">Master Configuration</div>
                @foreach(['departments','categories','emission-factors','products','environmental-goals','policies','challenges','csr-activities'] as $item)
                    <a href="{{ route('modules.index', $item) }}">{{ Str::headline($item) }}</a>
                @endforeach
                <div class="nav-title">Daily Operations</div>
                @foreach(['purchases','manufacturing','expenses','fleet'] as $item)
                    <a href="{{ route('modules.index', $item) }}">{{ Str::headline($item) }}</a>
                @endforeach
                <div class="nav-title">People & Governance</div>
                <a href="{{ route('activities.index') }}">Employee Activities</a>
                <a href="{{ route('modules.index', 'audits') }}">Audits</a>
                <a href="{{ route('modules.index', 'compliance-issues') }}">Compliance Issues</a>
                <div class="nav-title">Reports</div>
                @foreach(['environmental','social','governance','summary'] as $report)
                    <a href="{{ route('reports.download', $report) }}">{{ Str::headline($report) }} CSV</a>
                @endforeach
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="logout">Logout</button></form>
            </div>
        </aside>
        <main>
            <div class="topbar">
                <div>
                    <h1>@yield('title', 'Dashboard')</h1>
                    <div class="muted">{{ auth()->user()->name }} · {{ Str::headline(auth()->user()->role) }}</div>
                </div>
                <form method="POST" action="{{ route('scores.recalculate') }}">@csrf<button type="submit">Recalculate ESG</button></form>
            </div>
            @if(session('status'))<div class="alert">{{ session('status') }}</div>@endif
            @yield('content')
        </main>
    </div>
@else
    @yield('content')
@endauth
</body>
</html>
