<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سياسة الخصوصية وشروط الاستخدام | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            background: #1a5c38;
            min-height: 100vh;
            color: #1e293b;
        }

        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }

        /* ==============================
           HERO BANNER
        ============================== */
        .privacy-hero {
            position: relative;
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 50%, #2d6a4f 100%);
            padding: 64px 5% 80px;
            overflow: hidden;
            text-align: center;
        }

        .privacy-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1400&h=400&fit=crop');
            background-size: cover;
            background-position: center;
            filter: brightness(0.12);
        }

        .privacy-hero::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 0; right: 0;
            height: 60px;
            background: #e8f5e9;
            border-radius: 50% 50% 0 0 / 60px 60px 0 0;
        }

        .privacy-hero-content { position: relative; z-index: 1; }

        .privacy-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.22);
            color: #a7f3d0;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 18px;
            border-radius: 30px;
            letter-spacing: 0.07em;
            margin-bottom: 20px;
        }

        .privacy-hero h1 {
            font-size: 38px;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 2px 12px rgba(0,0,0,0.5);
            line-height: 1.3;
            margin-bottom: 14px;
        }

        .privacy-hero p {
            font-size: 15px;
            color: #b8ead0;
            max-width: 560px;
            margin: 0 auto 18px;
            line-height: 1.8;
        }

        .privacy-hero-meta {
            display: inline-flex;
            align-items: center;
            gap: 20px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 30px;
            padding: 8px 22px;
            font-size: 12px;
            color: #a7f3d0;
        }

        .privacy-hero-meta span { display: flex; align-items: center; gap: 6px; }

        /* ==============================
           TABLE OF CONTENTS
        ============================== */
        .privacy-bg {
            background: #e8f5e9;
            padding: 0 5% 60px;
        }

        .privacy-wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        .toc-card {
            background: #fff;
            border-radius: 20px;
            padding: 28px 30px;
            border: 1px solid rgba(15,61,36,0.08);
            box-shadow: 0 6px 24px rgba(15,61,36,0.07);
            transform: translateY(-36px);
            margin-bottom: -8px;
        }

        .toc-title {
            font-size: 14px;
            font-weight: 800;
            color: #0f3d24;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toc-title i { color: #1a5c38; }

        .toc-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .toc-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f0fdf4;
            border: 1px solid #d1fae5;
            border-radius: 10px;
            padding: 10px 14px;
            text-decoration: none;
            color: #1a5c38;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s;
        }

        .toc-item:hover {
            background: #d1fae5;
            border-color: #6ee7b7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26,92,56,0.10);
        }

        .toc-item i { font-size: 14px; color: #2d6a4f; flex-shrink: 0; }
        .toc-num {
            background: #d1fae5;
            color: #065f46;
            font-size: 11px;
            font-weight: 800;
            width: 20px; height: 20px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* ==============================
           MAIN LAYOUT
        ============================== */
        .privacy-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 24px;
            margin-top: 28px;
        }

        /* ==============================
           CONTENT SECTIONS
        ============================== */
        .privacy-section {
            background: #fff;
            border-radius: 20px;
            padding: 32px 30px;
            border: 1px solid rgba(15,61,36,0.07);
            box-shadow: 0 4px 20px rgba(15,61,36,0.06);
            margin-bottom: 20px;
            scroll-margin-top: 80px;
        }

        .privacy-section:last-child { margin-bottom: 0; }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 2px solid #e8f5e9;
        }

        .section-title-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            color: #0f3d24;
            flex-shrink: 0;
        }

        .section-title h2 {
            font-size: 17px;
            font-weight: 800;
            color: #0f3d24;
            line-height: 1.3;
        }

        .section-title .section-num {
            font-size: 11px;
            font-weight: 700;
            color: #6ee7b7;
            background: #f0fdf4;
            border: 1px solid #d1fae5;
            border-radius: 20px;
            padding: 2px 10px;
            margin-right: auto;
        }

        .section-body {
            font-size: 14px;
            color: #374151;
            line-height: 1.9;
        }

        .section-body p { margin-bottom: 14px; }
        .section-body p:last-child { margin-bottom: 0; }

        /* List items */
        .privacy-list {
            list-style: none;
            margin: 14px 0;
        }

        .privacy-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid rgba(15,61,36,0.05);
            font-size: 13.5px;
            color: #374151;
            line-height: 1.7;
        }

        .privacy-list li:last-child { border-bottom: none; }

        .privacy-list li i {
            color: #1a5c38;
            font-size: 14px;
            margin-top: 4px;
            flex-shrink: 0;
        }

        /* Info boxes */
        .info-box {
            border-radius: 12px;
            padding: 16px 18px;
            margin: 16px 0;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 13.5px;
            line-height: 1.7;
        }

        .info-box i { font-size: 18px; flex-shrink: 0; margin-top: 2px; }

        .info-box.green  { background: #f0fdf4; border: 1px solid #bbf7d0; color: #065f46; }
        .info-box.green i  { color: #16a34a; }
        .info-box.blue   { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
        .info-box.blue i   { color: #3b82f6; }
        .info-box.yellow { background: #fefce8; border: 1px solid #fde68a; color: #92400e; }
        .info-box.yellow i { color: #d97706; }
        .info-box.red    { background: #fff1f2; border: 1px solid #fecdd3; color: #9f1239; }
        .info-box.red i    { color: #e11d48; }

        /* Two-column grid inside section */
        .two-col-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 14px 0;
        }

        .mini-card {
            background: #f8fffe;
            border: 1px solid #d1fae5;
            border-radius: 12px;
            padding: 16px;
        }

        .mini-card-title {
            font-size: 13px;
            font-weight: 800;
            color: #0f3d24;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .mini-card-title i { color: #2d6a4f; font-size: 13px; }

        .mini-card p {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.7;
            margin: 0;
        }

        /* ==============================
           STICKY SIDEBAR
        ============================== */
        .privacy-sidebar { display: flex; flex-direction: column; gap: 16px; }

        .sidebar-sticky {
            position: sticky;
            top: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sb-card {
            background: #fff;
            border-radius: 18px;
            padding: 22px 20px;
            border: 1px solid rgba(15,61,36,0.07);
            box-shadow: 0 4px 16px rgba(15,61,36,0.06);
        }

        .sb-card-title {
            font-size: 13px;
            font-weight: 800;
            color: #0f3d24;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: flex-end;
        }

        .sb-card-title i { color: #1a5c38; }

        /* Mini TOC in sidebar */
        .sb-toc-list { list-style: none; }

        .sb-toc-list li { margin-bottom: 4px; }

        .sb-toc-list a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            text-decoration: none;
            color: #374151;
            font-size: 12.5px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .sb-toc-list a:hover {
            background: #f0fdf4;
            color: #1a5c38;
        }

        .sb-toc-list a i { color: #6ee7b7; font-size: 11px; flex-shrink: 0; }

        /* Contact card in sidebar */
        .sb-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(15,61,36,0.06);
            font-size: 13px;
            color: #374151;
        }

        .sb-contact-item:last-child { border-bottom: none; }
        .sb-contact-item i { color: #1a5c38; width: 16px; text-align: center; flex-shrink: 0; }
        .sb-contact-item a { color: #1a5c38; text-decoration: none; font-weight: 700; }
        .sb-contact-item a:hover { text-decoration: underline; }

        /* Date badge */
        .sb-date-badge {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-radius: 12px;
            padding: 14px 16px;
            text-align: center;
            margin-bottom: 12px;
        }

        .sb-date-badge .date-label { font-size: 11px; color: #065f46; font-weight: 700; margin-bottom: 4px; }
        .sb-date-badge .date-val   { font-size: 14px; color: #0f3d24; font-weight: 800; }

        /* Print / share buttons */
        .sb-action-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            border-radius: 10px;
            font-family: 'Cairo', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            margin-bottom: 8px;
        }

        .sb-action-btn.outline {
            background: transparent;
            border: 1.5px solid #a8c9a4;
            color: #1a5c38;
        }

        .sb-action-btn.outline:hover {
            background: #f0fdf4;
            border-color: #1a5c38;
        }

        /* ==============================
           HIGHLIGHT QUOTE
        ============================== */
        .highlight-quote {
            border-right: 4px solid #1a5c38;
            padding: 14px 18px;
            background: #f0fdf4;
            border-radius: 0 10px 10px 0;
            font-size: 14px;
            color: #065f46;
            font-weight: 600;
            line-height: 1.7;
            margin: 16px 0;
            font-style: italic;
        }

        /* ==============================
           LAST SECTION - Contact us
        ============================== */
        .contact-cta {
            background: linear-gradient(135deg, #0f3d24, #1a5c38);
            border-radius: 20px;
            padding: 32px 30px;
            text-align: center;
            color: #fff;
            margin-top: 20px;
        }

        .contact-cta i { font-size: 32px; color: #6ee7b7; margin-bottom: 12px; }
        .contact-cta h3 { font-size: 18px; font-weight: 800; margin-bottom: 10px; }
        .contact-cta p { font-size: 14px; color: #b8ead0; line-height: 1.7; margin-bottom: 20px; }

        .cta-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .cta-btn.primary { background: #fff; color: #0f3d24; }
        .cta-btn.primary:hover { background: #d1fae5; transform: translateY(-2px); }
        .cta-btn.secondary { background: rgba(255,255,255,0.12); color: #fff; border: 1px solid rgba(255,255,255,0.25); }
        .cta-btn.secondary:hover { background: rgba(255,255,255,0.22); transform: translateY(-2px); }

        /* ==============================
           RESPONSIVE
        ============================== */
        @media (max-width: 1000px) {
            .privacy-layout { grid-template-columns: 1fr; }
            .sidebar-sticky { position: static; }
            .toc-grid { grid-template-columns: repeat(2, 1fr); }
            .two-col-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            .privacy-hero h1 { font-size: 26px; }
            .toc-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
            .toc-card { padding: 20px 16px; }
            .privacy-section { padding: 22px 16px; }
            .privacy-hero-meta { flex-direction: column; gap: 8px; }
        }

        @media print {
            .privacy-sidebar, .top-bar, .site-footer, .whatsapp-float, .contact-cta { display: none !important; }
            .privacy-layout { grid-template-columns: 1fr; }
            .privacy-section { box-shadow: none; border: 1px solid #ddd; }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

<!-- ===== HERO ===== -->
<div class="privacy-hero">
    <div class="privacy-hero-content">
        <div class="privacy-hero-badge">
            <i class="fa fa-file-contract"></i>
            سياسات وشروط الاستخدام
        </div>
        <h1>سياسات وشروط استخدام منصة آمر تم للمناسبات</h1>
        <p>يُعد استخدام المنصة أو التسجيل فيها موافقةً نهائية وملزمة على جميع الشروط والسياسات الواردة في هذه الوثيقة.</p>
        <div class="privacy-hero-meta">
            <span><i class="fa fa-calendar-check"></i> آخر تحديث: 2026</span>
            <span><i class="fa fa-scale-balanced"></i> سارية المفعول</span>
            <span><i class="fa fa-globe"></i> المملكة العربية السعودية</span>
        </div>
    </div>
</div>

<!-- ===== CONTENT ===== -->
<div class="privacy-bg">
    <div class="privacy-wrapper">

        <!-- TABLE OF CONTENTS -->
        <div class="toc-card">
            <div class="toc-title"><i class="fa fa-list-ul"></i> محتويات هذه الصفحة</div>
            <div class="toc-grid">
                <a href="#sec-intro" class="toc-item"><span class="toc-num">م</span><i class="fa fa-info-circle"></i> مقدمة</a>
                <a href="#sec-1"     class="toc-item"><span class="toc-num">1</span><i class="fa-regular fa-globe-www"></i> طبيعة عمل المنصة</a>
                <a href="#sec-2"     class="toc-item"><span class="toc-num">2</span><i class="fa fa-user-tie"></i> مسؤولية المنشآت</a>
                <a href="#sec-3"     class="toc-item"><span class="toc-num">3</span><i class="fa fa-shield-halved"></i> إخلاء المسؤولية</a>
                <a href="#sec-4"     class="toc-item"><span class="toc-num">4</span><i class="fa fa-calendar-check"></i> الحجز والدفع</a>
                <a href="#sec-5"     class="toc-item"><span class="toc-num">5</span><i class="fa fa-laptop"></i> سياسة الاستخدام</a>
                <a href="#sec-6"     class="toc-item"><span class="toc-num">6</span><i class="fa fa-lock"></i> سياسة الخصوصية</a>
                <a href="#sec-7"     class="toc-item"><span class="toc-num">7</span><i class="fa fa-photo-film"></i> المحتوى والتقييمات</a>
                <a href="#sec-8"     class="toc-item"><span class="toc-num">8</span><i class="fa fa-fire-extinguisher"></i> الأمن والسلامة</a>
                <a href="#sec-9"     class="toc-item"><span class="toc-num">9</span><i class="fa fa-building"></i> المناسبات والتجمعات</a>
                <a href="#sec-10"    class="toc-item"><span class="toc-num">10</span><i class="fa fa-cloud-bolt"></i> القوة القاهرة</a>
                <a href="#sec-11"    class="toc-item"><span class="toc-num">11</span><i class="fa fa-server"></i> التقنية والاستضافة</a>
                <a href="#sec-12"    class="toc-item"><span class="toc-num">12</span><i class="fa fa-handshake"></i> العلاقة التعاقدية</a>
                <a href="#sec-13"    class="toc-item"><span class="toc-num">13</span><i class="fa fa-scale-balanced"></i> التعويض وإبراء الذمة</a>
                <a href="#sec-14"    class="toc-item"><span class="toc-num">14</span><i class="fa fa-gavel"></i> الاختصاص القضائي</a>
                <a href="#sec-15"    class="toc-item"><span class="toc-num">15</span><i class="fa fa-pen-to-square"></i> التعديلات على السياسات</a>
                <a href="#sec-16"    class="toc-item"><span class="toc-num">16</span><i class="fa fa-circle-check"></i> الموافقة الإلكترونية</a>
                <a href="#sec-17"    class="toc-item"><span class="toc-num">17</span><i class="fa fa-robot"></i> الذكاء الاصطناعي</a>
                <a href="#sec-18"    class="toc-item"><span class="toc-num">18</span><i class="fa fa-file-signature"></i> الإقرار الإلكتروني</a>
                <a href="#sec-19"    class="toc-item"><span class="toc-num">19</span><i class="fa fa-headset"></i> التواصل والاستفسارات</a>
            </div>
        </div>

        <!-- MAIN LAYOUT -->
        <div class="privacy-layout">

            <!-- ===== LEFT: SECTIONS ===== -->
            <div>

                <!-- مقدمة -->
                <div class="privacy-section" id="sec-intro">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-info-circle"></i></div>
                        <h2>مقدمة</h2>
                        <span class="section-num">تمهيد</span>
                    </div>
                    <div class="section-body">
                        <p>تُعد منصة <strong>آمر تم</strong> لخدمات الأعمال منصة إلكترونية تقنية متخصصة في استضافة وإدارة صفحات القاعات والاستراحات والشاليهات وقاعات المحاضرات والمنشآت والخدمات المشابهة، حيث يتم منح كل منشأة لوحة تحكم مستقلة لإدارة بياناتها وحجوزاتها وعملائها ومحتواها وخدماتها بشكل مستقل.</p>
                        <p>ويقتصر دور المنصة على تقديم الخدمات التقنية والإلكترونية والتنظيمية الخاصة بالاستضافة الرقمية وإدارة المحتوى والحجوزات إلكترونياً، دون أي تدخل تشغيلي أو إداري أو إشرافي مباشر على المنشآت أو الخدمات المقدمة من خلالها.</p>
                        <div class="info-box green">
                            <i class="fa fa-circle-check"></i>
                            <span>يُعد استخدام المنصة أو التسجيل فيها أو رفع المحتوى أو إنشاء الحساب أو إجراء أي عملية حجز أو تعامل إلكتروني <strong>موافقة نهائية وكاملة وملزمة</strong> على جميع الشروط والسياسات والأحكام الواردة في هذه الوثيقة.</span>
                        </div>
                    </div>
                </div>

                <!-- القسم 1 -->
                <div class="privacy-section" id="sec-1">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-building"></i></div>
                        <h2>أولاً: طبيعة عمل منصة آمر تم</h2>
                        <span class="section-num">القسم 1</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-circle-info"></i><span>منصة آمر تم <strong>ليست مالكة أو مشغلة أو مديرة</strong> للقاعات أو الاستراحات أو الشاليهات أو مواقع المناسبات أو أي منشآت يتم عرضها داخل المنصة.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>يقتصر دور المنصة على توفير الاستضافة الإلكترونية والخدمات التقنية ولوحات التحكم وإدارة العرض الإلكتروني للحجوزات والخدمات والمحتوى.</span></li>
                        </ul>
                        <p style="margin-top:14px;"><strong>تتحمل كل منشأة أو مقدم خدمة كامل المسؤولية المستقلة عن:</strong></p>
                        <div class="two-col-grid">
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-calendar-check"></i> التشغيل والحجوزات</div>
                                <p>إدارة الحجوزات، التواصل مع العملاء، التشغيل والإدارة اليومية.</p>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-tag"></i> الأسعار والعقود</div>
                                <p>الأسعار والعروض والباقات، العقود والاتفاقيات مع العملاء.</p>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-shield-halved"></i> الأمن والتراخيص</div>
                                <p>النظافة والتجهيزات، الأمن والسلامة، التراخيص والتصاريح النظامية.</p>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-gavel"></i> الالتزامات القانونية</div>
                                <p>جودة الخدمات المقدمة وأي التزامات قانونية أو تشغيلية أو مالية مرتبطة بالنشاط.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- القسم 2 -->
                <div class="privacy-section" id="sec-2">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-user-tie"></i></div>
                        <h2>ثانياً: مسؤولية المنشآت ومقدمي الخدمة</h2>
                        <span class="section-num">القسم 2</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>يتحمل مالك المنشأة أو مشغلها أو مقدم الخدمة كامل المسؤولية النظامية والقانونية والتشغيلية أمام العملاء والجهات الرسمية.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تلتزم جميع المنشآت بالحصول على كافة التراخيص والتصاريح والموافقات اللازمة من الجهات المختصة قبل ممارسة النشاط أو الإعلان عنه عبر المنصة.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تتحمل المنشأة وحدها أي مخالفات أو مطالبات أو نزاعات أو أضرار أو التزامات تنتج عن نشاطها أو خدماتها أو تعاملاتها مع العملاء.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تلتزم المنشأة بصحة ودقة جميع البيانات والمعلومات والصور والأسعار والمحتوى المنشور داخل صفحاتها.</span></li>
                        </ul>
                        <div class="info-box red">
                            <i class="fa fa-ban"></i>
                            <span>يُمنع نشر أي معلومات مضللة أو مخالفة للواقع أو مخالفة للأنظمة والتعليمات المعمول بها في المملكة العربية السعودية.</span>
                        </div>
                    </div>
                </div>

                <!-- القسم 3 -->
                <div class="privacy-section" id="sec-3">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-shield-halved"></i></div>
                        <h2>ثالثاً: إخلاء مسؤولية منصة آمر تم</h2>
                        <span class="section-num">القسم 3</span>
                    </div>
                    <div class="section-body">
                        <p>يقر جميع المستخدمين والمنشآت والعملاء بأن منصة آمر تم:</p>
                        <ul class="privacy-list">
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تتحمل أي مسؤولية عن جودة الخدمات أو مستوى التشغيل أو التزام المنشآت أو مقدمي الخدمات.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تتحمل أي مسؤولية عن الإلغاء أو التأخير أو سوء التنظيم أو ضعف الخدمة أو الأعطال أو الخلافات أو النزاعات بين الأطراف.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تتحمل أي مسؤولية عن الأضرار الجسدية أو المالية أو المعنوية أو القانونية الناتجة عن استخدام المنشآت أو الخدمات أو التعامل معها.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تتحمل أي مسؤولية عن فقدان الممتلكات أو الإصابات أو الحوادث أو المخالفات داخل المنشآت أو أثناء الفعاليات والمناسبات.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تتحمل أي التزامات مالية أو تعويضات أو التزامات تعاقدية تنشأ بين العميل والمنشأة أو أي طرف آخر.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تعتبر طرفاً في أي عقد أو اتفاق أو تفاهم يتم بين العميل والمنشأة أو مقدم الخدمة.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تضمن صحة أو دقة أو موثوقية الصور أو المعلومات أو العروض أو الأسعار المنشورة من قبل المنشآت.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>يقتصر دورها على توفير وسيلة إلكترونية وتقنية لعرض الخدمات وربط الأطراف إلكترونياً فقط.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 4 -->
                <div class="privacy-section" id="sec-4">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-calendar-check"></i></div>
                        <h2>رابعاً: سياسة الحجز والدفع</h2>
                        <span class="section-num">القسم 4</span>
                    </div>
                    <div class="section-body">
                        <p>تتم إدارة الحجوزات والمدفوعات والإلغاءات والاسترجاع وفق السياسة الخاصة بكل منشأة أو مقدم خدمة.</p>
                        <p style="margin-top:12px;"><strong>يتحمل مقدم الخدمة وحده مسؤولية:</strong></p>
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>تأكيد الحجوزات واستلام المدفوعات وإصدار الفواتير.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>إدارة الإلغاء والاسترجاع وتعديل المواعيد.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تنفيذ الاتفاقيات الخاصة بالحجز.</span></li>
                        </ul>
                        <div class="info-box yellow">
                            <i class="fa fa-triangle-exclamation"></i>
                            <span>لا تتحمل منصة آمر تم أي مسؤولية عن النزاعات المالية أو عمليات الدفع أو التأخير أو الاسترجاع بين الأطراف. قد يتم ربط خدمات الدفع عبر مزودي خدمات دفع خارجيين، ولا تتحمل المنصة أي مسؤولية عن الأعطال البنكية أو التقنية أو تأخر التحويلات الخارجة عن إرادتها.</span>
                        </div>
                    </div>
                </div>

                <!-- القسم 5 -->
                <div class="privacy-section" id="sec-5">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-laptop"></i></div>
                        <h2>خامساً: سياسة الاستخدام</h2>
                        <span class="section-num">القسم 5</span>
                    </div>
                    <div class="section-body">
                        <p>يلتزم جميع المستخدمين والمنشآت بما يلي:</p>
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>استخدام المنصة بشكل نظامي ومشروع ومتوافق مع الأنظمة المعمول بها في المملكة العربية السعودية.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>عدم إساءة استخدام المنصة أو محاولة اختراقها أو تعطيلها أو التأثير على أنظمتها التقنية.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>عدم نشر أو رفع أو تداول أي محتوى مخالف للأنظمة أو الآداب العامة أو حقوق الغير.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>يُمنع استخدام المنصة في غسل الأموال، الاحتيال، التشهير أو الإساءة للغير، نشر المحتوى غير الأخلاقي، أو أي نشاط يضر بسمعة المنصة أو مستخدميها.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>الالتزام بكافة الأنظمة والتعليمات الرسمية ذات العلاقة.</span></li>
                        </ul>
                        <div class="info-box red">
                            <i class="fa fa-gavel"></i>
                            <span>يحق للمنصة دون إشعار مسبق: حذف أو تعليق أو إيقاف أي حساب مخالف، إزالة أي محتوى مخالف أو مضلل أو غير مناسب، وإيقاف أي منشأة تخالف الأنظمة أو السياسات أو التعليمات المعتمدة.</span>
                        </div>
                    </div>
                </div>

                <!-- القسم 6 -->
                <div class="privacy-section" id="sec-6">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-lock"></i></div>
                        <h2>سادساً: سياسة الخصوصية</h2>
                        <span class="section-num">القسم 6</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-shield-halved"></i><span>تلتزم منصة آمر تم بحماية البيانات الشخصية وفق الأنظمة المعمول بها في المملكة العربية السعودية.</span></li>
                            <li><i class="fa fa-shield-halved"></i><span>يتم استخدام البيانات للأغراض التشغيلية والتقنية والخدمية المتعلقة بالمنصة فقط.</span></li>
                            <li><i class="fa fa-shield-halved"></i><span>يجوز الإفصاح عن البيانات عند وجود طلب رسمي من الجهات المختصة أو إذا تطلب النظام ذلك.</span></li>
                            <li><i class="fa fa-shield-halved"></i><span>يتحمل المستخدم مسؤولية المحافظة على بيانات الدخول الخاصة بحسابه وعدم مشاركتها مع الآخرين.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 7 -->
                <div class="privacy-section" id="sec-7">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-photo-film"></i></div>
                        <h2>سابعاً: سياسة المحتوى والتقييمات</h2>
                        <span class="section-num">القسم 7</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>يحق للمستخدمين إضافة التقييمات والمراجعات وفق ضوابط المنصة.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تتحمل المنشآت ومقدمو الخدمات كامل المسؤولية عن جميع البيانات والصور والفيديوهات والمعلومات والمحتوى المنشور داخل صفحاتهم.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>يقر مقدم الخدمة بامتلاكه الحق النظامي والقانوني لاستخدام الصور والفيديوهات والشعارات والمحتوى المرفوع على المنصة.</span></li>
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>يُمنع نشر أي محتوى ينتهك حقوق الملكية الفكرية أو حقوق الغير أو الأنظمة المعمول بها.</span></li>
                            <li><i class="fa fa-gavel"></i><span>يحق للمنصة حذف أي محتوى مخالف أو مضلل أو مسيء دون الرجوع لصاحبه.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 8 -->
                <div class="privacy-section" id="sec-8">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-fire-extinguisher"></i></div>
                        <h2>ثامناً: اشتراطات الأمن والسلامة</h2>
                        <span class="section-num">القسم 8</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>تتحمل المنشأة وحدها مسؤولية تطبيق جميع متطلبات الأمن والسلامة والدفاع المدني والاشتراطات النظامية ذات العلاقة بالنشاط.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تتحمل المنشأة مسؤولية أي إصابات أو حوادث أو مخالفات أو أضرار تقع داخل الموقع أو أثناء تقديم الخدمة أو إقامة الفعاليات.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 9 -->
                <div class="privacy-section" id="sec-9">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-champagne-glasses"></i></div>
                        <h2>تاسعاً: اشتراطات المناسبات والتجمعات</h2>
                        <span class="section-num">القسم 9</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>يلتزم مقدم الخدمة والعميل بعدم إقامة أي فعاليات أو مناسبات مخالفة للأنظمة أو التعليمات الرسمية.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تتحمل المنشأة مسؤولية استخراج أي تصاريح أو موافقات لازمة للفعاليات أو الأنشطة الخاصة.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 10 -->
                <div class="privacy-section" id="sec-10">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-cloud-bolt"></i></div>
                        <h2>عاشراً: القوة القاهرة</h2>
                        <span class="section-num">القسم 10</span>
                    </div>
                    <div class="section-body">
                        <p>لا تتحمل منصة آمر تم أي مسؤولية عن تعطل الخدمات أو إلغاء الحجوزات أو أي خسائر أو أضرار ناتجة عن ظروف خارجة عن الإرادة، بما في ذلك:</p>
                        <ul class="privacy-list">
                            <li><i class="fa fa-circle-info"></i><span>الكوارث الطبيعية.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>الأعطال التقنية.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>انقطاع الإنترنت أو الكهرباء.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>القرارات الحكومية.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>الظروف الأمنية أو الطارئة.</span></li>
                            <li><i class="fa fa-circle-info"></i><span>أي أحداث خارجة عن السيطرة المباشرة للمنصة.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 11 -->
                <div class="privacy-section" id="sec-11">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-server"></i></div>
                        <h2>الحادي عشر: اشتراطات التقنية والاستضافة</h2>
                        <span class="section-num">القسم 11</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>تقدم المنصة خدماتها التقنية وفق الإمكانيات الفنية والتشغيلية المتاحة.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>لا تضمن المنصة عدم الانقطاع المؤقت أو الأعطال التقنية الخارجة عن إرادتها.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>يحق للمنصة إجراء التحديثات والصيانة الدورية والتطويرات التقنية متى دعت الحاجة دون تحمل أي مسؤولية عن التوقف المؤقت للخدمة.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 12 -->
                <div class="privacy-section" id="sec-12">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-handshake"></i></div>
                        <h2>الثاني عشر: اشتراطات العلاقة التعاقدية</h2>
                        <span class="section-num">القسم 12</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-circle-xmark" style="color:#dc2626;"></i><span>لا تنشأ أي علاقة شراكة أو وكالة أو توظيف أو تمثيل قانوني بين منصة آمر تم والمنشآت أو العملاء أو مقدمي الخدمات.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>تعتبر العلاقة مباشرة ومستقلة بين العميل والمنشأة أو مقدم الخدمة فقط.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 13 -->
                <div class="privacy-section" id="sec-13">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-scale-balanced"></i></div>
                        <h2>الثالث عشر: اشتراطات التعويض وإبراء الذمة</h2>
                        <span class="section-num">القسم 13</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>يوافق المستخدم والمنشأة ومقدم الخدمة على إبراء ذمة منصة آمر تم من أي مطالبات أو خسائر أو أضرار أو نزاعات تنشأ بين الأطراف نتيجة استخدام المنصة أو الخدمات المقدمة عبرها.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>يتحمل مقدم الخدمة كامل المسؤولية القانونية والمالية والتشغيلية عن نشاطه وخدماته وتعاملاته.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 14 -->
                <div class="privacy-section" id="sec-14">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-gavel"></i></div>
                        <h2>الرابع عشر: الاختصاص القضائي</h2>
                        <span class="section-num">القسم 14</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>تخضع هذه السياسات والشروط لأنظمة المملكة العربية السعودية.</span></li>
                            <li><i class="fa fa-gavel"></i><span>تكون الجهات القضائية المختصة داخل المملكة العربية السعودية هي المرجع الوحيد للنظر في أي نزاع يتعلق باستخدام المنصة أو الخدمات المقدمة من خلالها.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 15 -->
                <div class="privacy-section" id="sec-15">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-pen-to-square"></i></div>
                        <h2>الخامس عشر: التعديلات على السياسات</h2>
                        <span class="section-num">القسم 15</span>
                    </div>
                    <div class="section-body">
                        <ul class="privacy-list">
                            <li><i class="fa fa-check-circle"></i><span>تحتفظ منصة آمر تم بحق تعديل أو تحديث أو إضافة أي شروط أو سياسات في أي وقت دون إشعار مسبق.</span></li>
                            <li><i class="fa fa-check-circle"></i><span>يعد استمرار استخدام المنصة بعد التعديلات موافقة نهائية على جميع التحديثات الجديدة.</span></li>
                        </ul>
                    </div>
                </div>

                <!-- القسم 16 -->
                <div class="privacy-section" id="sec-16">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-circle-check"></i></div>
                        <h2>السادس عشر: الموافقة الإلكترونية</h2>
                        <span class="section-num">القسم 16</span>
                    </div>
                    <div class="section-body">
                        <div class="info-box green">
                            <i class="fa fa-circle-check"></i>
                            <span>يعتبر استخدام المنصة أو التسجيل أو إنشاء الحساب أو رفع المحتوى أو إجراء الحجز أو الاستمرار باستخدام الخدمات <strong>موافقة إلكترونية نهائية وملزمة</strong> على جميع الشروط والسياسات والأحكام الواردة في هذه الوثيقة.</span>
                        </div>
                    </div>
                </div>

                <!-- القسم 17 -->
                <div class="privacy-section" id="sec-17">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-robot"></i></div>
                        <h2>السابع عشر: خدمات وتقنيات الذكاء الاصطناعي</h2>
                        <span class="section-num">القسم 17</span>
                    </div>
                    <div class="section-body">
                        <p>يجوز لمنصة آمر تم استخدام تقنيات الذكاء الاصطناعي لتحسين جودة الخدمات ورفع كفاءة التشغيل والحماية التقنية، ويشمل ذلك على سبيل المثال لا الحصر:</p>
                        <div class="two-col-grid">
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-comments"></i> خدمة العملاء</div>
                                <p>الردود الآلية وخدمة العملاء الذكية والربط مع تطبيقات التواصل وخدمات الرد الآلي.</p>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-magnifying-glass"></i> الاقتراح والتحليل</div>
                                <p>اقتراح القاعات والخدمات المناسبة وتحليل الحجوزات ونسب الإشغال والإحصائيات الذكية.</p>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-shield-halved"></i> الحماية والمراقبة</div>
                                <p>كشف المحتوى المخالف أو الحسابات الوهمية أو التقييمات غير الحقيقية.</p>
                            </div>
                            <div class="mini-card">
                                <div class="mini-card-title"><i class="fa fa-file-invoice"></i> الأتمتة والترجمة</div>
                                <p>إنشاء العقود والإقرارات والفواتير والرسائل التلقائية، والترجمة الذكية متعددة اللغات.</p>
                            </div>
                        </div>
                        <div class="info-box blue">
                            <i class="fa fa-robot"></i>
                            <span>يحق للمنصة استخدام الأنظمة الذكية لمراقبة المحتوى وحذف أو تعليق أي نشاط مخالف للأنظمة أو السياسات المعتمدة.</span>
                        </div>
                    </div>
                </div>

                <!-- القسم 18 -->
                <div class="privacy-section" id="sec-18">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-file-signature"></i></div>
                        <h2>الثامن عشر: الإقرار الإلكتروني الذكي</h2>
                        <span class="section-num">القسم 18</span>
                    </div>
                    <div class="section-body">
                        <p>يقر جميع مقدمي الخدمات والمنشآت عند التسجيل أو رفع المحتوى أو نشر الإعلانات بما يلي:</p>
                        <div class="highlight-quote">
                            "أقر بأن جميع التراخيص والموافقات والتصاريح الخاصة بالنشاط سارية وصحيحة، وأنني أتحمل كامل المسؤولية القانونية والتشغيلية والمالية عن المنشأة والخدمات المقدمة، وأوافق على جميع سياسات وشروط منصة آمر تم."
                        </div>
                    </div>
                </div>

                <!-- القسم 19 -->
                <div class="privacy-section" id="sec-19">
                    <div class="section-title">
                        <div class="section-title-icon"><i class="fa fa-headset"></i></div>
                        <h2>التاسع عشر: التواصل والاستفسارات</h2>
                        <span class="section-num">القسم 19</span>
                    </div>
                    <div class="section-body">
                        <div class="info-box green">
                            <i class="fa fa-building"></i>
                            <span><strong>مؤسسة آمر تم لخدمات الأعمال (آمر تم)</strong></span>
                        </div>
                        <div class="sb-contact-item" style="padding:12px 0;border-bottom:1px solid rgba(15,61,36,0.06);">
                            <i class="fa fa-envelope" style="color:#1a5c38;width:20px;flex-shrink:0;"></i>
                            <a href="mailto:info@amrtm.com.sa" style="color:#1a5c38;font-weight:700;text-decoration:none;">info@amrtm.com.sa</a>
                        </div>
                        <div class="sb-contact-item" style="padding:12px 0;">
                            <i class="fab fa-whatsapp" style="color:#1a5c38;width:20px;flex-shrink:0;"></i>
                            <a href="https://wa.me/966504915222" style="color:#1a5c38;font-weight:700;text-decoration:none;">+966 50 491 5222</a>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="contact-cta">
                    <i class="fa fa-comments"></i>
                    <h3>هل لديك استفسار حول الشروط والسياسات؟</h3>
                    <p>فريقنا مستعد للإجابة على جميع تساؤلاتك المتعلقة بشروط الاستخدام وسياسات المنصة.</p>
                    <div class="cta-btns">
                        <a href="{{ route('contact') }}" class="cta-btn primary">
                            <i class="fa fa-envelope"></i> تواصل معنا
                        </a>
                        <a href="mailto:info@amrtm.com.sa" class="cta-btn secondary">
                            <i class="fa fa-at"></i> info@amrtm.com.sa
                        </a>
                    </div>
                </div>

            </div>

            <!-- ===== RIGHT: STICKY SIDEBAR ===== -->
            <div class="privacy-sidebar">
                <div class="sidebar-sticky">

                    <!-- Mini TOC -->
                    <div class="sb-card">
                        <div class="sb-card-title">محتويات الصفحة <i class="fa fa-list-ul"></i></div>
                        <ul class="sb-toc-list">
                            <li><a href="#sec-intro"><i class="fa fa-chevron-left"></i> مقدمة</a></li>
                            <li><a href="#sec-1"><i class="fa fa-chevron-left"></i> 1. طبيعة عمل المنصة</a></li>
                            <li><a href="#sec-2"><i class="fa fa-chevron-left"></i> 2. مسؤولية المنشآت</a></li>
                            <li><a href="#sec-3"><i class="fa fa-chevron-left"></i> 3. إخلاء المسؤولية</a></li>
                            <li><a href="#sec-4"><i class="fa fa-chevron-left"></i> 4. الحجز والدفع</a></li>
                            <li><a href="#sec-5"><i class="fa fa-chevron-left"></i> 5. سياسة الاستخدام</a></li>
                            <li><a href="#sec-6"><i class="fa fa-chevron-left"></i> 6. سياسة الخصوصية</a></li>
                            <li><a href="#sec-7"><i class="fa fa-chevron-left"></i> 7. المحتوى والتقييمات</a></li>
                            <li><a href="#sec-8"><i class="fa fa-chevron-left"></i> 8. الأمن والسلامة</a></li>
                            <li><a href="#sec-9"><i class="fa fa-chevron-left"></i> 9. المناسبات والتجمعات</a></li>
                            <li><a href="#sec-10"><i class="fa fa-chevron-left"></i> 10. القوة القاهرة</a></li>
                            <li><a href="#sec-11"><i class="fa fa-chevron-left"></i> 11. التقنية والاستضافة</a></li>
                            <li><a href="#sec-12"><i class="fa fa-chevron-left"></i> 12. العلاقة التعاقدية</a></li>
                            <li><a href="#sec-13"><i class="fa fa-chevron-left"></i> 13. التعويض وإبراء الذمة</a></li>
                            <li><a href="#sec-14"><i class="fa fa-chevron-left"></i> 14. الاختصاص القضائي</a></li>
                            <li><a href="#sec-15"><i class="fa fa-chevron-left"></i> 15. التعديلات على السياسات</a></li>
                            <li><a href="#sec-16"><i class="fa fa-chevron-left"></i> 16. الموافقة الإلكترونية</a></li>
                            <li><a href="#sec-17"><i class="fa fa-chevron-left"></i> 17. الذكاء الاصطناعي</a></li>
                            <li><a href="#sec-18"><i class="fa fa-chevron-left"></i> 18. الإقرار الإلكتروني</a></li>
                            <li><a href="#sec-19"><i class="fa fa-chevron-left"></i> 19. التواصل والاستفسارات</a></li>
                        </ul>
                    </div>

                    <!-- Last Update -->
                    <div class="sb-card">
                        <div class="sb-card-title">معلومات السياسة <i class="fa fa-circle-info"></i></div>
                        <div class="sb-date-badge">
                            <div class="date-label">آخر تحديث</div>
                            <div class="date-val">مايو 2026</div>
                        </div>
                        <div class="sb-contact-item">
                            <i class="fa fa-globe"></i>
                            <span>الولاية القضائية: المملكة العربية السعودية</span>
                        </div>
                        <div class="sb-contact-item">
                            <i class="fa fa-language"></i>
                            <span>اللغة السارية: العربية</span>
                        </div>
                        <div class="sb-contact-item">
                            <i class="fa fa-rotate"></i>
                            <span>تراجع هذه السياسة بانتظام</span>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="sb-card">
                        <div class="sb-card-title">تواصل معنا <i class="fa fa-headset"></i></div>
                        <div class="sb-contact-item">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:info@amrtm.com.sa">info@amrtm.com.sa</a>
                        </div>
                        <div class="sb-contact-item">
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/966504915222">+966 50 491 5222</a>
                        </div>
                        <div class="sb-contact-item">
                            <i class="fa fa-location-dot"></i>
                            <span>جدة — حي الحمراء</span>
                        </div>
                        <button class="sb-action-btn outline" onclick="window.print()">
                            <i class="fa fa-print"></i> طباعة السياسة
                        </button>
                    </div>

                </div>
            </div>

        </div><!-- /.privacy-layout -->

    </div><!-- /.privacy-wrapper -->
</div><!-- /.privacy-bg -->

@include('partials.footer')

<script>
    // Smooth scroll for TOC links
    document.querySelectorAll('a[href^="#sec-"]').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Highlight active section in sidebar TOC on scroll
    const sections = document.querySelectorAll('.privacy-section[id]');
    const sbLinks  = document.querySelectorAll('.sb-toc-list a');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                sbLinks.forEach(l => l.style.background = '');
                const active = document.querySelector(`.sb-toc-list a[href="#${entry.target.id}"]`);
                if (active) active.style.background = '#d1fae5';
            }
        });
    }, { rootMargin: '-20% 0px -70% 0px' });

    sections.forEach(s => observer.observe(s));
</script>

</body>
</html>
