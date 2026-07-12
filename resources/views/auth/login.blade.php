<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — EcoSphere</title>
    <style>
        :root{
            --brand:#1f7a4d;
            --brand-dark:#155c3a;
            --brand-light:#e8f5ee;
            --blue:#245c8f;
            --ink:#14251c;
            --muted:#6b7a72;
            --border:#e3ece6;
            --bg:#f4f8f5;
        }
        *{ box-sizing:border-box; }
        body{
            margin:0;
            font-family:'Segoe UI', Roboto, -apple-system, sans-serif;
            background:var(--bg);
            color:var(--ink);
        }

        .page{
            min-height:100vh;
            display:grid;
            grid-template-columns: 1.15fr 1fr;
        }
        @media (max-width: 900px){
            .page{ grid-template-columns: 1fr; }
            .hero{ display:none; }
        }

        /* ---------- LEFT HERO PANEL ---------- */
        .hero{
            position:relative;
            overflow:hidden;
            background: linear-gradient(160deg, #eef6f0 0%, #dcecdf 38%, var(--brand) 100%);
            padding:56px 56px 40px;
            display:flex;
            flex-direction:column;
        }
        .hero::before{ /* leaves top-left */
            content:"";
            position:absolute; top:-40px; left:-40px;
            width:220px; height:220px;
            background:
                radial-gradient(circle at 30% 30%, rgba(31,122,77,.28), transparent 60%),
                radial-gradient(circle at 60% 60%, rgba(31,122,77,.18), transparent 55%);
            border-radius:0 0 100% 0;
        }
        .hero-hill{
            position:absolute; left:0; right:0; bottom:0; height:46%;
            background: linear-gradient(180deg, transparent, rgba(255,255,255,.08));
        }

        .brand-row{ display:flex; align-items:center; gap:12px; position:relative; z-index:2; }
        .brand-mark{
            width:44px; height:44px; border-radius:50%;
            background:#fff;
            display:grid; place-items:center;
            box-shadow:0 4px 14px rgba(20,60,40,.15);
        }
        .brand-name{ font-size:24px; font-weight:900; color:var(--brand-dark); letter-spacing:.2px; }
        .brand-name span{ color:var(--brand); }
        .brand-sub{ font-size:11px; letter-spacing:.14em; color:var(--muted); font-weight:700; margin-top:2px; text-transform:uppercase; }

        .hero-copy{ position:relative; z-index:2; margin-top:64px; max-width:420px; }
        .hero-copy h1{ font-size:32px; line-height:1.2; margin:0 0 14px; font-weight:800; color:var(--ink); }
        .hero-rule{ width:46px; height:4px; background:var(--brand); border-radius:2px; margin-bottom:16px; }
        .hero-copy p{ font-size:15px; line-height:1.6; color:#3c4b42; margin:0; }

        .hero-illustration{ position:relative; z-index:1; flex:1; margin-top:24px; min-height:160px; }

        .feature-row{
            position:relative; z-index:2;
            display:flex; gap:28px; margin-top:auto; padding-top:24px; flex-wrap:wrap;
        }
        .feature{ display:flex; flex-direction:column; align-items:center; gap:8px; font-size:12px; font-weight:700; color:var(--brand-dark); }
        .feature-icon{
            width:44px; height:44px; border-radius:50%;
            background:rgba(255,255,255,.55);
            border:1px solid rgba(255,255,255,.6);
            display:grid; place-items:center; font-size:18px;
            backdrop-filter: blur(2px);
        }

        /* ---------- RIGHT SIDE (FORM) ---------- */
        .form-side{
            display:flex; align-items:center; justify-content:center;
            padding:40px 24px;
            background:var(--bg);
        }
        .auth-card{
            position:relative;
            overflow:hidden;
            width:100%;
            max-width:400px;
            background:#fff;
            border:1px solid var(--border);
            border-radius:22px;
            padding:36px 34px;
            box-shadow:0 20px 50px -20px rgba(20,60,40,.18);
        }
        .auth-card::after{
            content:"";
            position:absolute;
            inset:-80px -120px auto auto;
            width:220px; height:220px;
            border-radius:40px;
            background: rgba(31,122,77,.10);
            transform: rotate(18deg);
            pointer-events:none;
        }
        .auth-card > *{ position:relative; z-index:1; }

        .auth-title{ margin:0; font-size:23px; font-weight:900; color:var(--ink); }
        .auth-subtitle{ margin:6px 0 0; color:var(--muted); font-size:13.5px; }
        .title-rule{ width:38px; height:3px; background:var(--brand); border-radius:2px; margin:14px 0 22px; }

        .field{ display:grid; gap:6px; margin-bottom:16px; }
        .field label{ font-size:13px; font-weight:800; color:var(--ink); }

        .input-wrap{ position:relative; }
        .input-wrap input{
            width:100%;
            padding:12px 14px 12px 40px;
            border:1px solid var(--border);
            border-radius:10px;
            font-size:14px;
            background:#f9fbfa;
            outline:none;
            transition:border-color .15s, box-shadow .15s;
        }
        .input-wrap input:focus{
            border-color:var(--brand);
            box-shadow:0 0 0 3px rgba(31,122,77,.12);
            background:#fff;
        }
        .input-icon-left{
            position:absolute; left:12px; top:50%; transform:translateY(-50%);
            color:var(--brand); display:grid; place-items:center; pointer-events:none;
        }
        .toggle-pass{
            position:absolute; right:12px; top:50%; transform:translateY(-50%);
            background:none; border:none; cursor:pointer; color:var(--muted);
            display:grid; place-items:center; padding:2px;
        }

        .row-between{ display:flex; align-items:center; justify-content:space-between; font-size:13px; margin:2px 0 20px; }
        .remember{ display:flex; align-items:center; gap:7px; color:var(--ink); font-weight:600; }
        .remember input{ width:15px; height:15px; accent-color:var(--brand); }
        .link{ color:var(--brand); font-weight:700; text-decoration:none; }
        .link:hover{ text-decoration:underline; }

        .btn-primary{
            width:100%;
            padding:13px;
            border:none; border-radius:10px;
            background:var(--brand);
            color:#fff; font-weight:800; font-size:14.5px;
            cursor:pointer;
            transition:background .15s, transform .05s;
        }
        .btn-primary:hover{ background:var(--brand-dark); }
        .btn-primary:active{ transform:translateY(1px); }

        .divider{
            display:flex; align-items:center; gap:10px; margin:20px 0;
            color:var(--muted); font-size:12px;
        }
        .divider::before, .divider::after{ content:""; flex:1; height:1px; background:var(--border); }

        .btn-google{
            width:100%; padding:12px; border-radius:10px;
            border:1px solid var(--border); background:#fff;
            display:flex; align-items:center; justify-content:center; gap:10px;
            font-weight:700; font-size:14px; color:var(--ink);
            cursor:pointer;
        }
        .btn-google:hover{ background:#f9fbfa; }

        .foot-note{ text-align:center; font-size:13.5px; color:var(--muted); margin-top:22px; }

        .alert{
            margin-bottom:16px; padding:10px 14px; border-radius:10px;
            background:#fdecec; color:#a3372f; font-size:13px; font-weight:600;
        }
    </style>
</head>
<body>

<div class="page">

    <!-- LEFT: HERO -->
    <div class="hero">
        <div class="hero-hill"></div>

        <div class="brand-row">
            <div class="brand-mark">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2C7 2 3 6 3 11c0 5 4 9 9 9s9-4 9-9c0-1.5-.4-2.9-1-4.1C18 10 15 12 12 12s-6-2-8-5.1C4.9 4.7 8.1 2 12 2z" fill="#1f7a4d"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">Eco<span>Sphere</span></div>
                <div class="brand-sub">ESG Management Platform</div>
            </div>
        </div>

        <div class="hero-copy">
            <h1>Building a Sustainable Future Together</h1>
            <div class="hero-rule"></div>
            <p>Monitor. Measure. Manage. Empowering organizations to achieve Environmental, Social &amp; Governance excellence.</p>
        </div>

        <!-- simple illustration: hills + tree + turbine -->
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

    <!-- RIGHT: LOGIN FORM -->
    <div class="form-side">
        <div class="auth-card">
            <h1 class="auth-title">Welcome Back!</h1>
            <p class="auth-subtitle">Login to your account</p>
            <div class="title-rule"></div>

            @if($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <span class="input-icon-left">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18v12H3z"/><path d="M3 7l9 6 9-6"/></svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon-left">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 118 0v3"/></svg>
                        </span>
                        <input id="password" type="password" name="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-pass" onclick="togglePassword('password', this)" aria-label="Show password">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <div class="row-between">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a class="link" href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-primary">Login</button>

                <div class="divider">or</div>

                <a href="#" class="btn-google">
                    <svg width="18" height="18" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.7 32.9 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 6.5 29.6 4.5 24 4.5 12.7 4.5 3.5 13.7 3.5 25S12.7 45.5 24 45.5 44.5 36.3 44.5 25c0-1.6-.2-3.1-.9-4.5z"/><path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 16 18.9 12.5 24 12.5c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 6.5 29.6 4.5 24 4.5c-7.4 0-13.8 4.1-17.1 10.2z"/><path fill="#4CAF50" d="M24 45.5c5.5 0 10.5-1.9 14.1-5.1l-6.5-5.5C29.6 36.5 26.9 37.5 24 37.5c-5.3 0-9.7-3.1-11.3-7.6l-6.6 5.1C9.4 41.4 16.1 45.5 24 45.5z"/><path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.9 2.5-2.5 4.6-4.6 6l6.5 5.5C40.9 36.4 44.5 31.2 44.5 25c0-1.6-.2-3.1-.9-4.5z"/></svg>
                    Login with Google
                </a>
            </form>

            <p class="foot-note">Don't have an account? <a class="link" href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</div>

<script>
    function togglePassword(id, btn){
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>
