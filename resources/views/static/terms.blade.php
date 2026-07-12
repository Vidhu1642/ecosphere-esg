@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('content')

<style>
    /* Terms & Conditions page — EcoSphere brand styling (local to this page) */
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
</style>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Legal</div>
        <h1>Terms &amp; Conditions</h1>
        <p>The terms that govern your use of EcoSphere ESG.</p>
    </div>
</section>

<main class="page-body">
    <div class="legal-section">
        <h2>Acceptance of terms</h2>
        <p>By accessing or using EcoSphere ESG, you agree to be bound by these terms and conditions.</p>
    </div>

    <div class="legal-section">
        <h2>Use of the platform</h2>
        <p>You agree to use EcoSphere ESG only for lawful purposes and in accordance with your organization's agreement with us.</p>
    </div>

    <div class="legal-section">
        <h2>Account responsibility</h2>
        <p>You are responsible for maintaining the confidentiality of your account credentials and for all activity under your account.</p>
    </div>

    <div class="legal-section">
        <h2>Changes to these terms</h2>
        <p>We may update these terms from time to time. Continued use of the platform after changes constitutes acceptance of the updated terms.</p>
    </div>
</main>

@endsection