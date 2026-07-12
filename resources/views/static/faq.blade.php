@extends('layouts.app')

@section('title', 'FAQ')

@section('content')

<style>
    /* FAQ page — EcoSphere brand styling (local to this page) */
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

    /* ---- FAQ accordion ---- */
    .faq-item{
        background:#fff; border:1px solid #e6ede8; border-radius:14px;
        padding:4px 22px;
        box-shadow:0 14px 32px -26px rgba(20,60,40,.2);
        transition:border-color .15s, box-shadow .15s;
    }
    .faq-item:hover{ border-color:rgba(31,122,77,.25); }
    .faq-item[open]{
        border-color:rgba(31,122,77,.3);
        box-shadow:0 20px 40px -22px rgba(20,60,40,.22);
    }

    .faq-item summary{
        list-style:none;
        cursor:pointer;
        font-size:15.5px; font-weight:800; color:var(--ink);
        padding:18px 28px 18px 0;
        position:relative;
        display:flex; align-items:center;
    }
    .faq-item summary::-webkit-details-marker{ display:none; }
    .faq-item summary::after{
        content:"+";
        position:absolute; right:0; top:50%; transform:translateY(-50%);
        width:28px; height:28px; border-radius:50%;
        background:var(--brand-light); color:var(--brand-dark);
        display:grid; place-items:center; font-size:17px; font-weight:700;
        transition:transform .2s, background .15s;
    }
    .faq-item[open] summary::after{
        content:"−";
        background:var(--brand); color:#fff;
    }

    .faq-item p{
        font-size:14.5px; line-height:1.7; color:#4b5b52;
        margin:0 0 20px; padding-right:36px;
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Resources</div>
        <h1>Frequently Asked Questions</h1>
        <p>Answers to the questions we hear most often from teams getting started with EcoSphere ESG.</p>
    </div>
</section>

<main class="page-body">
    <details class="faq-item" open>
        <summary>What is EcoSphere ESG?</summary>
        <p>EcoSphere ESG is a platform for collecting, benchmarking, and reporting on environmental, social, and governance data.</p>
    </details>
    <details class="faq-item">
        <summary>Which reporting frameworks are supported?</summary>
        <p>We support common frameworks including GRI, SASB, and TCFD, with more added regularly.</p>
    </details>
    <details class="faq-item">
        <summary>Can I invite my whole team?</summary>
        <p>Yes, you can invite unlimited team members and assign role-based permissions.</p>
    </details>
    <details class="faq-item">
        <summary>Is my data secure?</summary>
        <p>Yes. See our Privacy Policy and Data Protection Policy for details on how we handle your data.</p>
    </details>
    <details class="faq-item">
        <summary>How do I get support?</summary>
        <p>Visit our Contact page and our team will respond as soon as possible.</p>
    </details>
</main>

@endsection