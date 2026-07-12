@extends('layouts.app')

@section('title', 'User Guide')

@section('content')

<style>
    /* User Guide page — EcoSphere brand styling (local to this page) */
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
    .page-body{ max-width:760px; margin:0 auto; padding:72px 24px; }
    .page-body h2{ font-size:24px; font-weight:800; color:var(--ink); margin:0 0 20px; }
    .page-body h2:not(:first-child){ margin-top:56px; }
    .page-body > p{ font-size:14.5px; line-height:1.75; color:#4b5b52; margin:0; }

    /* ---- Step list ---- */
    .step-list{ list-style:none; margin:0; padding:0; display:grid; gap:14px; counter-reset:step; }
    .step-list li{
        counter-increment:step;
        display:flex; align-items:flex-start; gap:16px;
        background:#fff; border:1px solid #e6ede8; border-radius:14px;
        padding:18px 22px;
        font-size:14.5px; line-height:1.65; color:var(--ink); font-weight:600;
        box-shadow:0 14px 32px -26px rgba(20,60,40,.2);
        transition:transform .15s, box-shadow .15s, border-color .15s;
    }
    .step-list li:hover{
        transform:translateY(-2px);
        box-shadow:0 20px 40px -22px rgba(20,60,40,.26);
        border-color:rgba(31,122,77,.25);
    }
    .step-list li::before{
        content:counter(step);
        flex-shrink:0;
        width:30px; height:30px; border-radius:50%;
        background:var(--brand); color:#fff;
        display:grid; place-items:center;
        font-size:14px; font-weight:800;
        margin-top:1px;
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Resources</div>
        <h1>User Guide</h1>
        <p>A simple walkthrough for setting up your workspace and publishing your first ESG report.</p>
    </div>
</section>

<main class="page-body">
    <h2>Getting set up</h2>
    <ol class="step-list">
        <li>Create your organization profile and select your reporting period.</li>
        <li>Invite team members and assign them to the relevant data categories.</li>
        <li>Connect your data sources or upload data manually.</li>
        <li>Review and validate the data collected in your dashboard.</li>
        <li>Generate your report and export it in your preferred format.</li>
    </ol>

    <h2>Tips for a smoother rollout</h2>
    <p>Start with a single reporting period before rolling EcoSphere ESG out across every business unit. This helps your team learn the workflow before scaling up.</p>
</main>

@endsection