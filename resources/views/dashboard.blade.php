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
    }
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



<div class="grid cards">
    @foreach($cards as $label => $value)
        <div class="card dash-card">
            <div class="inner">
                <div class="muted" style="font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:.06em">{{ $label }}</div>
                <div class="dash-metric">
                    <div>
                        <div class="metric">{{ $value }}</div>
                        <div class="hint">Measured from latest operations</div>
                    </div>
                    <div class="sparkline" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="grid two dash-section">
    <div class="panel dash-table">
        <h2>Department Score</h2>
        <table>
            <thead>
                <tr>
                    <th>Department</th>
                    <th>E</th>
                    <th>S</th>
                    <th>G</th>
                    <th>Total</th>
                    <th>Overall</th>
                </tr>
            </thead>
            <tbody>
                @forelse($scores as $score)
                    <tr>
                        <td>{{ $score->department_name }}</td>
                        <td>{{ $score->environmental }}</td>
                        <td>{{ $score->social }}</td>
                        <td>{{ $score->governance }}</td>
                        <td>{{ $score->department_total }}</td>
                        <td>{{ $score->overall }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-hint">Add operations or activities, then recalculate ESG.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="grid">
        <div class="panel">
            <h2>Carbon Trend</h2>
            <div class="trend-list">
                @forelse($carbonTrend as $month)
                    <p>
                        <strong>{{ $month->month }}</strong>
                        <span class="muted">·</span>
                        {{ round($month->total, 2) }} kg CO2
                    </p>
                @empty
                    <p class="muted">No carbon transactions yet.</p>
                @endforelse
            </div>
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

