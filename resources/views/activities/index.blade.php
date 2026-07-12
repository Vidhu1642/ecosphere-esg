@extends('layouts.app')

@section('title', 'Employee Activities')

@section('content')
<div class="grid three">
    <div class="panel">
        <h2>CSR Participation</h2>
        @foreach($csrActivities as $activity)
            <form method="POST" action="{{ route('activities.join') }}" class="card" style="margin-bottom:10px">
                @csrf
                <strong>{{ $activity->title }}</strong><p class="muted">{{ $activity->points }} points</p>
                <input type="hidden" name="activity_type" value="csr"><input type="hidden" name="activity_id" value="{{ $activity->id }}">
                <label>Proof URL</label><input name="proof_url"><button type="submit" style="margin-top:8px">Join</button>
            </form>
        @endforeach
    </div>
    <div class="panel">
        <h2>Challenges</h2>
        @foreach($challenges as $challenge)
            <form method="POST" action="{{ route('activities.join') }}" class="card" style="margin-bottom:10px">
                @csrf
                <strong>{{ $challenge->title }}</strong><p class="muted">{{ $challenge->xp }} XP · {{ $challenge->difficulty }}</p>
                <input type="hidden" name="activity_type" value="challenge"><input type="hidden" name="activity_id" value="{{ $challenge->id }}">
                <label>Proof URL</label><input name="proof_url"><button type="submit" style="margin-top:8px">Submit</button>
            </form>
        @endforeach
    </div>
    <div class="panel">
        <h2>Policy Acknowledgement</h2>
        @foreach($policies as $policy)
            <form method="POST" action="{{ route('activities.join') }}" class="card" style="margin-bottom:10px">
                @csrf
                <strong>{{ $policy->title }}</strong><p class="muted">{{ $policy->description }}</p>
                <input type="hidden" name="activity_type" value="policy"><input type="hidden" name="activity_id" value="{{ $policy->id }}">
                <button type="submit">I Agree</button>
            </form>
        @endforeach
    </div>
</div>

<div class="panel" style="margin-top:16px">
    <h2>Submissions</h2>
    <table>
        <thead><tr><th>Employee</th><th>Type</th><th>Activity</th><th>Status</th><th>Points</th><th>Action</th></tr></thead>
        <tbody>
        @forelse($submissions as $submission)
            <tr>
                <td>{{ $submission->employee_name }}</td><td>{{ $submission->activity_type }}</td><td>{{ $submission->activity_title }}</td><td>{{ $submission->status }}</td><td>{{ $submission->points }}</td>
                <td>@if($submission->status !== 'approved')<form method="POST" action="{{ route('activities.approve', $submission->id) }}">@csrf<button type="submit">Approve</button></form>@endif</td>
            </tr>
        @empty
            <tr><td colspan="6">No activity submissions yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
