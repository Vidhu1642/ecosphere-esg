@extends('layouts.app')

@section('title', 'ESG Reports')

@section('content')

<style>
    /* ESG Reports page — EcoSphere brand styling (local to this page) */
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
    .page-body h2{ font-size:24px; font-weight:800; color:var(--ink); margin:0 0 16px; }
    .page-body h2:not(:first-child){ margin-top:56px; }
    .page-body > p{ font-size:14.5px; line-height:1.7; color:#4b5b52; margin:28px 0 0; max-width:720px; }

    /* ---- Report list ---- */
    .report-list{ list-style:none; margin:0; padding:0; display:grid; gap:12px; }
    .report-list li{
        display:flex; align-items:center; justify-content:space-between; gap:16px;
        background:#fff; border:1px solid #e6ede8; border-radius:14px;
        padding:16px 20px;
        font-size:14.5px; font-weight:700; color:var(--ink);
        box-shadow:0 14px 32px -24px rgba(20,60,40,.2);
        transition:transform .15s, box-shadow .15s, border-color .15s;
    }
    .report-list li:hover{
        transform:translateY(-2px);
        box-shadow:0 20px 40px -22px rgba(20,60,40,.26);
        border-color:rgba(31,122,77,.25);
    }
    .report-list li::before{
        content:"📄";
        font-size:16px; flex-shrink:0;
    }
    .report-list li{ padding-left:18px; }
    .report-list li > span{ flex:1; }

    .report-badge{
        font-size:11.5px; font-weight:800; letter-spacing:.04em;
        color:var(--blue); background:rgba(36,92,143,.10);
        border:1px solid rgba(36,92,143,.2);
        padding:4px 10px; border-radius:999px; flex-shrink:0;
        white-space:nowrap;
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Resources</div>
        <h1>ESG Reports</h1>
        <p>Annual and quarterly reports covering our environmental, social, and governance performance.</p>
    </div>
</section>

<main class="page-body">
    <h2>Annual reports</h2>
    <ul class="report-list">
        <li><span>2025 Annual ESG Report</span> <span class="report-badge">PDF</span></li>
        <li><span>2024 Annual ESG Report</span> <span class="report-badge">PDF</span></li>
        <li><span>2023 Annual ESG Report</span> <span class="report-badge">PDF</span></li>
    </ul>

    <h2>Quarterly updates</h2>
    <ul class="report-list">
        <li><span>Q2 2026 Sustainability Update</span> <span class="report-badge">PDF</span></li>
        <li><span>Q1 2026 Sustainability Update</span> <span class="report-badge">PDF</span></li>
    </ul>

    <p>Report downloads will appear here once published. Contact us if you need an earlier report that isn't listed.</p>
</main>

@endsection