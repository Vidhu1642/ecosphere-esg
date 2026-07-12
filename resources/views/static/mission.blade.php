@extends('layouts.app')

@section('title', 'Our Mission')

@section('content')

<style>
    /* Our Mission page — EcoSphere brand styling (local to this page) */
    :root{
        --brand:#1f7a4d;
        --brand-dark:#155c3a;
        --brand-light:#e8f5ee;
        --blue:#245c8f;
        --ink:#14251c;
    }

    .eyebrow{
        display:inline-flex; align-items:center;
        font-size:12px; font-weight:800; letter-spacing:.12em; text-transform:uppercase;
        color:var(--brand); background:rgba(31,122,77,.08);
        border:1px solid rgba(31,122,77,.18);
        padding:6px 14px; border-radius:999px; margin-bottom:16px;
    }

    /* ---- Hero ---- */
    .page-hero{
        background: linear-gradient(160deg, #eef6f0 0%, #dcecdf 55%, var(--brand-light) 100%);
        padding:72px 24px 64px;
        position:relative;
        overflow:hidden;
    }
    .page-hero::before{
        content:"";
        position:absolute; top:-60px; right:-60px;
        width:260px; height:260px; border-radius:50%;
        background:radial-gradient(circle, rgba(31,122,77,.16), transparent 70%);
    }
    .page-hero .container{ position:relative; z-index:1; max-width:720px; margin:0 auto; }
    .page-hero h1{ font-size:38px; font-weight:900; line-height:1.2; color:var(--ink); margin:0 0 16px; }
    .page-hero p{ font-size:16px; line-height:1.7; color:#4b5b52; margin:0 auto; max-width:600px; }

    /* ---- Section shell ---- */
    .about-section{ padding:72px 0; }
    .about-section .container{ max-width:1140px; margin:0 auto; padding:0 24px; }

    .section-tag{
        display:inline-block; font-size:12px; font-weight:800; letter-spacing:.1em;
        text-transform:uppercase; color:var(--blue); margin-bottom:10px;
    }

    .about-section h2{ font-size:26px; font-weight:800; color:var(--ink); line-height:1.3; }
    .about-section p{ font-size:15px; line-height:1.75; color:#4b5b52; }

    .about-section img.rounded-4{
        border-radius:20px !important;
        box-shadow:0 24px 50px -24px rgba(20,60,40,.28) !important;
    }

    /* "What We Believe" heading block */
    .about-section .row.mb-5 > .col-12.text-center h2{ margin:8px 0 0; }

    /* ---- Value cards ---- */
    .about-card{
        background:#fff; border:1px solid #e6ede8; border-radius:18px;
        padding:32px 26px; height:100%;
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
</style>

<!-- Hero Section -->
<section class="page-hero">
    <div class="container text-center">
        <div class="eyebrow">Our Mission</div>

        <h1>Building a Sustainable Future Through Technology</h1>

        <p>
            We believe better data leads to better decisions, and better
            decisions create a healthier planet, stronger communities,
            and responsible businesses.
        </p>
    </div>
</section>

<!-- Mission Section -->
<section class="about-section py-5">
    <div class="container">

        <!-- Why We Exist -->
        <div class="row align-items-center mb-5">

            <div class="col-lg-6">
                <img src="{{ asset('images/mission-why.png') }}"
                     class="img-fluid rounded-4 shadow"
                     alt="Why We Exist">
            </div>

            <div class="col-lg-6">

                <span class="section-tag">Why We Exist</span>

                <h2 class="mb-3">
                    Empowering Organizations with Better ESG Insights
                </h2>

                <p>
                    Organizations face increasing expectations to measure,
                    monitor, and disclose their environmental, social, and
                    governance impact.
                </p>

                <p>
                    Unfortunately, many still rely on disconnected spreadsheets
                    and outdated reporting methods. EcoSphere ESG bridges that
                    gap by providing a centralized platform for ESG data,
                    compliance, and reporting.
                </p>

            </div>

        </div>

        <!-- What We Believe -->
        <div class="row mb-5">

            <div class="col-12 text-center mb-4">
                <span class="section-tag">Our Core Values</span>
                <h2>What We Believe</h2>
            </div>

            <div class="col-md-4 mb-4">

                <div class="about-card text-center">

                    <div class="icon">📊</div>

                    <h4>Reliable Reporting</h4>

                    <p>
                        Sustainability reporting should be as accurate,
                        transparent, and trustworthy as financial reporting.
                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="about-card text-center">

                    <div class="icon">🌿</div>

                    <h4>Simple Data Collection</h4>

                    <p>
                        ESG data should be easy to collect, verify,
                        manage, and share across the organization.
                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="about-card text-center">

                    <div class="icon">🤝</div>

                    <h4>Transparency</h4>

                    <p>
                        Transparent reporting builds trust with employees,
                        investors, customers, and communities.
                    </p>

                </div>

            </div>

        </div>

        <!-- Future Vision -->
        <div class="row align-items-center">

            <div class="col-lg-6">
<br>
                <span class="section-tag">
                    Our Future
                </span>

                <h2>Where We're Headed</h2>

                <p>
                    We continue to expand EcoSphere ESG to support global ESG
                    standards and sustainability frameworks, helping
                    organizations of every size make smarter environmental,
                    social, and governance decisions.
                </p>

                <p>
                    Our vision is to become a trusted ESG platform that enables
                    businesses worldwide to measure what matters and drive
                    meaningful, sustainable change.
                </p>

            </div>

            <div class="col-lg-6">

                <img src="{{ asset('images/mission-future.png') }}"
                     class="img-fluid rounded-4 shadow"
                     alt="Future Vision">

            </div>

        </div>

    </div>
</section>

@endsection