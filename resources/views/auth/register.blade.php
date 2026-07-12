@extends('layouts.app')

@section('content')
<style>
    /* Register page — hero + card layout (local to this page) */
    :root{
        --brand:#1f7a4d;
        --brand-dark:#155c3a;
    }

    .auth-split{
        display:grid;
        grid-template-columns: 1.1fr 1fr;
        gap:28px;
        min-height:82vh;
        padding:24px 0;
    }
    @media (max-width: 900px){
        .auth-split{ grid-template-columns: 1fr; }
        .auth-hero{ display:none; }
    }

    /* ---------- LEFT HERO PANEL ---------- */
    .auth-hero{
        position:relative;
        overflow:hidden;
        border-radius:24px;
        background: linear-gradient(160deg, #eef6f0 0%, #dcecdf 38%, var(--brand) 100%);
        padding:44px 40px;
        display:flex;
        flex-direction:column;
    }
    .auth-hero::before{
        content:"";
        position:absolute; top:-40px; left:-40px;
        width:220px; height:220px;
        background:
            radial-gradient(circle at 30% 30%, rgba(31,122,77,.28), transparent 60%),
            radial-gradient(circle at 60% 60%, rgba(31,122,77,.18), transparent 55%);
        border-radius:0 0 100% 0;
    }

    .brand-row{ display:flex; align-items:center; gap:12px; position:relative; z-index:2; }
    .brand-mark{
        width:42px; height:42px; border-radius:50%;
        background:#fff;
        display:grid; place-items:center;
        box-shadow:0 4px 14px rgba(20,60,40,.15);
        flex-shrink:0;
    }
    .brand-name{ font-size:22px; font-weight:900; color:var(--brand-dark); }
    .brand-name span{ color:var(--brand); }
    .brand-sub{ font-size:11px; letter-spacing:.14em; color:#4c5c53; font-weight:700; margin-top:2px; text-transform:uppercase; }

    .hero-copy{ position:relative; z-index:2; margin-top:10px; max-width:200px; }
    .hero-copy h1{ font-size:28px; line-height:1.25; margin:0 0 12px; font-weight:800; color:#14251c; }
    .hero-rule{ width:44px; height:4px; background:var(--brand); border-radius:2px; margin-bottom:14px; }
    .hero-copy p{ font-size:14.5px; line-height:1.6; color:#3c4b42; margin:0; }

    .hero-illustration{ position:relative; z-index:1; flex:1; margin:0; min-height:120px; padding:0; }

    .feature-row{
        position:relative; z-index:2;
        display:flex; gap:24px; margin-top:auto; padding-top:20px; flex-wrap:wrap;
    }
    .feature{ display:flex; flex-direction:column; align-items:center; gap:6px; font-size:11.5px; font-weight:700; color:var(--brand-dark); }
    .feature-icon{
        width:40px; height:40px; border-radius:50%;
        background:rgba(255,255,255,.55);
        border:1px solid rgba(255,255,255,.6);
        display:grid; place-items:center; font-size:16px;
    }

    /* ---------- RIGHT: CARD ---------- */
    .auth-form-side{
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .auth-card { position: relative; overflow: hidden; width:100%; max-width:440px; }
    .auth-card::after{
        content:"";
        position:absolute;
        inset:-80px -120px auto auto;
        width:260px;
        height:260px;
        border-radius:40px;
        background: rgba(31,122,77,.12);
        transform: rotate(18deg);
        pointer-events:none;
    }
    .auth-card > *{ position:relative; z-index:1; }

    .auth-title-row{ display:flex; justify-content:space-between; gap:12px; align-items:flex-start; }
    .auth-title{ margin:0; font-size:24px; font-weight:900; }
    .auth-subtitle{ margin:6px 0 0; color: var(--muted); font-size:13px; line-height:1.4; }

    .auth-grid{ display:grid; gap:14px; }
    .field{ display:grid; gap:6px; }
    .field label{ font-size:13px; font-weight:800; letter-spacing:.01em; }

    .input-wrap{ position:relative; }
    .input-wrap input, .input-wrap select{ padding-left:40px; padding-right:16px; }
    .input-icon-left{
        position:absolute; left:12px; top:50%; transform:translateY(-50%);
        color:#1f7a4d; display:grid; place-items:center; pointer-events:none;
    }
    .toggle-pass{
        position:absolute; right:12px; top:50%; transform:translateY(-50%);
        background:none; border:none; cursor:pointer; color:var(--muted);
        display:grid; place-items:center; padding:2px;
    }
    .input-wrap input[type="password"]{ padding-right:40px; }

    .terms{ display:flex; align-items:flex-start; gap:8px; font-size:13px; color:inherit; }
    .terms input{ width:15px; height:15px; margin-top:2px; accent-color:#1f7a4d; flex-shrink:0; }
    .terms a{ color:#1f7a4d; font-weight:700; text-decoration:none; }
    .terms a:hover{ text-decoration:underline; }

    .auth-actions{ display:flex; gap:10px; flex-wrap:wrap; margin-top:4px; align-items:center; }

    .alert{ margin-top:10px; }
</style>

<div class="auth-split">

    <!-- LEFT: HERO -->
    <div class="auth-hero">
        <div class="brand-row">
            <div class="brand-mark">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2C7 2 3 6 3 11c0 5 4 9 9 9s9-4 9-9c0-1.5-.4-2.9-1-4.1C18 10 15 12 12 12s-6-2-8-5.1C4.9 4.7 8.1 2 12 2z" fill="#1f7a4d"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">Eco<span>Sphere</span></div>
                <div class="brand-sub">ESG Management Platform</div>
            </div>
        </div>

        <div class="hero-copy">
            <h1>Join the Team Driving Change</h1>
            <div class="hero-rule"></div>
            <p>Create your account to start monitoring, measuring, and managing Environmental, Social &amp; Governance performance.</p>
        </div>

        <div class="hero-illustration">
            <svg viewBox="0 0 420 200" width="100%" height="100%" preserveAspectRatio="xMidYMax meet">
                <path d="M0 170 Q 80 120 180 150 T 420 140 V 200 H 0 Z" fill="rgba(255,255,255,.35)"/>
                <path d="M0 190 Q 100 150 210 178 T 420 165 V 200 H 0 Z" fill="rgba(255,255,255,.55)"/>
                <!-- tree -->
                <ellipse cx="120" cy="150" rx="26" ry="22" fill="rgba(255,255,255,.7)"/>
                <rect x="116" y="160" width="8" height="24" fill="rgba(255,255,255,.7)"/>
                <!-- turbine -->
                <line x1="300" y1="196" x2="300" y2="110" stroke="rgba(255,255,255,.75)" stroke-width="3"/>
                <g transform="translate(300,110)">
                    <line x1="0" y1="0" x2="18" y2="-14" stroke="rgba(255,255,255,.85)" stroke-width="3"/>
                    <line x1="0" y1="0" x2="-16" y2="-16" stroke="rgba(255,255,255,.85)" stroke-width="3"/>
                    <line x1="0" y1="0" x2="2" y2="20" stroke="rgba(255,255,255,.85)" stroke-width="3"/>
                </g>
            </svg>
        </div>

        <div class="feature-row">
            <div class="feature"><div class="feature-icon">🌿</div>Environment</div>
            <div class="feature"><div class="feature-icon">🤝</div>Social</div>
            <div class="feature"><div class="feature-icon">🏛️</div>Governance</div>
            <div class="feature"><div class="feature-icon">📊</div>Sustainability</div>
        </div>
    </div>

    <!-- RIGHT: CARD -->
    <div class="auth-form-side">
        <div class="auth-card">
            <div class="auth-title-row">
                <div>
                    <h1 class="auth-title">Create account</h1>
                    <p class="auth-subtitle">Join the EcoSphere ESG team and start contributing.</p>
                </div>
                <div class="dash-badge" style="background:rgba(36,92,143,.10); border-color: rgba(36,92,143,.22); color:#1c4e7a;">
                    Register
                </div>
            </div>

            @if($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="auth-grid" style="margin-top:14px;">
                @csrf

                <div class="field">
                    <label for="name">Name</label>
                    <div class="input-wrap">
                        <span class="input-icon-left" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
                        </span>
                        <input id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <span class="input-icon-left" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18v12H3z"/><path d="M3 7l9 6 9-6"/></svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="field">
                    <label for="role">Role</label>
                    <div class="input-wrap">
                        <span class="input-icon-left" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6l8-4z"/></svg>
                        </span>
                        <select id="role" name="role" required>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label for="department_id">Department</label>
                    <div class="input-wrap">
                        <span class="input-icon-left" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/></svg>
                        </span>
                        <select id="department_id" name="department_id">
                            <option value="">None</option>
                            @forelse($departments as $department)
                                <option value="{{ $department->id }}" {{ (string)old('department_id') === (string)$department->id ? 'selected' : '' }}>
                                    {{ $department->department_name ?? $department->name ?? 'Department #' . $department->id }}
                                </option>
                            @empty
                                <option value="" disabled>(No departments found)</option>
                            @endforelse
                        </select>
                    </div>
                    @error('department_id')
                        <div class="alert" style="margin-top:8px">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon-left" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 118 0v3"/></svg>
                        </span>
                        <input id="password" type="password" name="password" required>
                        <button type="button" class="toggle-pass" onclick="togglePassword('password')" aria-label="Show password">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrap">
                        <span class="input-icon-left" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><rect x="3" y="4" width="18" height="16" rx="2"/></svg>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                        <button type="button" class="toggle-pass" onclick="togglePassword('password_confirmation')" aria-label="Show password">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <label class="terms">
                    <input type="checkbox" name="terms">
                    <span>I agree to the <a href="#">Terms &amp; Conditions</a></span>
                </label>

                <div class="auth-actions">
                    <button type="submit">Create Account</button>
                    <a class="button secondary" href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(id){
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
