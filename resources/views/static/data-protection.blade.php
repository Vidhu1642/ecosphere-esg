@extends('layouts.app')

@section('title', 'Data Protection Policy')

@section('content')

<style>
    /* Data Protection Policy page — EcoSphere brand styling (local to this page) */
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
        <h1>Data Protection Policy</h1>
        <p>The safeguards we use to keep your ESG data secure.</p>
    </div>
</section>

<main class="page-body">
    <div class="legal-section">
        <h2>Security measures</h2>
        <p>EcoSphere ESG uses industry-standard encryption in transit and at rest, along with role-based access controls to protect your data.</p>
    </div>

    <div class="legal-section">
        <h2>Data retention</h2>
        <p>We retain your data for as long as your account is active or as needed to meet legal and reporting obligations.</p>
    </div>

    <div class="legal-section">
        <h2>Third-party processors</h2>
        <p>Where we use third-party processors, we require them to meet data protection standards consistent with this policy.</p>
    </div>

    <div class="legal-section">
        <h2>Incident response</h2>
        <p>In the event of a data incident, we will notify affected organizations in accordance with applicable law.</p>
    </div>
</main>

@endsection