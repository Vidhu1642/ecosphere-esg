@extends('layouts.app')

@section('title', 'Documentation')

@section('content')

<style>
    /* Documentation page — EcoSphere brand styling (local to this page) */
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
        text-align:center;
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

    /* ---- Body ---- */
    .page-body{ max-width:960px; margin:0 auto; padding:72px 24px; }
    .page-body h2{
        font-size:24px; font-weight:800; color:var(--ink); margin:0 0 14px;
    }
    .page-body h2:not(:first-child){ margin-top:56px; }
    .page-body > p{ font-size:15px; line-height:1.75; color:#4b5b52; margin:0 0 8px; max-width:720px; }

    /* ---- Card grid ---- */
    .card-grid{
        display:grid; grid-template-columns:repeat(2, 1fr); gap:20px;
        margin:28px 0 8px;
    }
    @media (max-width: 640px){ .card-grid{ grid-template-columns:1fr; } }

    .info-card{
        background:#fff; border:1px solid #e6ede8; border-radius:16px;
        padding:24px 26px;
        box-shadow:0 18px 40px -26px rgba(20,60,40,.2);
        transition:transform .15s, box-shadow .15s, border-color .15s;
    }
    .info-card:hover{
        transform:translateY(-3px);
        box-shadow:0 24px 46px -22px rgba(20,60,40,.26);
        border-color:rgba(31,122,77,.25);
    }
    .info-card h3{ font-size:16.5px; font-weight:800; color:var(--ink); margin:0 0 8px; }
    .info-card p{ font-size:14px; line-height:1.65; color:#4b5b52; margin:0; }
</style>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Resources</div>
        <h1>Documentation</h1>
        <p>Everything your team needs to set up, configure, and get the most out of EcoSphere ESG.</p>
    </div>
</section>

<main class="page-body">
    <h2>Getting started</h2>
    <p>New to EcoSphere ESG? Start by connecting your data sources and inviting your team members to the workspace.</p>

    <div class="card-grid">
        <div class="info-card">
            <h3>Setup guide</h3>
            <p>Configure your organization profile, reporting period, and data sources.</p>
        </div>
        <div class="info-card">
            <h3>Data integrations</h3>
            <p>Connect utility, HR, and finance systems to automate data collection.</p>
        </div>
        <div class="info-card">
            <h3>Report builder</h3>
            <p>Learn how to assemble and export framework-aligned ESG reports.</p>
        </div>
        <div class="info-card">
            <h3>API reference</h3>
            <p>Programmatic access to your ESG data for custom dashboards.</p>
        </div>
    </div>

    <h2>Need more help?</h2>
    <p>Reach out through our contact page and our support team will point you to the right resource.</p>
</main>

@endsection