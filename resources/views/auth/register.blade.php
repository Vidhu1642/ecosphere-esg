@extends('layouts.app')

@section('content')
<div class="auth">
    <div class="auth-card">
        <h1>Register</h1>
        @if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('register.store') }}" class="grid">
            @csrf
            <div><label>Name</label><input name="name" value="{{ old('name') }}" required></div>
            <div><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
            <div><label>Role</label><select name="role"><option value="admin">Admin</option><option value="employee">Employee</option></select></div>
            <div><label>Department</label><select name="department_id"><option value="">None</option>@foreach($departments as $department)<option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name ?? $department->department_name }}</option>@endforeach</select></div>
            <div><label>Password</label><input type="password" name="password" required></div>
            <div><label>Confirm Password</label><input type="password" name="password_confirmation" required></div>
            <div class="actions"><button type="submit">Create Account</button><a class="button secondary" href="{{ route('login') }}">Login</a></div>
        </form>
    </div>
</div>
@endsection
