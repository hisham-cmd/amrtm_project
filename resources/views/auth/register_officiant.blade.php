{{-- resources/views/auth/register_officiant.blade.php --}}
<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل مأذون شرعي — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:        #1a5c38;
            --green-mid:    #2a7a4e;
            --green-light:  #52b788;
            --green-pale:   #e8f5ee;
            --green-border: #b8dbc8;
            --gold:         #c8a951;
            --gold-light:   #fdf4dc;
            --gold-border:  #e8d080;
            --red:          #dc3545;
            --red-pale:     #fff5f5;
            --text:         #1a1a2e;
            --text-muted:   #6c757d;
            --border:       #dee2e6;
            --white:        #ffffff;
            --bg:           #f8f9fa;
            --shadow-sm:    0 1px 3px rgba(0,0,0,.08);
            --shadow-md:    0 4px 16px rgba(0,0,0,.10);
            --shadow-lg:    0 8px 32px rgba(0,0,0,.12);
            --radius:       10px;
            --radius-lg:    16px;
            --transition:   .2s ease;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            direction: rtl;
        }

        /* ── Header ── */
        .site-header {
            background: var(--green);
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(0,0,0,.2);
        }
        .header-logo { font-size: 1.5rem; font-weight: 900; color: #fff; text-decoration: none; }
        .header-logo span { color: var(--gold); }
        .header-login-link {
            font-size: .84rem; color: rgba(255,255,255,.8); text-decoration: none;
            display: flex; align-items: center; gap: 6px;
        }
        .header-login-link:hover { color: #fff; }

        /* ── Hero ── */
        .hero {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-mid) 100%);
            padding: 36px 24px 32px;
            text-align: center;
            color: #fff;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.3);
            border-radius: 50px; padding: 6px 16px;
            font-size: .82rem; font-weight: 700;
            color: var(--gold-light); margin-bottom: 14px;
        }
        .hero h1 { font-size: 1.7rem; font-weight: 900; margin-bottom: 8px; }
        .hero p  { font-size: .93rem; color: rgba(255,255,255,.8); }

        /* ── Main Container ── */
        .container {
            max-width: 760px;
            margin: 0 auto;
            padding: 32px 16px 60px;
        }

        /* ── Card ── */
        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .card-header {
            display: flex; align-items: center; gap: 14px;
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: #fcfcfc;
        }
        .card-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--green-pale);
            display: flex; align-items: center; justify-content: center;
            color: var(--green); font-size: 1.1rem; flex-shrink: 0;
        }
        .card-icon.gold { background: var(--gold-light); color: var(--gold); }
        .card-title   { font-size: 1rem; font-weight: 800; color: var(--text); }
        .card-subtitle{ font-size: .82rem; color: var(--text-muted); margin-top: 2px; }
        .card-body    { padding: 24px; }
        .optional-badge {
            display: inline-block;
            background: #e9ecef; color: var(--text-muted);
            font-size: .72rem; font-weight: 700;
            border-radius: 50px; padding: 2px 10px; margin-right: 6px;
        }

        /* ── Form ── */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .form-group { margin-bottom: 18px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-label {
            display: flex; align-items: center; gap: 6px;
            font-size: .87rem; font-weight: 700;
            color: var(--text); margin-bottom: 8px;
        }
        .form-label-icon { color: var(--green); font-size: .82rem; }
        .required-star  { color: var(--red); font-size: .85rem; }
        .optional-tag   {
            font-size: .72rem; font-weight: 600; color: var(--text-muted);
            background: #f0f0f0; border-radius: 50px; padding: 1px 8px;
        }

        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; top: 50%; transform: translateY(-50%);
            right: 14px; color: var(--text-muted); font-size: .85rem; pointer-events: none;
        }
        .form-control {
            width: 100%;
            padding: 11px 40px 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Cairo', sans-serif;
            font-size: .9rem; color: var(--text);
            background: var(--white);
            transition: border-color var(--transition), box-shadow var(--transition);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(82,183,136,.15);
        }
        .form-control.is-invalid { border-color: var(--red); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,53,69,.12); }

        .phone-input-wrap { display: flex; gap: 0; }
        .phone-prefix {
            background: #f0f0f0; border: 1.5px solid var(--border);
            border-left: none; border-radius: var(--radius) 0 0 var(--radius);
            padding: 11px 14px; font-size: .88rem; font-weight: 700;
            white-space: nowrap; color: var(--text);
        }
        .phone-input-wrap .form-control {
            border-radius: 0 var(--radius) var(--radius) 0;
            border-right: none; padding-right: 14px;
        }

        .hint-msg {
            font-size: .78rem; color: var(--text-muted);
            margin-top: 5px; display: flex; align-items: center; gap: 5px;
        }
        .invalid-msg {
            display: none; align-items: center; gap: 6px;
            font-size: .8rem; color: var(--red);
            margin-top: 5px; font-weight: 600;
        }

        /* ── Password ── */
        .toggle-pass {
            position: absolute; top: 50%; transform: translateY(-50%);
            left: 12px; background: none; border: none;
            color: var(--text-muted); cursor: pointer; font-size: .9rem;
            padding: 4px;
        }
        .toggle-pass:hover { color: var(--green); }

        .password-strength { margin-top: 8px; }
        .strength-bar {
            height: 4px; background: var(--border);
            border-radius: 4px; overflow: hidden; margin-bottom: 4px;
        }
        .strength-fill {
            height: 100%; width: 0;
            border-radius: 4px;
            transition: width .3s, background .3s;
        }
        .strength-text { font-size: .76rem; color: var(--text-muted); }

        /* ── National Address ── */
        .address-input { font-size: 1.1rem; letter-spacing: 3px; font-weight: 700; text-align: center; }

        /* ── File Upload ── */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 28px 16px;
            text-align: center;
            cursor: pointer;
            transition: border-color var(--transition), background var(--transition);
            position: relative;
        }
        .upload-zone:hover, .upload-zone.drag-over {
            border-color: var(--green-light);
            background: var(--green-pale);
        }
        .upload-zone.has-file {
            border-color: var(--green-light);
            background: var(--green-pale);
        }
        .upload-zone.is-invalid { border-color: var(--red); background: var(--red-pale); }
        .upload-zone input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .upload-icon { font-size: 2rem; color: var(--text-muted); margin-bottom: 10px; }
        .upload-zone.has-file .upload-icon { color: var(--green); }
        .upload-title { font-size: .9rem; font-weight: 700; color: var(--text); margin-bottom: 4px; }
        .upload-sub   { font-size: .78rem; color: var(--text-muted); }
        .file-status  { margin-top: 10px; font-size: .82rem; font-weight: 700; }
        .file-status.success { color: var(--green); }
        .file-status.error   { color: var(--red); }

        /* ── Profile Photo Preview ── */
        .photo-preview-wrap { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .photo-preview {
            width: 80px; height: 80px; border-radius: 50%;
            border: 2px solid var(--border);
            object-fit: cover; display: none;
        }
        .photo-preview.visible { display: block; }

        /* ── Declaration Modal ── */
        .modal-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.55); z-index: 9000;
            align-items: center; justify-content: center;
            padding: 16px;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            width: 100%; max-width: 680px;
            max-height: 90vh;
            display: flex; flex-direction: column;
            animation: modalIn .25s ease;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(24px) scale(.97); }
            to   { opacity: 1; transform: translateY(0)   scale(1); }
        }
        .modal-head {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 12px;
        }
        .modal-head-icon {
            width: 42px; height: 42px; border-radius: 10px;
            background: var(--gold-light); color: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .modal-title { font-size: 1.05rem; font-weight: 900; color: var(--text); }
        .modal-sub   { font-size: .8rem; color: var(--text-muted); margin-top: 2px; }
        .modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
            line-height: 1.9;
            font-size: .9rem;
            color: var(--text);
        }
        .modal-body p { margin-bottom: 14px; }
        .modal-body ol {
            padding-right: 20px;
            margin-bottom: 14px;
        }
        .modal-body ol li { margin-bottom: 10px; }
        .modal-body .decl-name {
            font-weight: 800; font-size: 1rem;
            color: var(--green); border-bottom: 2px solid var(--green-border);
            padding-bottom: 8px; margin-bottom: 16px;
            display: block;
        }
        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            background: #fafafa;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
        }
        .modal-footer-note {
            font-size: .78rem; color: var(--text-muted);
            margin-bottom: 12px; text-align: center;
        }
        .btn-agree {
            width: 100%; padding: 14px;
            background: var(--green); color: #fff;
            border: none; border-radius: var(--radius);
            font-family: 'Cairo', sans-serif;
            font-size: 1rem; font-weight: 800;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: background var(--transition);
        }
        .btn-agree:hover { background: var(--green-mid); }
        .btn-agree-cancel {
            display: block; text-align: center; margin-top: 10px;
            font-size: .84rem; color: var(--text-muted);
            cursor: pointer; background: none; border: none;
            font-family: 'Cairo', sans-serif; width: 100%; padding: 6px;
        }
        .btn-agree-cancel:hover { color: var(--red); }

        /* ── Submit Button ── */
        .submit-card {
            background: var(--white); border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md); padding: 24px;
            position: sticky; bottom: 16px;
        }
        .btn-submit {
            width: 100%; padding: 14px 28px;
            background: var(--green); color: #fff;
            border: none; border-radius: var(--radius);
            font-family: 'Cairo', sans-serif; font-size: 1rem; font-weight: 800;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: background var(--transition), transform var(--transition);
        }
        .btn-submit:hover { background: var(--green-mid); transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }

        /* ── Back Link ── */
        .back-link {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--text-muted); font-size: .87rem; font-weight: 600;
            text-decoration: none; margin-bottom: 20px;
            transition: color var(--transition);
        }
        .back-link:hover { color: var(--green); }

        /* ── Alert ── */
        .alert-error {
            background: var(--red-pale); border: 1px solid #f5c2c7;
            border-radius: var(--radius); padding: 14px 18px;
            margin-bottom: 20px; color: var(--red);
            font-size: .88rem; font-weight: 600;
        }
        .alert-error ul { margin: 8px 0 0 20px; }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .form-grid-2 { grid-template-columns: 1fr; }
            .hero h1 { font-size: 1.4rem; }
            .card-body { padding: 16px; }
        }

        /* ═══════════════════════ MOTION ═══════════════════════ */

        @keyframes heroGradShift {
            0%,100% { background-position: 0% 60%; }
            50%      { background-position: 100% 40%; }
        }
        @keyframes floatA {
            0%,100% { transform: translateY(0) rotate(0deg); }
            33%      { transform: translateY(-14px) rotate(4deg); }
            66%      { transform: translateY(6px) rotate(-3deg); }
        }
        @keyframes floatB {
            0%,100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(-18px) rotate(-6deg); }
        }
        @keyframes floatC {
            0%,100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(10px) rotate(5deg); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }
        @keyframes badgePop {
            0%   { transform: scale(0) translateY(8px); opacity: 0; }
            65%  { transform: scale(1.12) translateY(-2px); opacity: 1; }
            100% { transform: scale(1) translateY(0); opacity: 1; }
        }
        @keyframes pulseBorder {
            0%,100% { border-color: var(--green-light); box-shadow: 0 0 0 0 rgba(82,183,136,0); }
            50%      { border-color: var(--green); box-shadow: 0 0 0 5px rgba(82,183,136,.12); }
        }
        @keyframes iconPop {
            0%   { transform: scale(0) rotate(-20deg); }
            70%  { transform: scale(1.3) rotate(5deg); }
            100% { transform: scale(1) rotate(0deg); }
        }
        @keyframes glowPulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(26,92,56,0); }
            50%      { box-shadow: 0 0 0 10px rgba(26,92,56,.18); }
        }
        @keyframes shimmerSweep {
            from { left: -100%; }
            to   { left: 150%; }
        }
        @keyframes dotReveal {
            from { transform: scale(0); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }

        /* ── Header entrance ── */
        .site-header { animation: slideDown .45s cubic-bezier(.22,1,.36,1); }

        /* ── Hero animated gradient ── */
        .hero {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #0b2e1a 0%, var(--green) 35%, var(--green-mid) 70%, #1a7a50 100%);
            background-size: 280% 280%;
            animation: heroGradShift 10s ease infinite;
        }

        /* ── Hero floating blobs ── */
        .hero-blob {
            position: absolute; border-radius: 50%;
            pointer-events: none; background: rgba(255,255,255,.07);
        }
        .hero-blob-1 { width:190px; height:190px; top:-65px; left:-55px;    animation: floatA  8s ease-in-out infinite; }
        .hero-blob-2 { width:95px;  height:95px;  top:10px;  right:8%;      animation: floatB  6s ease-in-out .5s infinite; }
        .hero-blob-3 { width:58px;  height:58px;  bottom:8px; left:18%;     animation: floatC  7s ease-in-out 1s infinite; }
        .hero-blob-4 { width:250px; height:250px; bottom:-120px; right:-70px; opacity:.04; animation: floatA 13s ease-in-out 2s infinite; }

        /* ── Hero floating icons ── */
        .hero-ico {
            position: absolute; pointer-events: none;
            color: rgba(255,255,255,.12); font-size: 1.7rem;
        }
        .hero-ico-1 { top:14px;  right:13%;  animation: floatB 9s ease-in-out infinite; }
        .hero-ico-2 { bottom:14px; left:6%;  animation: floatC 7s ease-in-out .5s infinite; }
        .hero-ico-3 { top:44%;  right:4%;   font-size:2.5rem; animation: floatA 11s ease-in-out 1.5s infinite; }

        /* ── Hero text entrance ── */
        .hero-badge { animation: badgePop .6s cubic-bezier(.34,1.56,.64,1) .15s both; }
        .hero h1    { animation: fadeUp .55s ease .3s both; }
        .hero p     { animation: fadeUp .55s ease .45s both; }

        /* ── Progress dots in hero ── */
        .hero-progress {
            display: flex; align-items: center; justify-content: center;
            gap: 7px; margin-top: 22px;
            animation: fadeUp .5s ease .6s both;
        }
        .h-dot {
            width: 9px; height: 9px; border-radius: 50%;
            background: rgba(255,255,255,.28);
            transition: all .4s cubic-bezier(.34,1.56,.64,1);
            animation: dotReveal .4s ease both;
        }
        .h-dot.active { width: 30px; border-radius: 5px; background: rgba(255,255,255,.9); }
        .h-dot.done   { background: var(--gold); transform: scale(1.2); }
        .h-dot-label  { font-size: .72rem; color: rgba(255,255,255,.5); font-weight: 600; }

        /* ── Back link ── */
        .back-link { animation: fadeUp .45s ease .5s both; }

        /* ── Alert ── */
        .alert-error { animation: fadeUp .4s ease; }

        /* ── Card scroll reveal ── */
        .card {
            opacity: 0; transform: translateY(34px);
            transition: opacity .58s cubic-bezier(.22,1,.36,1),
                        transform .58s cubic-bezier(.22,1,.36,1),
                        box-shadow .25s;
        }
        .card.revealed { opacity: 1; transform: translateY(0); }
        .card:hover    { box-shadow: 0 12px 36px rgba(26,92,56,.13); }

        /* ── Card icon bounce on hover ── */
        .card-icon {
            transition: transform .32s cubic-bezier(.34,1.56,.64,1), background .2s;
        }
        .card:hover .card-icon { transform: scale(1.18) rotate(-7deg); }

        /* ── Input focus lift ── */
        .form-control {
            transition: border-color .2s, box-shadow .3s, transform .18s;
        }
        .form-control:focus { transform: translateY(-1px); }

        /* ── Upload zone pulse on hover ── */
        .upload-zone:hover, .upload-zone.drag-over {
            border-color: var(--green-light);
            background: var(--green-pale);
            animation: pulseBorder 1.6s ease infinite;
        }
        .upload-zone.has-file .upload-icon i { animation: iconPop .42s cubic-bezier(.34,1.56,.64,1); }

        /* ── Submit button shimmer sweep ── */
        .btn-submit {
            position: relative; overflow: hidden;
            transition: background .2s, transform .2s, box-shadow .2s;
        }
        .btn-submit::after {
            content: '';
            position: absolute; top: 0; left: -100%;
            width: 55%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.22), transparent);
            transform: skewX(-18deg);
            transition: none;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(26,92,56,.4); }
        .btn-submit:hover::after { animation: shimmerSweep .6s ease forwards; }
        .btn-submit:active { transform: translateY(0); box-shadow: none; }

        /* ── Submit card ── */
        .submit-card {
            animation: fadeUp .5s ease .7s both;
            transition: box-shadow .25s;
        }
        .submit-card:hover { box-shadow: 0 10px 32px rgba(0,0,0,.13); }

        /* ── Modal spring entrance (override earlier keyframe) ── */
        @keyframes modalIn {
            0%   { opacity: 0; transform: translateY(52px) scale(.91); }
            65%  { transform: translateY(-6px) scale(1.015); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-overlay { backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
        .modal-box     { animation: modalIn .46s cubic-bezier(.34,1.1,.64,1); }
        .modal-head-icon {
            transition: transform .32s cubic-bezier(.34,1.56,.64,1);
        }
        .modal-head:hover .modal-head-icon { transform: rotate(-12deg) scale(1.15); }

        /* ── Agree button glow pulse ── */
        .btn-agree {
            transition: background .2s, transform .2s, box-shadow .2s;
            animation: glowPulse 2.5s ease 1.2s infinite;
        }
        .btn-agree:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(26,92,56,.45);
            animation: none;
        }

        /* ── Container must be positioned so it paints above canvas ── */
        .container { position: relative; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
            #bgCanvas { display: none; }
        }
    </style>
</head>
<body>

{{-- Ambient background canvas — fixed, paints before all content --}}
<canvas id="bgCanvas" style="position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;"></canvas>

{{-- Header --}}
<header class="site-header">
    <a href="{{ route('halls.list') }}" class="header-logo">أمر <span>تم</span></a>
    <a href="{{ route('login') }}" class="header-login-link">
        <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
    </a>
</header>

{{-- Hero --}}
<div class="hero">
    {{-- Animated blobs --}}
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>
    <div class="hero-blob hero-blob-3"></div>
    <div class="hero-blob hero-blob-4"></div>
    {{-- Floating icons --}}
    <i class="fas fa-scroll      hero-ico hero-ico-1"></i>
    <i class="fas fa-pen-nib     hero-ico hero-ico-2"></i>
    <i class="fas fa-certificate hero-ico hero-ico-3"></i>

    <div class="hero-badge"><i class="fas fa-scroll"></i> تسجيل مأذون شرعي</div>
    <h1>انضم إلى منصة أمر تم</h1>
    <p>سجّل بياناتك وابدأ رحلتك معنا — سيتم مراجعة طلبك والتواصل معك قريباً</p>

    {{-- Progress dots --}}
    <div class="hero-progress">
        <span class="h-dot-label">البيانات</span>
        <div class="h-dot active" id="dot0"></div>
        <div class="h-dot"        id="dot1"></div>
        <div class="h-dot"        id="dot2"></div>
        <div class="h-dot"        id="dot3"></div>
        <span class="h-dot-label">التقديم</span>
    </div>
</div>

<div class="container">

    {{-- Back --}}
    <a href="{{ route('register.owner') }}" class="back-link">
        <i class="fas fa-arrow-right"></i> رجوع إلى صفحة تسجيل المنشأة
    </a>

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="alert-error">
        <i class="fas fa-exclamation-triangle"></i> يرجى تصحيح الأخطاء التالية:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="officiantForm" method="POST" action="{{ route('register.officiant.submit') }}" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- ═══ Card 1: البيانات الشخصية ═══ --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-user-circle"></i></div>
                <div>
                    <div class="card-title">البيانات الشخصية</div>
                    <div class="card-subtitle">معلوماتك الأساسية للحساب</div>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label class="form-label" for="full_name">
                        <span class="form-label-icon"><i class="fas fa-id-badge"></i></span>
                        الاسم الكامل (حسب الرخصة)
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-wrap">
                        <i class="input-icon fas fa-id-badge"></i>
                        <input type="text" id="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                            placeholder="أدخل اسمك الكامل حسب الاسم المسجل في الرخصة"
                            value="{{ old('full_name') }}" autocomplete="name">
                    </div>
                    <div class="invalid-msg" id="full-name-error" style="display:none">
                        <i class="fas fa-exclamation-circle"></i> أدخل اسمك الكامل
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="phone">
                            <span class="form-label-icon"><i class="fas fa-mobile-alt"></i></span>
                            رقم الجوال
                            <span class="required-star">*</span>
                        </label>
                        <div class="phone-input-wrap">
                            <div class="phone-prefix">🇸🇦 +966</div>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="5XXXXXXXX"
                                value="{{ old('phone') }}" maxlength="9" pattern="[0-9]{9}"
                                autocomplete="tel">
                        </div>
                        <div class="hint-msg"><i class="fas fa-info-circle"></i> بدون الصفر الأول — مثال: 512345678</div>
                        <div class="invalid-msg" id="phone-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> أدخل رقم جوال سعودي صحيح (9 أرقام)
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">
                            <span class="form-label-icon"><i class="fas fa-envelope"></i></span>
                            البريد الإلكتروني
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="input-icon fas fa-envelope"></i>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="you@example.com"
                                value="{{ old('email') }}" autocomplete="email">
                        </div>
                        <div class="invalid-msg" id="email-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> أدخل بريد إلكتروني صحيح
                        </div>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <span class="form-label-icon"><i class="fas fa-lock"></i></span>
                            كلمة المرور
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="input-icon fas fa-lock"></i>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••" autocomplete="new-password"
                                oninput="checkStrength(this.value)">
                            <button type="button" class="toggle-pass" onclick="togglePass('password',this)" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                            <div class="strength-text" id="strengthText">أدخل كلمة مرور (8 أحرف على الأقل)</div>
                        </div>
                        <div class="invalid-msg" id="password-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> كلمة المرور يجب أن تكون 8 أحرف على الأقل
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">
                            <span class="form-label-icon"><i class="fas fa-lock"></i></span>
                            تأكيد كلمة المرور
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="input-icon fas fa-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="••••••••" autocomplete="new-password">
                            <button type="button" class="toggle-pass" onclick="togglePass('password_confirmation',this)" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-msg" id="confirm-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> كلمتا المرور غير متطابقتين
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ═══ Card 2: بيانات الرخصة ═══ --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon gold"><i class="fas fa-id-card"></i></div>
                <div>
                    <div class="card-title">بيانات الرخصة</div>
                    <div class="card-subtitle">رقم الرخصة وصورتها وتاريخ انتهائها</div>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label class="form-label" for="license_number">
                        <span class="form-label-icon"><i class="fas fa-hashtag"></i></span>
                        رقم رخصة المأذون
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-wrap">
                        <i class="input-icon fas fa-hashtag"></i>
                        <input type="text" id="license_number" name="license_number"
                            class="form-control @error('license_number') is-invalid @enderror"
                            placeholder="أدخل رقم الرخصة"
                            value="{{ old('license_number') }}">
                    </div>
                    <div class="invalid-msg" id="license-error" style="display:none">
                        <i class="fas fa-exclamation-circle"></i> أدخل رقم الرخصة
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">
                            <span class="form-label-icon"><i class="fas fa-file-image"></i></span>
                            صورة الرخصة
                            <span class="required-star">*</span>
                        </label>
                        <div class="upload-zone" id="license-upload-zone"
                            ondragover="onDragOver(event,'license-upload-zone')"
                            ondragleave="onDragLeave(event,'license-upload-zone')"
                            ondrop="onDrop(event,'license-upload-zone','doc_work_license','license-status')">
                            <input type="file" id="doc_work_license" name="doc_work_license"
                                accept=".pdf,.jpg,.jpeg,.png"
                                onchange="onFileSelect(this,'license-upload-zone','license-status')">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="upload-title">اسحب الملف هنا أو انقر للرفع</div>
                            <div class="upload-sub">PDF، JPG، PNG — الحد الأقصى 5 ميجابايت</div>
                            <div id="license-status" class="file-status"></div>
                        </div>
                        <div class="invalid-msg" id="license-file-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> يرجى رفع صورة الرخصة
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="doc_wl_expiry">
                            <span class="form-label-icon"><i class="fas fa-calendar-alt"></i></span>
                            تاريخ انتهاء الرخصة
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="input-icon fas fa-calendar-alt"></i>
                            <input type="date" id="doc_wl_expiry" name="doc_wl_expiry"
                                class="form-control @error('doc_wl_expiry') is-invalid @enderror"
                                value="{{ old('doc_wl_expiry') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="invalid-msg" id="expiry-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> أدخل تاريخاً صالحاً (لم تنته صلاحيته بعد)
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ═══ Card 3: العنوان الوطني ═══ --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <div class="card-title">العنوان الوطني</div>
                    <div class="card-subtitle">كود العنوان الوطني السعودي المكوّن من 8 خانات</div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label" for="national_address">
                        <span class="form-label-icon"><i class="fas fa-location-dot"></i></span>
                        كود العنوان الوطني
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-wrap">
                        <i class="input-icon fas fa-location-dot"></i>
                        <input type="text" id="national_address" name="national_address"
                            class="form-control address-input @error('national_address') is-invalid @enderror"
                            {{-- placeholder="JHHA3454" --}}
                            maxlength="8"
                            pattern="[a-zA-Z]{4}[0-9]{4}"
                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g,'').toUpperCase()"
                            value="{{ old('national_address') }}">
                    </div>
                    <div class="hint-msg">
                        <i class="fas fa-info-circle"></i>
                        4 أحرف إنجليزية تليها 4 أرقام — مثال: <strong>JHHA3454</strong>
                    </div>
                    <div class="invalid-msg" id="address-error" style="display:none">
                        <i class="fas fa-exclamation-circle"></i> أدخل العنوان الوطني بصيغة صحيحة (4 أحرف + 4 أرقام)
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ Card 4: الصورة الشخصية (اختياري) ═══ --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon"><i class="fas fa-camera"></i></div>
                <div>
                    <div class="card-title">الصورة الشخصية <span class="optional-badge">اختياري</span></div>
                    <div class="card-subtitle">صورة واضحة لك تُعرض في ملفك على المنصة</div>
                </div>
            </div>
            <div class="card-body">
                <div class="photo-preview-wrap">
                    <img id="photo-preview" src="" alt="معاينة الصورة" class="photo-preview">
                    <div class="upload-zone" id="photo-upload-zone" style="flex:1;"
                        ondragover="onDragOver(event,'photo-upload-zone')"
                        ondragleave="onDragLeave(event,'photo-upload-zone')"
                        ondrop="onDrop(event,'photo-upload-zone','profile_photo','photo-status')">
                        <input type="file" id="profile_photo" name="profile_photo"
                            accept=".jpg,.jpeg,.png"
                            onchange="onPhotoSelect(this)">
                        <div class="upload-icon"><i class="fas fa-user-circle"></i></div>
                        <div class="upload-title">اسحب صورتك هنا أو انقر للاختيار</div>
                        <div class="upload-sub">JPG، PNG — الحد الأقصى 3 ميجابايت</div>
                        <div id="photo-status" class="file-status"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- hidden — يُعبأ عند الموافقة داخل الـ popup --}}
        <input type="hidden" name="terms_agreed" id="terms_agreed" value="{{ old('terms_agreed') ? '1' : '' }}">

        {{-- ═══ Submit ═══ --}}
        <div class="submit-card">
            <button type="button" class="btn-submit" id="submitBtn" onclick="validateAndOpenModal()">
                <i class="fas fa-file-signature"></i>
                مراجعة الإقرار والتقديم
            </button>
            <div class="invalid-msg" id="terms-error" style="display:none; margin-top:10px; justify-content:center;">
                <i class="fas fa-exclamation-circle"></i> يجب قراءة الإقرار والموافقة عليه أولاً
            </div>
        </div>

    </form>
</div>

{{-- ═══════════ Declaration Modal ═══════════ --}}
<div class="modal-overlay" id="declModal" onclick="closeModalOnBackdrop(event)">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-icon"><i class="fas fa-scroll"></i></div>
            <div>
                <div class="modal-title">إقرار وتعهد المأذون الشرعي</div>
                <div class="modal-sub">يرجى القراءة بعناية قبل الموافقة</div>
            </div>
        </div>
        <div class="modal-body">
            <span class="decl-name">
                <i class="fas fa-user-tie" style="margin-left:6px;"></i>
                أقر أنا / <span id="decl-name-placeholder">...</span>
            </span>
            <p>
                بصفتي مأذوناً شرعياً ومسجلاً في منصة <strong>أمر تم</strong> لخدمات الأعمال، قسم منصة المأذون الشرعي،
                بأنني المسؤول مسؤولية كاملة ومنفردة عن جميع الأعمال والخدمات والإجراءات التي أقوم بها من خلال المنصة،
                وما يترتب عليها من آثار شرعية أو نظامية أو قانونية تجاه العملاء أو الجهات ذات العلاقة.
            </p>
            <p><strong>كما أقر وأتعهد بما يلي:</strong></p>
            <ol>
                <li>أن جميع البيانات والمعلومات والتراخيص والمستندات المقدمة مني صحيحة وسارية المفعول، وأتحمل كامل المسؤولية عن صحتها وتحديثها بشكل مستمر.</li>
                <li>أن عملي عبر المنصة يتم بصفتي المستقلة كمأذون شرعي مرخص، وأن دور المنصة يقتصر على تقديم خدمة الاستضافة التقنية، والتعريف بالمأذونين، وتوفير لوحة تحكم إلكترونية لتنظيم الخدمات فقط.</li>
                <li>أن المنصة لا تعتبر جهة إشراف أو توثيق أو اعتماد أو رقابة على أعمالي، ولا تتحمل أي مسؤولية عن إجراءات عقود النكاح أو صحة البيانات أو المستندات أو التحقق من الهويات أو حضور الأطراف أو الشهود أو الموافقات النظامية أو أي التزامات شرعية أو قانونية أخرى.</li>
                <li>أنني أتحمل وحدي كامل المسؤولية عن التواصل مع العملاء، وإتمام الإجراءات الشرعية والنظامية، والالتزام بجميع الأنظمة والتعليمات المعمول بها في المملكة العربية السعودية.</li>
                <li>أن المنصة وملاكها وإدارتها وموظفيها غير مسؤولين عن أي مطالبات أو شكاوى أو خلافات أو أضرار أو تعويضات مباشرة أو غير مباشرة تنشأ نتيجة الأعمال أو الخدمات التي أقدمها.</li>
                <li>أتعهد بعدم استخدام المنصة في أي أعمال مخالفة للأنظمة أو التعليمات أو الأحكام الشرعية أو الآداب العامة، وأتحمل كامل المسؤولية عند المخالفة.</li>
                <li>أوافق على حق المنصة في إيقاف أو تعليق أو حذف الحساب أو الخدمات المقدمة لي عند مخالفة الأنظمة أو السياسات أو عند وجود شكاوى أو ملاحظات تستوجب ذلك، دون أي مسؤولية على المنصة.</li>
                <li>أتعهد بتعويض المنصة عن أي أضرار أو خسائر أو مطالبات أو التزامات قانونية أو مالية تنشأ بسبب مخالفاتي أو أخطائي أو النزاعات المتعلقة بالخدمات التي أقدمها.</li>
                <li>أقر بأن العلاقة التعاقدية والخدمية تتم بيني وبين العميل مباشرة، ولا تعتبر المنصة طرفاً في أي عقد أو اتفاق أو التزام بين الطرفين.</li>
                <li>أوافق على أن استخدامي للمنصة يعد موافقة صريحة ونهائية على جميع السياسات والشروط والأحكام الخاصة بالمنصة.</li>
            </ol>
            <p>
                وبهذا أقر بموافقتي الكاملة على جميع ما ورد أعلاه، دون أدنى مسؤولية على المنصة أو ملاكها أو إدارتها أو مشغليها.
            </p>
        </div>
        <div class="modal-footer">
            <div class="modal-footer-note">
                <i class="fas fa-info-circle"></i>
                بالضغط على «أوافق وأتعهد» سيُرسل طلبك فوراً إلى لوحة تحكم المشرف للمراجعة
            </div>
            <button type="button" class="btn-agree" id="agreeBtn" onclick="agreeAndSubmit()">
                <i class="fas fa-check-circle"></i>
                أوافق وأتعهد بجميع ما ورد أعلاه
            </button>
            <button type="button" class="btn-agree-cancel" onclick="closeModal()">
                رجوع — أريد مراجعة البيانات
            </button>
        </div>
    </div>
</div>

<script>
    /* ── File Upload ── */
    var licenseFile = null;

    function onDragOver(e, zoneId) {
        e.preventDefault();
        document.getElementById(zoneId).classList.add('drag-over');
    }
    function onDragLeave(e, zoneId) {
        document.getElementById(zoneId).classList.remove('drag-over');
    }
    function onDrop(e, zoneId, inputId, statusId) {
        e.preventDefault();
        var zone = document.getElementById(zoneId);
        zone.classList.remove('drag-over');
        var file = e.dataTransfer.files[0];
        if (!file) return;
        var input = document.getElementById(inputId);
        var dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        if (inputId === 'profile_photo') {
            showPhotoPreview(file);
        }
        setFileStatus(zone, statusId, file);
    }
    function onFileSelect(input, zoneId, statusId) {
        if (!input.files || !input.files[0]) return;
        var zone = document.getElementById(zoneId);
        setFileStatus(zone, statusId, input.files[0]);
        licenseFile = input.files[0];
    }
    function setFileStatus(zone, statusId, file) {
        zone.classList.add('has-file');
        zone.classList.remove('is-invalid');
        var kb = (file.size / 1024).toFixed(0);
        var mb = file.size > 1024*1024 ? (file.size/1024/1024).toFixed(1) + ' MB' : kb + ' KB';
        document.getElementById(statusId).innerHTML =
            '<span class="success"><i class="fas fa-check-circle"></i> ' + file.name + ' (' + mb + ')</span>';
    }

    /* ── Photo Preview ── */
    function onPhotoSelect(input) {
        if (!input.files || !input.files[0]) return;
        var zone = document.getElementById('photo-upload-zone');
        setFileStatus(zone, 'photo-status', input.files[0]);
        showPhotoPreview(input.files[0]);
    }
    function showPhotoPreview(file) {
        if (!file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById('photo-preview');
            img.src = e.target.result;
            img.classList.add('visible');
        };
        reader.readAsDataURL(file);
    }

    /* ── Declaration Modal ── */
    function openModal() {
        var name = document.getElementById('full_name').value.trim() || '...';
        document.getElementById('decl-name-placeholder').textContent = name;
        document.getElementById('declModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('declModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    function closeModalOnBackdrop(e) {
        if (e.target === document.getElementById('declModal')) closeModal();
    }
    function agreeAndSubmit() {
        document.getElementById('terms_agreed').value = '1';
        document.getElementById('terms-error').style.display = 'none';
        var btn = document.getElementById('agreeBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
        document.getElementById('officiantForm').submit();
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    /* ── Password ── */
    function togglePass(id, btn) {
        var inp = document.getElementById(id);
        if (inp.type === 'password') {
            inp.type = 'text';
            btn.querySelector('i').className = 'fas fa-eye-slash';
        } else {
            inp.type = 'password';
            btn.querySelector('i').className = 'fas fa-eye';
        }
    }
    function checkStrength(val) {
        var fill = document.getElementById('strengthFill');
        var text = document.getElementById('strengthText');
        if (!fill) return;
        var score = 0;
        if (val.length >= 8)  score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        var colors = ['#dc3545','#fd7e14','#ffc107','#52b788'];
        var labels = ['ضعيفة جداً','متوسطة','جيدة','قوية'];
        fill.style.width  = (score * 25) + '%';
        fill.style.background = colors[score - 1] || '#dee2e6';
        text.textContent = val.length === 0 ? 'أدخل كلمة مرور (8 أحرف على الأقل)' : (labels[score - 1] || '');
    }

    /* ── Validation ── */
    function showErr(errId, fieldId) {
        var e = document.getElementById(errId);
        if (e) e.style.display = 'flex';
        var f = document.getElementById(fieldId);
        if (f) f.classList.add('is-invalid');
    }
    function clearErrors() {
        document.querySelectorAll('.invalid-msg').forEach(function(el) { el.style.display = 'none'; });
        document.querySelectorAll('.is-invalid').forEach(function(el)  { el.classList.remove('is-invalid'); });
        document.querySelectorAll('.upload-zone.is-invalid').forEach(function(el) { el.classList.remove('is-invalid'); });
    }

    /* ══ Scroll-reveal cards ══ */
    (function () {
        var cards = document.querySelectorAll('.card');
        if (!('IntersectionObserver' in window)) {
            cards.forEach(function (c) { c.classList.add('revealed'); });
            return;
        }
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var delay = +(entry.target.dataset.revealDelay || 0);
                setTimeout(function () { entry.target.classList.add('revealed'); }, delay);
                obs.unobserve(entry.target);
            });
        }, { threshold: 0.08 });
        cards.forEach(function (card, i) {
            card.dataset.revealDelay = i * 90;
            obs.observe(card);
        });
    })();

    /* ══ Hero progress dots ══ */
    function updateHeroDots() {
        var scores = [false, false, false, false];

        var nm = document.getElementById('full_name').value.trim();
        var ph = document.getElementById('phone').value.trim();
        var em = document.getElementById('email').value.trim();
        var pw = document.getElementById('password').value;
        scores[0] = !!(nm && /^[0-9]{9}$/.test(ph) && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em) && pw.length >= 8);

        var ln = document.getElementById('license_number').value.trim();
        var lf = document.getElementById('doc_work_license').files[0];
        var ex = document.getElementById('doc_wl_expiry').value;
        scores[1] = !!(ln && lf && ex && new Date(ex) > new Date());

        var ad = document.getElementById('national_address').value.trim();
        scores[2] = /^[A-Za-z]{4}[0-9]{4}$/.test(ad);

        scores[3] = scores[0] && scores[1] && scores[2];

        var firstPending = scores.indexOf(false);
        if (firstPending === -1) firstPending = 4;

        for (var i = 0; i < 4; i++) {
            var dot = document.getElementById('dot' + i);
            if (!dot) continue;
            dot.classList.remove('active', 'done');
            if (i < firstPending)      dot.classList.add('done');
            else if (i === firstPending) dot.classList.add('active');
        }
    }

    ['full_name', 'phone', 'email', 'password', 'license_number', 'doc_wl_expiry', 'national_address']
        .forEach(function (id) {
            var el = document.getElementById(id);
            if (el) el.addEventListener('input', updateHeroDots);
        });
    document.getElementById('doc_work_license').addEventListener('change', updateHeroDots);
    updateHeroDots();

    function validateAndOpenModal() {
        clearErrors();
        var valid = true;

        var fullName = document.getElementById('full_name').value.trim();
        if (!fullName) { showErr('full-name-error','full_name'); valid = false; }

        var phone = document.getElementById('phone').value.trim();
        if (!phone || !/^[0-9]{9}$/.test(phone)) { showErr('phone-error','phone'); valid = false; }

        var email = document.getElementById('email').value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showErr('email-error','email'); valid = false; }

        var pass  = document.getElementById('password').value;
        var conf  = document.getElementById('password_confirmation').value;
        if (!pass || pass.length < 8) { showErr('password-error','password'); valid = false; }
        if (pass !== conf)            { showErr('confirm-error','password_confirmation'); valid = false; }

        var licNum = document.getElementById('license_number').value.trim();
        if (!licNum) { showErr('license-error','license_number'); valid = false; }

        var licFile = document.getElementById('doc_work_license').files[0];
        if (!licFile) {
            document.getElementById('license-upload-zone').classList.add('is-invalid');
            document.getElementById('license-file-error').style.display = 'flex';
            valid = false;
        }

        var expiry = document.getElementById('doc_wl_expiry').value;
        if (!expiry || new Date(expiry) <= new Date()) { showErr('expiry-error','doc_wl_expiry'); valid = false; }

        var addr = document.getElementById('national_address').value.trim();
        if (!addr || !/^[A-Za-z]{4}[0-9]{4}$/.test(addr)) { showErr('address-error','national_address'); valid = false; }

        if (!valid) {
            var first = document.querySelector('.is-invalid, .upload-zone.is-invalid');
            if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        openModal();
    }

    /* ══════════════════════════════════════════
       Ambient Background — floating particles
    ══════════════════════════════════════════ */
    (function () {
        var cvs = document.getElementById('bgCanvas');
        if (!cvs || !cvs.getContext) return;
        var ctx = cvs.getContext('2d');
        var W, H;

        /* brand palette: deep green, mid green, light green, gold, warm gold */
        var PALETTE = [
            '26,92,56',
            '42,122,78',
            '82,183,136',
            '200,169,81',
            '218,190,100',
        ];

        var N = 68;
        var pool = [];

        function resize() {
            W = cvs.width  = window.innerWidth;
            H = cvs.height = window.innerHeight;
        }

        function rand(a, b)   { return a + Math.random() * (b - a); }
        function pick(arr)    { return arr[Math.floor(Math.random() * arr.length)]; }
        function isGold(col)  { return col.charAt(0) === '2' && col.charAt(1) !== '6'; }

        function spawn(spreadY) {
            var t = Math.random();
            /* 40% rings, 38% dots, 22% 4-point sparkles */
            var kind = t < 0.40 ? 'ring' : t < 0.78 ? 'dot' : 'star';
            var bx   = rand(0, W || window.innerWidth);
            var col  = pick(PALETTE);
            /* gold particles slightly more opaque for festivity */
            var mxA  = isGold(col) ? rand(0.10, 0.26) : rand(0.06, 0.18);
            return {
                bx:    bx,
                x:     bx,
                y:     spreadY ? rand(-20, (H || window.innerHeight) + 20) : (H || window.innerHeight) + rand(10, 60),
                kind:  kind,
                r:     kind === 'ring' ? rand(8, 24)
                      : kind === 'dot'  ? rand(2, 6)
                      :                   rand(3, 7),
                spd:   rand(0.28, 0.95),
                dA:    rand(20, 62),      /* drift amplitude px */
                phase: rand(0, Math.PI * 2),
                freq:  rand(0.0004, 0.0014),
                maxA:  mxA,
                alpha: 0,
                col:   col,
                lw:    rand(0.5, 1.6),
                rot:   rand(0, Math.PI * 2),
                rspd:  rand(-0.009, 0.009),
            };
        }

        /* 4-point ✦ star: 8 vertices alternating outer / inner radius */
        function drawSparkle(outer, inner) {
            ctx.beginPath();
            for (var i = 0; i < 8; i++) {
                var ang = (i / 8) * Math.PI * 2 - Math.PI / 2;
                var r   = (i % 2 === 0) ? outer : inner;
                if (i === 0) ctx.moveTo(Math.cos(ang) * r, Math.sin(ang) * r);
                else          ctx.lineTo(Math.cos(ang) * r, Math.sin(ang) * r);
            }
            ctx.closePath();
        }

        function init() {
            resize();
            for (var i = 0; i < N; i++) {
                var p = spawn(true);
                p.alpha = rand(0, p.maxA);
                pool.push(p);
            }
        }

        function frame(ts) {
            ctx.clearRect(0, 0, W, H);

            for (var i = 0; i < pool.length; i++) {
                var p = pool[i];

                /* movement */
                p.y   -= p.spd;
                p.x    = p.bx + Math.sin(ts * p.freq + p.phase) * p.dA;
                p.rot += p.rspd;

                /* vertical fade */
                var prog = 1 - p.y / H;
                p.alpha  = prog < 0.10 ? p.maxA * (prog / 0.10)
                         : prog > 0.82 ? p.maxA * ((1 - prog) / 0.18)
                         : p.maxA;

                /* recycle off top */
                if (p.y < -p.r - 30) {
                    var fresh = spawn(false);
                    Object.assign(p, fresh);
                    p.bx = rand(0, W);
                    p.x  = p.bx;
                    continue;
                }

                /* draw */
                var a = Math.max(0, p.alpha);
                if (a < 0.005) continue;
                ctx.save();
                ctx.globalAlpha = a;

                if (p.kind === 'ring') {
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.strokeStyle = 'rgb(' + p.col + ')';
                    ctx.lineWidth   = p.lw;
                    ctx.stroke();

                } else if (p.kind === 'dot') {
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgb(' + p.col + ')';
                    ctx.fill();

                } else {
                    /* ✦ filled 4-point sparkle — all arms equal */
                    ctx.translate(p.x, p.y);
                    ctx.rotate(p.rot);
                    drawSparkle(p.r * 2.8, p.r * 0.28);
                    ctx.fillStyle = 'rgb(' + p.col + ')';
                    ctx.fill();
                    /* bright centre dot for the sparkle glint */
                    ctx.beginPath();
                    ctx.arc(0, 0, p.r * 0.52, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(255,255,255,.5)';
                    ctx.fill();
                }

                ctx.restore();
            }

            requestAnimationFrame(frame);
        }

        window.addEventListener('resize', function () {
            resize();
            pool.forEach(function (p) { p.bx = Math.min(p.bx, W); p.x = p.bx; });
        });

        init();
        requestAnimationFrame(frame);
    })();
</script>
</body>
</html>
