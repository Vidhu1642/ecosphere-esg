<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EcoSphere ESG') }}</title>
    <style>
        :root { --ink:#17211b; --muted:#68756d; --line:#dfe7e2; --panel:#ffffff; --bg:#f5f8f2; --green:#1f7a4d; --blue:#245c8f; --gold:#a56912; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: Arial, Helvetica, sans-serif; color:var(--ink); background:var(--bg); }
        a { color:inherit; text-decoration:none; }
        .shell { display:grid; grid-template-columns:260px 1fr; min-height:100vh; }
        aside { background:#10251b; color:#eef7f0; padding:22px; position:sticky; top:0; height:100vh; overflow:auto; }
        .brand { font-size:22px; font-weight:700; margin-bottom:22px; }
        .nav-title { color:#9fb5a8; font-size:12px; text-transform:uppercase; margin:20px 0 8px; }
        .nav a, .logout { display:block; width:100%; padding:9px 10px; border-radius:6px; color:#eef7f0; background:transparent; border:0; text-align:left; font:inherit; cursor:pointer; }
        .nav a:hover, .logout:hover { background:#1d3a2c; }
        main { padding:26px; }
        .topbar { display:flex; justify-content:space-between; gap:16px; align-items:center; margin-bottom:22px; }
        h1 { margin:0; font-size:28px; }
        h2 { margin:0 0 14px; font-size:18px; }
        .muted { color:var(--muted); }
        .grid { display:grid; gap:16px; }
        .cards { grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); }
        .three { grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }
        .card, .panel { background:var(--panel); border:1px solid var(--line); border-radius:8px; padding:16px; }
        .metric { font-size:26px; font-weight:700; margin-top:8px; }
        .two { grid-template-columns: minmax(0, 1.2fr) minmax(280px, .8fr); }
        table { width:100%; border-collapse:collapse; background:white; border:1px solid var(--line); border-radius:8px; overflow:hidden; }
        th, td { text-align:left; border-bottom:1px solid var(--line); padding:10px; font-size:14px; vertical-align:top; }
        th { background:#edf3ef; color:#3d5145; }
        label { display:block; font-size:13px; font-weight:700; margin-bottom:6px; }
        input, select, textarea { width:100%; padding:9px 10px; border:1px solid #cdd8d1; border-radius:6px; background:white; }
        textarea { min-height:78px; }
        .form-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap:12px; align-items:end; }
        button, .button { display:inline-block; border:0; border-radius:6px; background:var(--green); color:white; padding:10px 14px; font-weight:700; cursor:pointer; }
        .button.secondary { background:var(--blue); }
        .button.gold { background:var(--gold); }
        .alert { background:#e8f5ec; border:1px solid #b8dfc3; color:#235d38; padding:10px 12px; border-radius:6px; margin-bottom:16px; }
        .auth { min-height:100vh; display:grid; place-items:center; padding:22px; }
        .auth-card { width:min(460px, 100%); background:white; border:1px solid var(--line); border-radius:8px; padding:24px; }
        .actions { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        @media (max-width: 900px) { .shell { grid-template-columns:1fr; } aside { position:relative; height:auto; } .two { grid-template-columns:1fr; } }

        /* ESG footer styles */
        /* Fixed footer for all pages */
        .footer-esg {
            position: fixed;
            left: 260px; /* avoid covering the left menu */
            right: 0;
            bottom: 0;
            margin-top: 0;
            background:#0b1713;
            color:#eef7f0;
            z-index: 10;
        }
        .footer-esg-wrap { padding:26px 22px; }

        /* Create space for fixed footer */
        .app-content { padding-bottom: 320px; }
        .footer-esg-body { border-top:1px solid rgba(223,231,226,.25); padding-top:18px; }
        .footer-esg-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:18px; max-width:1100px; margin:0 auto; }
        .footer-esg-col h6 { margin:0 0 10px; font-size:13px; letter-spacing:.02em; color:#d6efe1; }
        .footer-esg-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px; }
        .footer-esg-list p { margin:0; font-size:13px; line-height:1.35; color:rgba(238,247,240,.92); }
        .footer-esg-list a { color:#dff3e7; text-decoration:underline; }
        .footer-esg-actions { margin-top:12px; }
        .footer-esg-btn { display:inline-block; padding:9px 12px; border-radius:8px; background:#163127; border:1px solid rgba(223,231,226,.22); color:#eef7f0; font-weight:700; font-size:13px; }
        .footer-esg-links { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px; }
        .footer-esg-links a { color:rgba(238,247,240,.92); text-decoration:none; font-size:13px; border-bottom:1px dashed rgba(223,231,226,.25); }
        .footer-esg-links a:hover { border-bottom-color:rgba(223,231,226,.65); }
        .footer-esg-muted { color:rgba(238,247,240,.72); margin:0 0 12px; font-size:13px; line-height:1.35; }
        .footer-esg-form { display:flex; gap:10px; align-items:center; }
        .footer-esg-form input { flex:1; padding:10px 12px; border-radius:8px; border:1px solid rgba(223,231,226,.22); background:#0f1f18; color:#eef7f0; }
        .footer-esg-form input::placeholder { color:rgba(238,247,240,.55); }
        .footer-esg-submit { border:0; border-radius:8px; background:var(--green); color:#fff; font-weight:800; padding:10px 14px; cursor:pointer; }
        .footer-esg-bottom { margin-top:18px; border-top:1px solid rgba(223,231,226,.25); }
        .footer-esg-bottom-inner { max-width:1100px; margin:0 auto; padding-top:14px; display:flex; justify-content:space-between; gap:14px; flex-wrap:wrap; color:rgba(238,247,240,.78); font-size:13px; }
        .footer-esg-payment { display:flex; gap:10px; flex-wrap:wrap; }
        .footer-esg-pay-pill { padding:6px 10px; border:1px solid rgba(223,231,226,.22); border-radius:999px; color:rgba(238,247,240,.85); font-weight:700; font-size:12px; }
        @media (max-width: 900px) { .footer-esg-form { flex-direction:column; align-items:stretch; } }
    </style>
</head>
<body>
@auth
    <div class="shell">
        <aside>
            <div class="brand">EcoSphere ESG</div>
            <div class="nav">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <div class="nav-title">Master Configuration</div>
                @foreach(['departments','categories','emission-factors','products','environmental-goals','policies','challenges','csr-activities'] as $item)
                    <a href="{{ route('modules.index', $item) }}">{{ Str::headline($item) }}</a>
                @endforeach
                <div class="nav-title">Daily Operations</div>
                @foreach(['purchases','manufacturing','expenses','fleet'] as $item)
                    <a href="{{ route('modules.index', $item) }}">{{ Str::headline($item) }}</a>
                @endforeach
                <div class="nav-title">People & Governance</div>
                <a href="{{ route('activities.index') }}">Employee Activities</a>
                <a href="{{ route('modules.index', 'audits') }}">Audits</a>
                <a href="{{ route('modules.index', 'compliance-issues') }}">Compliance Issues</a>
                <div class="nav-title">Reports</div>
                @foreach(['environmental','social','governance','summary'] as $report)
                    <a href="{{ route('reports.download', $report) }}">{{ Str::headline($report) }} CSV</a>
                @endforeach
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="logout">Logout</button></form>
            </div>
        </aside>
        <main>
            <div class="topbar">
                <div>
                    <h1>@yield('title', 'Dashboard')</h1>
                    <div class="muted">{{ auth()->user()->name }} · {{ Str::headline(auth()->user()->role) }}</div>
                </div>
                <form method="POST" action="{{ route('scores.recalculate') }}">@csrf<button type="submit">Recalculate ESG</button></form>
            </div>
            @if(session('status'))<div class="alert">{{ session('status') }}</div>@endif
            {{-- fixed footer requires bottom padding so content doesn't hide under it --}}
            <div class="app-content">@yield('content')</div>

        {{-- ESG footer (based on your requested footer layout) --}}
        <footer class="footer-esg">
            <div class="footer-esg-wrap">
                <div class="footer-esg-body">
                    <div class="footer-esg-grid">
                        <div class="footer-esg-col">
                            <div class="footer-esg-logo" style="margin-bottom: 12px;">
                                <a href="{{ route('dashboard') }}" style="font-size: 22px; font-weight: 700; color: #eef7f0; text-decoration: none;">
                                    EcoSphere ESG
                                </a>
                            </div>
                            <ul class="footer-esg-list">
                                <li>
                                    <p>123 Green Way, Sustainability City, 12345</p>
                                </li>
                                <li><p>Email: <a href="mailto:contact@ecosphere.com">contact@ecosphere.com</a></p></li>
                                <li><p>Phone: <a href="tel:+1234567890">(123) 456-7890</a></p></li>
                            </ul>
                            <div class="footer-esg-actions">
    <a href="https://maps.google.com/?q=Akshar+Yug+Society+Shripore+Timbi+Vadodara+Gujarat+390019"
       target="_blank"
       rel="noopener noreferrer"
       class="footer-esg-btn">
        <i class="bi bi-compass-fill"></i> Get Directions
    </a>
</div>
                        </div>

                        <div class="footer-esg-col">
                            <h6>About</h6>
                            <ul class="footer-esg-links">
                                <li><a href="{{ route('about.show') }}">About EcoSphere</a></li>
                                <li><a href="{{ route('mission.show') }}">Our Mission</a></li>
                                <li><a href="{{ route('contact.show') }}">Contact Us</a></li>
                            </ul>
                        </div>

                        <div class="footer-esg-col">
                            <h6>Resources</h6>
                            <ul class="footer-esg-links">
                                <li><a href="{{ route('documentation.show') }}">Documentation</a></li>
                                <li><a href="{{ route('EGreports.show') }}">ESG Reports</a></li>
                                <li><a href="{{ route('faq.show') }}">FAQs</a></li>
                                <li><a href="{{ route('userquide.show') }}">User Guide</a></li>
                            </ul>
                        </div>

                        <div class="footer-esg-col">
                            <h6>Legal</h6>
                            <ul class="footer-esg-links">
                                <li><a href="{{ route('privacy-policy.show') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('terms.show') }}">Terms &amp; Conditions</a></li>
                                <li><a href="{{ route('data-protection.show') }}">Data Protection Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-esg-bottom">
                    <div class="footer-esg-bottom-inner">
                        <div>© {{ date('Y') }} EcoSphere ESG. All Rights Reserved</div>
                        <div class="footer-esg-payment" aria-hidden="true">
                            <span class="footer-esg-pay-pill">VISA</span>
                            <span class="footer-esg-pay-pill">MC</span>
                            <span class="footer-esg-pay-pill">UPI</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        </main>
    </div>
@else
    @yield('content')
@endauth
</body>
</html>
