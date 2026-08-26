@php
    $locale = app()->getLocale();
    $dir    = $locale === 'ar' ? 'rtl' : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختيار التصميم — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            background: #f0f2f8;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        .chooser-header {
            text-align: center;
            margin-bottom: 48px;
            max-width: 700px;
        }

        .chooser-header img {
            height: 72px;
            margin-bottom: 20px;
        }

        .chooser-header h1 {
            font-size: 2rem;
            font-weight: 900;
            color: #0A1F2C;
            margin-bottom: 12px;
        }

        .chooser-header p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.8;
        }

        .chooser-badge {
            display: inline-block;
            background: linear-gradient(135deg, #006C35, #00854A);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .proposals-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            max-width: 1200px;
            width: 100%;
        }

        @media (max-width: 900px) {
            .proposals-grid { grid-template-columns: 1fr; max-width: 480px; }
        }

        .proposal-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            transition: all 0.35s ease;
            position: relative;
        }

        .proposal-card:hover {
            transform: translateY(-8px);
            border-color: #006C35;
            box-shadow: 0 20px 50px rgba(0, 108, 53, 0.15);
        }

        .proposal-preview {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .proposal-card:nth-child(1) .proposal-preview {
            background: linear-gradient(135deg, #0A1F2C, #006C35);
        }

        .proposal-card:nth-child(2) .proposal-preview {
            background: linear-gradient(135deg, #F7F8FC, #E8EAF0);
        }

        .proposal-card:nth-child(3) .proposal-preview {
            background: linear-gradient(135deg, #0D1117, #161B22);
        }

        .preview-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.15;
        }

        .preview-card:nth-child(1) .preview-pattern {
            background: repeating-conic-gradient(#fff 0% 25%, transparent 0% 50%) 50% / 20px 20px;
        }

        .proposal-card:nth-child(2) .preview-pattern {
            background: repeating-linear-gradient(45deg, #C5A55A 0px, #C5A55A 1px, transparent 1px, transparent 12px);
        }

        .proposal-card:nth-child(3) .preview-pattern {
            background: linear-gradient(0deg, transparent 48%, rgba(0,212,170,0.3) 49%, transparent 51%);
            background-size: 100% 8px;
        }

        .preview-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            padding: 20px;
        }

        .proposal-card:nth-child(2) .preview-content { color: #0A1F2C; }

        .preview-content i {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
        }

        .proposal-card:nth-child(2) .preview-content i { color: #006C35; }

        .preview-content h3 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .preview-content span {
            font-size: 13px;
            opacity: 0.8;
        }

        .proposal-number {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 15px;
            color: #fff;
        }

        .proposal-card:nth-child(2) .proposal-number {
            background: rgba(0,108,53,0.15);
            color: #006C35;
        }

        .proposal-body {
            padding: 24px;
        }

        .proposal-body h4 {
            font-size: 16px;
            font-weight: 800;
            color: #0A1F2C;
            margin-bottom: 8px;
        }

        .proposal-body p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .proposal-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 18px;
        }

        .proposal-tag {
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 12px;
        }

        .proposal-tag.green {
            background: #dcfce7;
            color: #006C35;
        }

        .btn-view {
            display: block;
            width: 100%;
            text-align: center;
            background: linear-gradient(135deg, #006C35, #00854A);
            color: #fff;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            font-weight: 800;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,108,53,0.3);
        }

        .back-link {
            margin-top: 32px;
            color: #64748b;
            font-size: 14px;
            text-decoration: none;
        }

        .back-link:hover { color: #006C35; }
    </style>
</head>
<body>

    <div class="chooser-header">
        <img src="{{ asset('images/new-logo1.png') }}" alt="أمر تم">
        <div class="chooser-badge"><i class="fas fa-palette" style="margin-left:6px;"></i> اختيار التصميم</div>
        <h1>اختر التصميم المناسب للصفحة الرئيسية</h1>
        <p>ثلاثة مقترحات تصميمية مع الهوية السعودية ورؤية 2030 — اختر الأنسب ل project أمر تم</p>
    </div>

    <div class="proposals-grid">

        <!-- Proposal 1 -->
        <div class="proposal-card">
            <div class="proposal-preview">
                <div class="preview-pattern"></div>
                <div class="proposal-number">1</div>
                <div class="preview-content">
                    <i class="fas fa-rocket"></i>
                    <h3>عصري مع Vision 2030</h3>
                    <span>Modern Dashboard</span>
                </div>
            </div>
            <div class="proposal-body">
                <h4>المقترح الأول: لوحة تحكم عصرية</h4>
                <p>تصميم كامل الشاشة مع خلفية متدرجة بألوان العلم السعودي، جزيئات متحركة، بطاقاتخدمات بتأثيرات hover أنيقة، قسم إحصائيات، وقسم رؤية 2030.</p>
                <div class="proposal-tags">
                    <span class="proposal-tag green">أخضر سعودي</span>
                    <span class="proposal-tag">جزيئات متحركة</span>
                    <span class="proposal-tag">رؤية 2030</span>
                    <span class="proposal-tag">أرقام متحركة</span>
                </div>
                <a href="{{ url('/home/proposal/1') }}" class="btn-view">
                    <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
                </a>
            </div>
        </div>

        <!-- Proposal 2 -->
        <div class="proposal-card">
            <div class="proposal-preview">
                <div class="preview-pattern"></div>
                <div class="proposal-number">2</div>
                <div class="preview-content">
                    <i class="fas fa-gem"></i>
                    <h3>هوية هندسية سعودية</h3>
                    <span>Geometric Identity</span>
                </div>
            </div>
            <div class="proposal-body">
                <h4>المقترح الثاني: نقوش هندسية إسلامية</h4>
                <p>تصميم فاخر بألوان أخضر + ذهبي مع بطاقات مقوسة بشكل القناطر الإسلامية، أنماط هندسية متكررة، وفواصل ذهبية أنيقة.</p>
                <div class="proposal-tags">
                    <span class="proposal-tag green">أخضر + ذهبي</span>
                    <span class="proposal-tag">زخارف إسلامية</span>
                    <span class="proposal-tag">قب قوسي</span>
                    <span class="proposal-tag">فواصل ذهبية</span>
                </div>
                <a href="{{ url('/home/proposal/2') }}" class="btn-view">
                    <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
                </a>
            </div>
        </div>

        <!-- Proposal 3 -->
        <div class="proposal-card">
            <div class="proposal-preview">
                <div class="preview-pattern"></div>
                <div class="proposal-number">3</div>
                <div class="preview-content">
                    <i class="fas fa-bolt"></i>
                    <h3>جريء مستوحى من NEOM</h3>
                    <span>Bold NEOM-Inspired</span>
                </div>
            </div>
            <div class="proposal-body">
                <h4>المقترح الثالث: تصميم جريء مستقبلي</h4>
                <p>ثيم داكن مع لمسات خضراء متوهجة مستوحاة من NEOM و The Line، خطوط أفقية متحركة، بطاقات داكنة بإضاءة خضراء.</p>
                <div class="proposal-tags">
                    <span class="proposal-tag green">داكن + أخضر متوهج</span>
                    <span class="proposal-tag">NEOM</span>
                    <span class="proposal-tag">The Line</span>
                    <span class="proposal-tag">تصميم مستقبلي</span>
                </div>
                <a href="{{ url('/home/proposal/3') }}" class="btn-view">
                    <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
                </a>
            </div>
        </div>

    </div>

    <a href="/" class="back-link"><i class="fas fa-arrow-right" style="margin-left:6px;"></i> العودة للرئيسية</a>

</body>
</html>
