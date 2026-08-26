@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختيار تصميم أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Cairo', sans-serif;
            background: #F0F4F8;
            color: #0A1F2C;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }
        .header { text-align: center; margin-bottom: 48px; max-width: 700px; }
        .header img { height: 64px; margin-bottom: 16px; }
        .header h1 { font-size: 1.8rem; font-weight: 900; margin-bottom: 10px; }
        .header p { color: #64748b; font-size: 14px; line-height: 1.8; }
        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #006C35, #00854A);
            color: #fff; font-size: 11px; font-weight: 700;
            padding: 5px 14px; border-radius: 20px; margin-bottom: 14px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1200px;
            width: 100%;
        }
        @media (max-width: 1000px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px) { .grid { grid-template-columns: 1fr; max-width: 400px; } }
        .card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid #E2E8F0;
            transition: all 0.35s;
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,.1);
        }
        .card:nth-child(1):hover { border-color: #006C35; }
        .card:nth-child(2):hover { border-color: #C5A55A; }
        .card:nth-child(3):hover { border-color: #00D4AA; }
        .card:nth-child(4):hover { border-color: #1A237E; }
        .preview {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .card:nth-child(1) .preview { background: linear-gradient(135deg, #0A1F2C, #006C35); }
        .card:nth-child(2) .preview { background: linear-gradient(135deg, #FAFAF5, #F5E6C8); }
        .card:nth-child(3) .preview { background: linear-gradient(135deg, #0D1117, #161B22); }
        .card:nth-child(4) .preview { background: linear-gradient(135deg, #1A237E, #283593); }
        .preview-icon { font-size: 36px; color: #fff; position: relative; z-index: 2; }
        .card:nth-child(2) .preview-icon { color: #C5A55A; }
        .card:nth-child(3) .preview-icon { color: #00D4AA; }
        .card:nth-child(4) .preview-icon { color: #fff; }
        .num {
            position: absolute; top: 10px; right: 10px;
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(255,255,255,.15);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 12px; color: #fff;
        }
        .card:nth-child(2) .num { background: rgba(197,165,90,.1); color: #C5A55A; }
        .card:nth-child(3) .num { background: rgba(0,212,170,.15); color: #00D4AA; }
        .card:nth-child(4) .num { background: rgba(255,255,255,.15); color: #fff; }
        .body { padding: 16px; }
        .body h3 { font-size: 14px; font-weight: 800; margin-bottom: 4px; }
        .body p { color: #64748b; font-size: 11.5px; line-height: 1.7; margin-bottom: 10px; }
        .tags { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 12px; }
        .tag {
            background: #f1f5f9; color: #475569;
            font-size: 9.5px; font-weight: 700;
            padding: 2px 8px; border-radius: 8px;
        }
        .tag.g { background: #dcfce7; color: #006C35; }
        .tag.gold { background: #FEF3C7; color: #92400E; }
        .tag.teal { background: #CCFBF1; color: #0F766E; }
        .tag.blue { background: #DBEAFE; color: #1E40AF; }
        .btn {
            display: block; width: 100%; text-align: center;
            background: linear-gradient(135deg, #006C35, #00854A);
            color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 12px; font-weight: 800;
            padding: 9px; border-radius: 10px;
            text-decoration: none; transition: all 0.3s; border: none; cursor: pointer;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,108,53,.3); }
        .btn.gold-btn { background: linear-gradient(135deg, #C5A55A, #D4B76A); }
        .btn.dark-btn { background: linear-gradient(135deg, #00D4AA, #00F5C8); color: #0D1117; }
        .btn.blue-btn { background: linear-gradient(135deg, #1A237E, #283593); }
        .current { margin-top: 24px; }
        .current a {
            display: inline-flex; align-items: center; gap: 6px;
            background: #fff; border: 1px solid #E2E8F0;
            padding: 8px 16px; border-radius: 10px;
            color: #0A1F2C; font-size: 13px; font-weight: 700;
            text-decoration: none; transition: all 0.2s;
        }
        .current a:hover { border-color: #006C35; color: #006C35; }
        .back { margin-top: 20px; color: #64748b; font-size: 13px; text-decoration: none; }
        .back:hover { color: #006C35; }
        .note { margin-top: 12px; font-size: 11px; color: #94a3b8; text-align: center; max-width: 600px; line-height: 1.7; }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ asset('images/new-logo1.png') }}" alt="أمر تم">
    <div class="badge"><i class="fas fa-palette" style="margin-left:6px;"></i> اختيار تصميم المنصة</div>
    <h1>اختر التصميم لواجهة أمر تم</h1>
    <p>اربعة مقترحات تصميمية — single-page full-screen layout 100vh مع الهوية السعودية ورؤية 2030</p>
</div>

<div class="grid">

    <!-- Proposal 1: Saudi Green -->
    <div class="card">
        <div class="preview">
            <div class="num">1</div>
            <div class="preview-icon"><i class="fas fa-leaf"></i></div>
        </div>
        <div class="body">
            <h3>أخضر سعودي رسمي</h3>
            <p>خط Vision 2030 — خلفية خضراء متدرجة، زخارف هندسية إسلامية، بطاقات زجاجية.</p>
            <div class="tags">
                <span class="tag g">أخضر #006C35</span>
                <span class="tag">ذهبي</span>
                <span class="tag">100vh</span>
            </div>
            <a href="{{ url('/amrtm/proposal/1') }}" class="btn">
                <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
            </a>
        </div>
    </div>

    <!-- Proposal 2: Saudi Gold -->
    <div class="card">
        <div class="preview">
            <div class="num">2</div>
            <div class="preview-icon"><i class="fas fa-gem"></i></div>
        </div>
        <div class="body">
            <h3>ذهبي ملكي أنيق</h3>
            <p>هوية أنيقة بأبيض + ذهبي، بطاقات منحنية، فواصل ذهبية أنيقة.</p>
            <div class="tags">
                <span class="tag gold">ذهبي #C5A55A</span>
                <span class="tag">أبيض</span>
                <span class="tag">100vh</span>
            </div>
            <a href="{{ url('/amrtm/proposal/2') }}" class="btn gold-btn">
                <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
            </a>
        </div>
    </div>

    <!-- Proposal 3: Modern Dark -->
    <div class="card">
        <div class="preview">
            <div class="num">3</div>
            <div class="preview-icon"><i class="fas fa-bolt"></i></div>
        </div>
        <div class="body">
            <h3>داكن حديث NEOM</h3>
            <p>ثيم داكن مع إضاءة خضراء متوهجة، خطوط شبكية، تصميم مستقبلي.</p>
            <div class="tags">
                <span class="tag teal">أخضر متوهج</span>
                <span class="tag">NEOM</span>
                <span class="tag">100vh</span>
            </div>
            <a href="{{ url('/amrtm/proposal/3') }}" class="btn dark-btn">
                <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
            </a>
        </div>
    </div>

    <!-- Proposal 4: Current Design Copy -->
    <div class="card">
        <div class="preview">
            <div class="num">4</div>
            <div class="preview-icon"><i class="fas fa-pen-ruler"></i></div>
        </div>
        <div class="body">
            <h3>التصميم الحالي (للتعديل)</h3>
            <p>نسخة كاملة من التصميم الحالي — يمكنك تعديلها يدوياً.</p>
            <div class="tags">
                <span class="tag blue">الأصلي</span>
                <span class="tag">قابل للتعديل</span>
            </div>
            <a href="{{ url('/amrtm/proposal/4') }}" class="btn blue-btn">
                <i class="fas fa-eye" style="margin-left:6px;"></i> عرض المقترح
            </a>
        </div>
    </div>

</div>

<div class="note">
    جميع المقترحات 1-3 هي single-page full-screen بارتفاع 100vh — جميع المحتوى (البطاقات + المكاتب) ظاهر في شاشة واحدة بدون تمرير.
    المقترح 4 هو نسخة من التصميم الحالي للتعديل اليدوي.
</div>

<div class="current">
    <a href="{{ url('/amrtm') }}"><i class="fas fa-arrow-left" style="margin-left:4px;"></i> العودة لل design الحالي</a>
</div>

<a href="/" class="back"><i class="fas fa-arrow-right" style="margin-left:6px;"></i> الرئيسية</a>

</body>
</html>
