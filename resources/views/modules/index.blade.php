@extends('layouts.app')

@section('title', $config['title'])

@section('content')
<div class="panel">
    <h2>Create {{ $config['title'] }}</h2>
    <form method="POST" action="{{ route('modules.store', $module) }}" class="form-grid">
        @csrf
        @foreach($config['fields'] as $field)
            <div>
                <label>{{ Str::headline($field) }}</label>
                @if($field === 'department_id' || $field === 'parent_department_id')
                    <select name="{{ $field }}"><option value="">Select department</option>@foreach($options['departments'] as $department)<option value="{{ $department->id }}">{{ $department->department_name }}</option>@endforeach</select>
                @elseif($field === 'product_id')
                    <select name="{{ $field }}" required><option value="">Select product</option>@foreach($options['products'] as $product)<option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach</select>
                @elseif($field === 'audit_id')
                    <select name="{{ $field }}"><option value="">Select audit</option>@foreach($options['audits'] as $audit)<option value="{{ $audit->id }}">{{ $audit->title }}</option>@endforeach</select>
                @elseif(Str::contains($field, 'description') || $field === 'findings')
                    <textarea name="{{ $field }}"></textarea>
                @elseif(Str::contains($field, 'date') || $field === 'deadline')
                    <input type="date" name="{{ $field }}" value="{{ now()->toDateString() }}" required>
                @elseif(in_array($field, ['quantity','factor','co2_factor','target','amount','units_produced','electricity_used','fuel_used','distance','score','employee_count','xp'], true))
                    <input type="number" step="0.01" name="{{ $field }}" value="0" required>
                @elseif($field === 'status')
                    <select name="{{ $field }}"><option>active</option><option>planned</option><option>completed</option><option>open</option><option>closed</option><option>inactive</option></select>
                @elseif($field === 'difficulty')
                    <select name="{{ $field }}"><option>easy</option><option>medium</option><option>hard</option></select>
                @elseif($field === 'type')
                    <select name="{{ $field }}"><option>CSR</option><option>Challenge</option></select>
                @else
                    <input name="{{ $field }}" required>
                @endif
            </div>
        @endforeach
        <div><button type="submit">Save</button></div>
    </form>
</div>

<div style="margin-top:16px">
    <table>
        <thead><tr>@foreach($config['fields'] as $field)<th>{{ Str::headline($field) }}</th>@endforeach<th>Created</th></tr></thead>
        <tbody>
        @forelse($rows as $row)
            <tr>
                @foreach($config['fields'] as $field)
                    <td>{{ $row->{$field} ?? '' }}</td>
                @endforeach
                <td>{{ $row->created_at }}</td>
            </tr>
        @empty
            <tr><td colspan="{{ count($config['fields']) + 1 }}">No records yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:12px">{{ $rows->links() }}</div>
</div>
@endsection
