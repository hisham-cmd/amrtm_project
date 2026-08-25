<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>من نحن | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="inner-page">

<canvas id="bg-canvas" class="page-canvas"></canvas>
@include('partials.public_nav')

<!-- HERO -->
<section class="page-hero">
    <div class="hero-particles"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fa fa-info-circle"></i> من نحن</div>
        <h1 class="page-hero-title">نبني مستقبل الأعمال<br><span class="gradient-text">بتقنية وثقة</span></h1>
        <p class="page-hero-sub">أمر تم — منصة سعودية متكاملة تجمع أصحاب الأعمال والخدمات والفرص في مكان واحد</p>
    </div>
</section>

<!-- STORY -->
<section class="content-section">
    <div class="container">
        <div class="two-col">
            <div class="col-text reveal">
                <div class="section-label">من نحن</div>
                <h2 class="section-title">أمر تم</h2>
                <p>منصة أمر تم هي منصة إلكترونية متخصصة في دعم قطاع الأعمال والخدمات، تقدم حلولًا متنوعة تشمل الخدمات الحكومية، والتوظيف، والعقار، وقاعات المناسبات، والتسويق، والاستشارات، وربط أصحاب الأعمال بالعملاء ومقدمي الخدمات بطريقة احترافية ومنظمة.</p>
                <p>وتهدف المنصة إلى تمكين الأفراد والمنشآت من عرض خدماتهم وإدارة أعمالهم إلكترونيًا، مع توفير بيئة موثوقة تسهم في تسهيل الإجراءات، وتعزيز فرص الأعمال، ودعم التحول الرقمي .</p>
                <div class="stats-row">
                    <div class="stat-item"><span class="stat-num" data-target="5000">0</span><span class="stat-label">مستخدم نشط</span></div>
                    <div class="stat-item"><span class="stat-num" data-target="200">0</span><span class="stat-label">شريك خدمات</span></div>
                    <div class="stat-item"><span class="stat-num" data-target="15">0</span><span class="stat-label">سنة خبرة</span></div>
                </div>
            </div>
            <div class="col-visual reveal">
                <div class="visual-card">
                    <div class="visual-icon-grid">
                        <div class="vi-item vi-blue"><i class="fa fa-building"></i><span>قاعات</span></div>
                        <div class="vi-item vi-purple"><i class="fa fa-users"></i><span>مستشارون</span></div>
                        <div class="vi-item vi-green"><i class="fa fa-briefcase"></i><span>أعمال</span></div>
                        <div class="vi-item vi-amber"><i class="fa fa-store"></i><span>امتياز</span></div>
                    </div>
                    <div class="visual-center-badge">
                        <img src="/images/new-logo1.png" alt="أمر تم" style="height:50px;width:auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="content-section alt-bg">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">قيمنا</div>
            <h2 class="section-title">ما يميزنا</h2>
        </div>
        <div class="cards-grid-4 reveal">
            <div class="value-card">
                <div class="value-icon" style="background:linear-gradient(135deg,#0ea5e9,#38bdf8)"><i class="fa fa-shield-alt"></i></div>
                <h3>الموثوقية</h3>
                <p>نضمن لك تجربة آمنة وموثوقة في كل خطوة، مدعومة بالتحقق والمراجعة.</p>
            </div>
            <div class="value-card">
                <div class="value-icon" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)"><i class="fa fa-rocket"></i></div>
                <h3>الابتكار</h3>
                <p>نستخدم أحدث التقنيات لتقديم حلول ذكية تواكب احتياجات السوق السعودية.</p>
            </div>
            <div class="value-card">
                <div class="value-icon" style="background:linear-gradient(135deg,#059669,#34d399)"><i class="fa fa-handshake"></i></div>
                <h3>الشراكة</h3>
                <p>نؤمن بقوة الشراكات الاستراتيجية لبناء منظومة أعمال متكاملة ومستدامة.</p>
            </div>
            <div class="value-card">
                <div class="value-icon" style="background:linear-gradient(135deg,#f59e0b,#fbbf24)"><i class="fa fa-star"></i></div>
                <h3>التميز</h3>
                <p>نسعى دائماً لتجاوز التوقعات وتقديم خدمة من الدرجة الأولى لكل عملائنا.</p>
            </div>
        </div>
    </div>
</section>

<!-- FOUNDER -->
<section class="content-section">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">القيادة</div>
            <h2 class="section-title">المؤسس</h2>
        </div>
        <div class="founder-section reveal">
            <div class="founder-card-large">
                <div class="owner-card-glow"></div>
                <div class="owner-avatar" style="width:110px;height:110px;margin:0 auto 20px;">
                    <div class="owner-avatar-inner" style="width:110px;height:110px;font-size:40px;">
                        @if(file_exists(public_path('images/owner.jpg')))
                            <img src="/images/owner.jpg" alt="صالح بن ناصر الشمراني" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @elseif(file_exists(public_path('images/owner.png')))
                            <img src="/images/owner.png" alt="صالح بن ناصر الشمراني" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @else
                            <i class="fa fa-user-tie"></i>
                        @endif
                    </div>
                    <div class="owner-status-dot"></div>
                </div>
                <div class="owner-badge">المؤسس والرئيس التنفيذي</div>
                <h2 class="owner-name-ar" style="font-size:22px;margin-top:10px;">صالح بن ناصر الشمراني</h2>
                <p class="owner-name-en" style="font-size:14px;margin-bottom:14px;">Saleh Bn Naser AL-Shamrani</p>
                <div class="owner-divider"></div>
                <p style="color:rgba(255,255,255,0.75);font-size:14px;line-height:1.8;max-width:500px;margin:14px auto;">
                    رائد أعمال سعودي بخبرة تتجاوز 15 عاماً في قطاع التقنية والخدمات. أسس "أمر تم" انطلاقاً من رؤية واضحة لتطوير بيئة الأعمال السعودية، ودعم رواد الأعمال والشركات الصغيرة والمتوسطة بأدوات تقنية متكاملة.
                </p>
                <p style="color:rgba(255,255,255,0.75);font-size:14px;line-height:1.8;max-width:500px;margin:0 auto 20px;">
                    A Saudi entrepreneur with over 15 years of experience in technology and services. Founded "Amr Tam" with a clear vision to develop Saudi Arabia's business environment.
                </p>
                <div class="owner-links" style="justify-content:center;">
                    <a href="/contact" class="owner-link-btn"><i class="fa fa-envelope"></i></a>
                    <a href="#" class="owner-link-btn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="owner-link-btn"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PARTNERS LOGOS -->
<section class="content-section alt-bg">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">شركاؤنا</div>
            <h2 class="section-title">نفتخر بشراكاتنا الاستراتيجية</h2>
        </div>
        <div class="partners-logos reveal">
            <div class="partner-logo-item"><i class="fa fa-building" style="font-size:32px;color:#38bdf8;"></i><span>شركة الرياض للتطوير</span></div>
            <div class="partner-logo-item"><i class="fa fa-university" style="font-size:32px;color:#7c3aed;"></i><span>مجموعة الأعمال السعودية</span></div>
            <div class="partner-logo-item"><i class="fa fa-store" style="font-size:32px;color:#059669;"></i><span>اتحاد الامتياز التجاري</span></div>
            <div class="partner-logo-item"><i class="fa fa-laptop-code" style="font-size:32px;color:#f59e0b;"></i><span>شركاء التقنية</span></div>
            <div class="partner-logo-item"><i class="fa fa-hospital" style="font-size:32px;color:#0ea5e9;"></i><span>مجمع الرعاية الصحية</span></div>
        </div>
    </div>
</section>

@include('partials.public_footer')

<script src="https://cdn.jsdelivr.net/npm/three@0.158.0/build/three.min.js"></script>
<script src="/js/particles.js"></script>
<script>
const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

const counterObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (!e.isIntersecting) return;
        const el = e.target, target = +el.dataset.target;
        let current = 0; const step = target / 60;
        const iv = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = Math.floor(current).toLocaleString('ar-SA') + '+';
            if (current >= target) clearInterval(iv);
        }, 22);
        counterObs.unobserve(el);
    });
}, { threshold: 0.5 });
document.querySelectorAll('.stat-num').forEach(el => counterObs.observe(el));
</script>
</body>
</html>
