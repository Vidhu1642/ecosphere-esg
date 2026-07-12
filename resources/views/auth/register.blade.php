@extends('layouts.app')

@section('content')
<div class="auth">
    <div class="auth-card">
        <h1>Register</h1>

        @if($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="grid">
            @csrf

            <div><label>Name</label><input name="name" value="{{ old('name') }}" required></div>
            <div><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>

            <div>
                <label>Role</label>
                <select name="role" required>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee</option>
                </select>
            </div>

            <div>
                <label>Department</label>
                <select name="department_id" required>
                    <option value="">None</option>
                    @forelse($departments as $department)
                        <option value="{{ $department->id }}" {{ (string)old('department_id') === (string)$department->id ? 'selected' : '' }}>
                            {{ $department->department_name ?? $department->name ?? 'Department #' . $department->id }}
                        </option>
                    @empty
                        <option value="" disabled>(No departments found)</option>
                    @endforelse
                </select>
                @error('department_id')
                    <div class="alert" style="margin-top:8px">{{ $message }}</div>
                @enderror
            </div>

            <div><label>Password</label><input type="password" name="password" required></div>
            <div><label>Confirm Password</label><input type="password" name="password_confirmation" required></div>

            <div class="actions">
                <button type="submit">Create Account</button>
                <a class="button secondary" href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection

