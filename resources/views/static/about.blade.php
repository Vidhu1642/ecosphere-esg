@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<style>
    /* About page — EcoSphere brand styling (local to this page) */
    :root{
        --brand:#1f7a4d;
        --brand-dark:#155c3a;
        --brand-light:#e8f5ee;
        --blue:#245c8f;
        --ink:#14251c;
    }

    .about-section{ padding:48px 0 80px; }
    .about-section .container{ max-width:1140px; margin:0 auto; padding:0 24px; }

    .eyebrow{
        display:inline-flex; align-items:center;
        font-size:12px; font-weight:800; letter-spacing:.12em; text-transform:uppercase;
        color:var(--brand); background:rgba(31,122,77,.08);
        border:1px solid rgba(31,122,77,.18);
        padding:6px 14px; border-radius:999px; margin-bottom:16px;
    }

    /* ---- Hero intro ---- */
    .about-section > .container:first-of-type{
        text-align:center; max-width:760px; padding-top:8px; padding-bottom:8px;
    }
    .about-section > .container:first-of-type h1{
        font-size:38px; font-weight:900; line-height:1.2; color:var(--ink); margin:0 0 16px;
    }
    .about-section > .container:first-of-type p{
        font-size:16px; line-height:1.7; color:#4b5b52; margin:0 auto;
    }

    /* ---- Why EcoSphere intro block ---- */
    .about-intro{ text-align:center; max-width:640px; margin:56px auto 40px; }
    .about-intro h2{ font-size:28px; font-weight:800; color:var(--ink); margin:0 0 14px; }
    .about-intro p{ font-size:15px; line-height:1.7; color:#4b5b52; margin:0; }

    /* ---- Alternating story / services / team rows ---- */
    .about-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:48px;
        align-items:center;
        margin:64px 0;
    }
    .about-grid.reverse .image-col{ order:2; }
    .about-grid.reverse .text-col{ order:1; }
    @media (max-width: 860px){
        .about-grid, .about-grid.reverse{ grid-template-columns:1fr; }
        .about-grid.reverse .image-col{ order:0; }
        .about-grid.reverse .text-col{ order:0; }
    }

    .image-col{ position:relative; }
    .image-col img{
        width:100%; display:block; border-radius:20px;
        box-shadow:0 24px 50px -24px rgba(20,60,40,.28);
    }
    .image-col::before{
        content:"";
        position:absolute; top:-18px; left:-18px;
        width:90px; height:90px; z-index:-1;
        background:rgba(31,122,77,.14); border-radius:24px;
        transform:rotate(12deg);
    }

    .text-col .section-tag{
        display:inline-block; font-size:12px; font-weight:800; letter-spacing:.1em;
        text-transform:uppercase; color:var(--blue); margin-bottom:10px;
    }
    .text-col h2{ font-size:26px; font-weight:800; color:var(--ink); margin:0 0 14px; line-height:1.3; }
    .text-col p{ font-size:15px; line-height:1.75; color:#4b5b52; margin:0 0 14px; }

    .about-quick-points{ display:flex; gap:10px; flex-wrap:wrap; margin-top:18px; }
    .about-point{
        font-size:13px; font-weight:700; color:var(--brand-dark);
        background:var(--brand-light); border:1px solid rgba(31,122,77,.18);
        padding:8px 14px; border-radius:999px;
    }

    .about-features{
        display:grid; grid-template-columns:repeat(2, 1fr); gap:12px; margin-top:20px;
    }
    .about-features > div{
        font-size:14px; font-weight:700; color:var(--ink);
        background:#fff; border:1px solid #e6ede8; border-radius:12px;
        padding:14px 16px; box-shadow:0 8px 20px -14px rgba(20,60,40,.2);
    }

    /* ---- Vision / Mission / Values cards ---- */
    .about-cards-grid{
        display:grid; grid-template-columns:repeat(3, 1fr); gap:24px; margin:72px 0;
    }
    @media (max-width: 860px){ .about-cards-grid{ grid-template-columns:1fr; } }
    .about-card{
        background:#fff; border:1px solid #e6ede8; border-radius:18px;
        padding:32px 26px; text-align:center;
        box-shadow:0 20px 44px -28px rgba(20,60,40,.22);
        transition:transform .15s, box-shadow .15s;
    }
    .about-card:hover{ transform:translateY(-4px); box-shadow:0 26px 50px -24px rgba(20,60,40,.28); }
    .about-card .icon{
        width:56px; height:56px; margin:0 auto 16px;
        border-radius:50%; background:var(--brand-light);
        display:grid; place-items:center; font-size:26px;
    }
    .about-card h4{ font-size:18px; font-weight:800; color:var(--ink); margin:0 0 10px; }
    .about-card p{ font-size:14px; line-height:1.65; color:#4b5b52; margin:0; }

    /* ---- Stats strip ---- */
    .about-stats{
        display:flex; justify-content:space-around; flex-wrap:wrap; gap:24px;
        background:linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
        border-radius:22px; padding:40px 24px; margin:72px 0; text-align:center;
    }
    .stat-value{ font-size:36px; font-weight:900; color:#fff; }
    .stat-label{ font-size:13px; font-weight:600; color:rgba(255,255,255,.85); margin-top:6px; text-transform:uppercase; letter-spacing:.06em; }

    /* ---- CTA ---- */
    .about-cta{ display:flex; align-items:center; gap:20px; margin-top:22px; flex-wrap:wrap; }
    .about-cta-btn{
        display:inline-flex; align-items:center; justify-content:center;
        background:var(--brand); color:#fff; font-weight:800; font-size:14.5px;
        padding:13px 26px; border-radius:10px; text-decoration:none;
        transition:background .15s;
    }
    .about-cta-btn:hover{ background:var(--brand-dark); }
    .about-cta-link{
        color:var(--brand-dark); font-weight:700; font-size:14.5px; text-decoration:none;
        border-bottom:2px solid rgba(31,122,77,.3);
        padding-bottom:2px;
    }
    .about-cta-link:hover{ border-color:var(--brand); }
</style>

<!-- About Section -->
<section class="about-section">
     <div class="container">
        <div class="eyebrow">About EcoSphere ESG</div>

        <h1>Driving Sustainable Business Excellence</h1>

        <p>
            Empowering organizations to measure, manage, and improve their
            Environmental, Social, and Governance (ESG) performance through
            intelligent analytics and modern digital solutions.
        </p>
    </div>
    <div class="container">
        

        <div class="about-intro">
            <div class="eyebrow">Why EcoSphere ESG</div>
            <h2>Turn ESG complexity into clear, confident action.</h2>
            <p>
                We help organizations unify Environmental, Social, and Governance data into an intuitive platform—so reporting becomes faster,
                compliance becomes stronger, and sustainability becomes measurable.
            </p>
        </div>

        <!-- Our Story -->
        <div class="about-grid">
            <div class="image-col">
                <img src="{{ asset('images/about.png') }}" alt="Our Story" style="width: 100%;">
                
            </div>
            <div class="text-col">
                <span class="section-tag">Our Story</span>
                <h2>Transforming ESG Into Action</h2>

                <p>
                    EcoSphere ESG was created with one clear mission: helping organizations move beyond spreadsheets and disconnected sustainability data.
                </p>

                <p>
                    Our platform centralizes ESG information into a single, easy-to-use dashboard—enabling businesses to monitor performance, ensure compliance,
                    and achieve sustainability goals with confidence.
                </p>

                <div class="about-quick-points" aria-label="Highlights">
                    <div class="about-point">📊 ESG analytics</div>
                    <div class="about-point">✅ Compliance-ready</div>
                    <div class="about-point">🔍 Single source of truth</div>
                </div>
            </div>
        </div>


        <!-- What We Do -->
        <div class="about-grid reverse">
            <div class="image-col">
                <img src="{{ asset('images/about-services.png') }}" alt="What We Do">
            </div>
            <div class="text-col">
                <span class="section-tag">
                    What We Do
                </span>

                <h2>
                    Complete ESG Management
                </h2>

                <p>
                    EcoSphere ESG provides organizations with a comprehensive
                    platform to manage environmental impact, employee
                    engagement, governance compliance, and sustainability
                    reporting.
                </p>

                <div class="about-features">
                    <div>
                        🌿 Environmental
                    </div>
                    <div>
                        👥 Social
                    </div>
                    <div>
                        🛡 Governance
                    </div>
                    <div>
                        📊 ESG Analytics
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="about-cards-grid">
            <div class="about-card">
                <div class="icon">🌍</div>
                <h4>Our Vision</h4>
                <p>Enable every organization to achieve measurable, transparent, and sustainable growth.</p>
            </div>
            <div class="about-card">
                <div class="icon">🌱</div>
                <h4>Our Mission</h4>
                <p>Deliver intelligent ESG tools that simplify reporting, improve compliance, and support better decisions.</p>
            </div>
            <div class="about-card">
                <div class="icon">🤝</div>
                <h4>Our Values</h4>
                <p>Sustainability, Innovation, Transparency, and Collaboration guide everything we build.</p>
            </div>
        </div>

        <!-- Stats strip -->
        <div class="about-stats" role="list" aria-label="EcoSphere ESG stats">
            <div class="stat" role="listitem">
                <div class="stat-value">360°</div>
                <div class="stat-label">ESG coverage</div>
            </div>
            <div class="stat" role="listitem">
                <div class="stat-value">1</div>
                <div class="stat-label">Unified dashboard</div>
            </div>
            <div class="stat" role="listitem">
                <div class="stat-value">100%</div>
                <div class="stat-label">Compliance support</div>
            </div>
        </div>

        <!-- Team -->
        <div class="about-grid">
            <div class="text-col">
                <span class="section-tag">Our Team</span>
                <h2>Meet the Innovators</h2>

                <p>
                    EcoSphere ESG is built by passionate software engineers, sustainability professionals, and designers—committed to making ESG management smarter, faster,
                    and more accessible.
                </p>

                <p>Together, we help organizations transform sustainability goals into measurable business outcomes.</p>

                <div class="about-cta">
                    <a class="about-cta-btn" href="{{ route('contact.show') }}">Talk to our team</a>
                    <a class="about-cta-link" href="#">Explore our approach</a>
                </div>
            </div>
            <div class="image-col">
                <img src="{{ asset('images/about-team.png') }}" alt="Our Team">
            </div>
        </div>

    </div>
</section>

@endsection