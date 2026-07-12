@extends('layouts.app')

@section('title', 'ESG Dashboard')

@section('content')

<style>
    /* Local dashboard styling to keep things unique without touching the global layout */
    .dash-hero {
        display:flex;
        justify-content:space-between;
        align-items:flex-end;
        gap:16px;
        margin-bottom:18px;
    }
    .dash-hero .subtitle { color:var(--muted); font-size:14px; margin-top:6px; }
    .dash-badge {
        background:#10251b;
        color:#eef7f0;
        border:1px solid #1d3a2c;
        border-radius:999px;
        padding:8px 12px;
        font-weight:700;
        font-size:12px;
        white-space:nowrap;
    }
    .dash-card {
        position:relative;
        overflow:hidden;
    }
    .dash-card::after{
        content:"";
        position:absolute;
        inset:-40px -60px auto auto;
        width:160px;
        height:160px;
        background:rgba(31,122,74,.10);
        transform:rotate(18deg);
        border-radius:28px;
        transition: background .2s ease;
    }

    /* KPI accent colors */
    .kpi-accent{ position:relative; z-index:1; }
    .kpi-accent .kpi-title{ font-weight:800; font-size:12px; text-transform:uppercase; letter-spacing:.06em; }

    .accent-departments{ --accent:#28a745; --accent-soft: rgba(40,167,69,.12); --accent-line: rgba(40,167,69,1); }
    .accent-employees{ --accent:#1e73ff; --accent-soft: rgba(30,115,255,.12); --accent-line: rgba(30,115,255,1); }
    .accent-carbon{ --accent:#f5a623; --accent-soft: rgba(245,166,35,.14); --accent-line: rgba(245,166,35,1); }
    .accent-csr{ --accent:#7c3aed; --accent-soft: rgba(124,58,237,.13); --accent-line: rgba(124,58,237,1); }
    .accent-challenges{ --accent:#f1c40f; --accent-soft: rgba(241,196,15,.14); --accent-line: rgba(241,196,15,1); }
    .accent-compliance{ --accent:#e11d48; --accent-soft: rgba(225,29,72,.14); --accent-line: rgba(225,29,72,1); }

    .kpi-accent.accent-departments .metric,
    .kpi-accent.accent-employees .metric,
    .kpi-accent.accent-carbon .metric,
    .kpi-accent.accent-csr .metric,
    .kpi-accent.accent-challenges .metric,
    .kpi-accent.accent-compliance .metric{ color: var(--accent); }

.kpi-accent.accent-departments .sparkline::before,
    .kpi-accent.accent-employees .sparkline::before,
    .kpi-accent.accent-carbon .sparkline::before,
    .kpi-accent.accent-csr .sparkline::before,
    .kpi-accent.accent-challenges .sparkline::before,
    .kpi-accent.accent-compliance .sparkline::before{ background: linear-gradient(90deg, var(--accent) , var(--accent)); opacity:.22; }

    .kpi-accent.accent-departments .sparkline,
    .kpi-accent.accent-employees .sparkline,
    .kpi-accent.accent-carbon .sparkline,
    .kpi-accent.accent-csr .sparkline,
    .kpi-accent.accent-challenges .sparkline,
    .kpi-accent.accent-compliance .sparkline{ border-color: var(--accent-soft); background: linear-gradient(90deg, var(--accent-soft), rgba(31,122,74,.18)); }

    /* Set the card highlight blob to the KPI accent */
    .kpi-accent.accent-departments::after,
    .kpi-accent.accent-employees::after,
    .kpi-accent.accent-carbon::after,
    .kpi-accent.accent-csr::after,
    .kpi-accent.accent-challenges::after,
    .kpi-accent.accent-compliance::after{ background: var(--accent-soft); }
    .dash-card .inner{ position:relative; z-index:1; }
    .dash-metric {
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap:12px;
    }
    .dash-metric .metric { font-size:28px; font-weight:800; margin-top:6px; }
    .dash-metric .hint { color:var(--muted); font-size:12px; }

    .dash-section { margin-top:16px; }

    .dash-table {
        border-radius:12px;
        overflow:hidden;
    }
    .dash-table th { font-size:12px; letter-spacing:.02em; }

    .trend-list p{ margin:8px 0; }

    .sparkline {
        height:10px;
        background:linear-gradient(90deg, rgba(36,92,143,.15), rgba(31,122,74,.25));
        border:1px solid rgba(159,181,168,.35);
        border-radius:999px;
        margin-top:10px;
        position:relative;
        overflow:hidden;
    }
    .sparkline::before{
        content:"";
        position:absolute;
        inset:0;
        background:linear-gradient(90deg, rgba(36,92,143,.55), rgba(31,122,74,.55));
        width:55%;
        border-radius:999px;
        transform:skewX(-12deg);
        opacity:.65;
    }

    .empty-hint {
        font-style:italic;
        color:var(--muted);
    }
</style>

<!-- Chart.js (real charts for dashboard) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    // Avoid polluting global scope too much, but keep it simple for Blade.
    function renderCharts() {
        const deptCanvas = document.getElementById('deptScoreChart');
        const carbonCanvas = document.getElementById('carbonTrendChart');

        if (deptCanvas) {
            const ctx = deptCanvas.getContext('2d');
            const labels = @json($scores->pluck('department_name')->values());
            const environmental = @json($scores->pluck('environmental')->map(fn($v)=> (float)$v)->values());
            const social = @json($scores->pluck('social')->map(fn($v)=> (float)$v)->values());
            const governance = @json($scores->pluck('governance')->map(fn($v)=> (float)$v)->values());
            const overall = @json($scores->pluck('overall')->map(fn($v)=> (float)$v)->values());

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [
                        {
                            label: 'Environmental (E)',
                            data: environmental,
                            backgroundColor: 'rgba(36, 92, 143, 0.55)',
                            borderColor: 'rgba(36, 92, 143, 1)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Social (S)',
                            data: social,
                            backgroundColor: 'rgba(31, 122, 74, 0.55)',
                            borderColor: 'rgba(31, 122, 74, 1)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Governance (G)',
                            data: governance,
                            backgroundColor: 'rgba(165, 105, 18, 0.55)',
                            borderColor: 'rgba(165, 105, 18, 1)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Overall (O)',
                            data: overall,
                            backgroundColor: 'rgba(112, 142, 122, 0.55)',
                            borderColor: 'rgba(112, 142, 122, 1)',
                            borderWidth: 1,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: false, ticks: { maxRotation: 0, autoSkip: true } },
                        y: {
                            beginAtZero: true,
                            suggestedMax: 100,
                            ticks: { callback: (value) => value }
                        }
                    },
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: { enabled: true }
                    }
                }
            });
        }

        if (carbonCanvas) {
            const ctx2 = carbonCanvas.getContext('2d');
            const labels2 = @json($carbonTrend->pluck('month')->values());
            const totals2 = @json($carbonTrend->pluck('total')->map(fn($v)=> (float)$v)->values());

            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: labels2,
                    datasets: [
                        {
                            label: 'CO2 (kg)',
                            data: totals2,
                            backgroundColor: 'rgba(36, 92, 143, 0.55)',
                            borderColor: 'rgba(36, 92, 143, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { ticks: { maxRotation: 0, autoSkip: true } },
                        y: { beginAtZero: true }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (ctx) => `CO2: ${Number(ctx.parsed.y).toFixed(2)} kg`
                            }
                        }
                    }
                }
            });
        }
    }

    // Wait a tick so canvas sizing/layout is stable.
    window.addEventListener('load', renderCharts);
</script>

<div class="grid cards">
    @foreach($cards as $label => $value)
        @php
            $accentClass = match(true) {
                $label === 'Departments' => 'accent-departments',
                $label === 'Employees' => 'accent-employees',
                $label === 'Carbon Emission' => 'accent-carbon',
                $label === 'CSR Activities' => 'accent-csr',
                $label === 'Challenges' => 'accent-challenges',
                $label === 'Compliance Issues' => 'accent-compliance',
                default => ''
            };
        @endphp

        <div class="card dash-card">
            <div class="inner">
                <div class="kpi-accent {{ $accentClass }}">
                    <div class="muted kpi-title">{{ $label }}</div>
                    <div class="dash-metric">
                        <div>
                            <div class="metric">{{ $value }}</div>
                            <div class="hint">Measured from latest operations</div>
                        </div>
                        <div class="sparkline" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="grid two dash-section">
    {{-- Department Score (Charts) --}}
    <div class="panel dash-table">
        <h2>Department Score (Charts)</h2>

        <div class="chart-legend">
            <span class="legend-dot e"></span> E
            <span class="legend-dot s" style="margin-left:14px"></span> S
            <span class="legend-dot g" style="margin-left:14px"></span> G
            <span class="legend-dot o" style="margin-left:14px"></span> Overall
        </div>

        <div style="height:360px;">
            <canvas id="deptScoreChart"></canvas>
        </div>

        @if(!$scores->count())
            <div class="empty-state" style="margin-top:10px;">
                <div class="empty-hint">Add operations or activities, then recalculate ESG.</div>
            </div>
        @endif
    </div>

    {{-- Right side charts + lists --}}
    <div class="grid">
        <div class="panel">
            <h2>Carbon Trend (Bar Chart)</h2>

            @if($carbonTrend->count())
                <div style="height:340px;">
                    <canvas id="carbonTrendChart"></canvas>
                </div>
                <div class="muted" style="margin-top:10px; font-size:13px">Higher bar = more CO2 (last 6 months)</div>
            @else
                <p class="muted">No carbon transactions yet.</p>
            @endif
        </div>

        <div class="panel">
            <h2>Leaderboard</h2>
            @forelse($leaderboard as $person)
                <p style="margin:8px 0">
                    <strong>{{ $person->name }}</strong>
                    <span class="muted">·</span>
                    {{ $person->points }} points
                </p>
            @empty
                <p class="muted">No approved activities yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
