@extends('layouts.app')

@section('title', 'ESG Dashboard')

@section('content')
<div class="grid cards">
    @foreach($cards as $label => $value)
        <div class="card"><div class="muted">{{ $label }}</div><div class="metric">{{ $value }}</div></div>
    @endforeach
</div>

<div class="grid two" style="margin-top:16px">
    <div class="panel">
        <h2>Department Score</h2>
        <table>
            <thead><tr><th>Department</th><th>E</th><th>S</th><th>G</th><th>Total</th><th>Overall</th></tr></thead>
            <tbody>
            @forelse($scores as $score)
                <tr><td>{{ $score->department_name }}</td><td>{{ $score->environmental }}</td><td>{{ $score->social }}</td><td>{{ $score->governance }}</td><td>{{ $score->department_total }}</td><td>{{ $score->overall }}</td></tr>
            @empty
                <tr><td colspan="6">Add operations or activities, then recalculate ESG.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="grid">
        <div class="panel">
            <h2>Carbon Trend</h2>
            @forelse($carbonTrend as $month)
                <p><strong>{{ $month->month }}</strong> · {{ round($month->total, 2) }} kg CO2</p>
            @empty
                <p class="muted">No carbon transactions yet.</p>
            @endforelse
        </div>
        <div class="panel">
            <h2>Leaderboard</h2>
            @forelse($leaderboard as $person)
                <p><strong>{{ $person->name }}</strong> · {{ $person->points }} points</p>
            @empty
                <p class="muted">No approved activities yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
