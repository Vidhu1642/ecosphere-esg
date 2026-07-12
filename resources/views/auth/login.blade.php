@extends('layouts.app')

@section('content')
<div class="auth">
    <div class="auth-card">
        <h1>Admin Login</h1>
        <p class="muted">Use admin@ecosphere.test / password after seeding.</p>
        @if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('login.store') }}" class="grid">
            @csrf
            <div><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
            <div><label>Password</label><input type="password" name="password" required></div>
            <div class="actions"><button type="submit">Login</button><a class="button secondary" href="{{ route('register') }}">Register</a></div>
        </form>
    </div>
</div>
@endsection
