@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')

<style>
    /* Privacy Policy page — EcoSphere brand styling (local to this page) */
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
    .page-body{ max-width:760px; margin:0 auto; padding:64px 24px; display:grid; gap:14px; }

    /* ---- Legal sections as cards ---- */
    .legal-section{
        background:#fff; border:1px solid #e6ede8; border-radius:14px;
        padding:26px 28px;
        box-shadow:0 14px 32px -26px rgba(20,60,40,.2);
    }
    .legal-section h2{
        font-size:17px; font-weight:800; color:var(--ink);
        margin:0 0 10px;
        display:flex; align-items:center; gap:10px;
    }
    .legal-section h2::before{
        content:"";
        width:6px; height:6px; border-radius:50%;
        background:var(--brand); flex-shrink:0;
    }
    .legal-section p{
        font-size:14.5px; line-height:1.75; color:#4b5b52; margin:0;
    }

    .page-body > .last-updated{
        text-align:center; font-size:12.5px; color:#7c8b82; font-weight:600;
        margin-top:4px;
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Legal</div>
        <h1>Privacy Policy</h1>
        <p>How EcoSphere ESG collects, uses, and protects your information.</p>
    </div>
</section>

<main class="page-body">
    <div class="legal-section">
        <h2>Information we collect</h2>
        <p>We collect information you provide directly, such as account and organization details, along with usage data generated as you interact with the platform.</p>
    </div>

    <div class="legal-section">
        <h2>How we use your information</h2>
        <p>We use your information to operate and improve EcoSphere ESG, communicate with you about your account, and meet our legal and contractual obligations.</p>
    </div>

    <div class="legal-section">
        <h2>Sharing of information</h2>
        <p>We do not sell your personal information. We may share data with service providers who help us operate the platform, under appropriate confidentiality obligations.</p>
    </div>

    <div class="legal-section">
        <h2>Your choices</h2>
        <p>You can access, update, or request deletion of your personal information at any time by contacting our support team.</p>
    </div>
</main>

@endsection