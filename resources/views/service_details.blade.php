<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الخدمة | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <style>
  /* ===========================
   GLOBAL
=========================== */

*,
*::before,
*::after{
    box-sizing:border-box;
    margin:0;
    padding:0;
}

body.inner-page{
    font-family:'Cairo',sans-serif;
    background:#f4f6fb;
    color:#0d2448;
    min-height:100vh;
    overflow-x:hidden;
}

.page-canvas{
    position:fixed;
    inset:0;
    width:100%;
    height:100%;
    z-index:0;
    pointer-events:none;
}

.page-content{
    position:relative;
    z-index:1;
}

/* ===========================
   BREADCRUMB
=========================== */

.breadcrumb-bar{
    max-width:1280px;
    margin:auto;
    padding:100px 24px 0;
}

.breadcrumb{
    display:flex;
    align-items:center;
    gap:8px;
    flex-wrap:wrap;
    font-size:13px;
}

.breadcrumb a{
    color:#0d2448;
    text-decoration:none;
    font-weight:700;
    transition:.25s;
}

.breadcrumb a:hover{
    color:#06152d;
}

.breadcrumb span{
    color:#5d6b84;
}

.breadcrumb i{
    color:#94a3b8;
    font-size:10px;
}

/* ===========================
   HERO
=========================== */

.service-hero{
    max-width:1280px;
    margin:auto;
    padding:36px 24px 52px;
}

.hero-top{
    display:flex;
    gap:28px;
    align-items:flex-start;
    flex-wrap:wrap;
}

.hero-icon-wrap{
    width:90px;
    height:90px;
    border-radius:22px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:34px;
    background:#fff;
    border:1px solid #dbe5f1;
    box-shadow:0 10px 25px rgba(13,36,72,.08);
}

.hero-text{
    flex:1;
}

.service-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 18px;
    border-radius:40px;
    background:#eef3fb;
    color:#0d2448;
    font-weight:700;
    border:1px solid #d7e2ef;
    margin-bottom:14px;
}

.service-hero h1{
    color:#0d2448;
    font-size:clamp(1.8rem,4vw,2.8rem);
    font-weight:900;
    margin-bottom:16px;
}

.hero-desc{
    color:#5d6b84;
    line-height:1.9;
    max-width:700px;
    margin-bottom:26px;
}

.hero-stats{
    display:flex;
    flex-wrap:wrap;
    gap:14px;
}

.hero-stat{
    background:#fff;
    border:1px solid #dbe5f1;
    border-radius:16px;
    padding:14px 20px;
    min-width:110px;
    text-align:center;
}

.hero-stat strong{
    display:block;
    color:#0d2448;
    font-size:22px;
}

.hero-stat span{
    color:#6b7b92;
    font-size:12px;
}

/* ===========================
   LAYOUT
=========================== */

.main-layout{
    max-width:1280px;
    margin:auto;
    padding:0 24px 80px;
    display:grid;
    grid-template-columns:1fr 350px;
    gap:28px;
}

@media(max-width:1024px){

.main-layout{
grid-template-columns:1fr;
}

}

/* ===========================
   CARDS
=========================== */

.glass-card{
    background:#fff;
    border:1px solid #dbe5f1;
    border-radius:22px;
    padding:28px;
    margin-bottom:22px;
    box-shadow:0 10px 28px rgba(13,36,72,.05);
}

.card-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:20px;
    font-weight:800;
    color:#0d2448;
    margin-bottom:18px;
    padding-bottom:14px;
    border-bottom:1px solid #edf2f8;
}

.card-title i{
    color:#0d2448;
}

.overview-text{
    color:#5d6b84;
    line-height:2;
}

/* ===========================
   OFFERS
=========================== */

.offers-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:16px;
}

@media(max-width:600px){

.offers-grid{
grid-template-columns:1fr;
}

}

.offer-item{
    background:#f8fbff;
    border:1px solid #dbe5f1;
    border-radius:18px;
    padding:18px;
}

.offer-icon{
    font-size:22px;
    color:#0d2448;
    margin-bottom:10px;
}

.offer-item h4{
    color:#0d2448;
    margin-bottom:8px;
}

.offer-item p{
    color:#5d6b84;
    line-height:1.7;
}

/* ===========================
   PROCESS
=========================== */

.process-steps{
display:flex;
flex-direction:column;
gap:18px;
}

.process-step{
display:flex;
gap:14px;
}

.step-num{
width:40px;
height:40px;
border-radius:50%;
background:#0d2448;
color:#fff;
display:flex;
justify-content:center;
align-items:center;
font-weight:700;
}

.step-body h4{
color:#0d2448;
margin-bottom:6px;
}

.step-body p{
color:#5d6b84;
line-height:1.8;
}

/* ===========================
   TARGETS
=========================== */

.targets-list{
display:flex;
flex-wrap:wrap;
gap:10px;
}

.target-tag{
background:#eef3fb;
border:1px solid #dbe5f1;
color:#0d2448;
padding:8px 16px;
border-radius:40px;
font-size:13px;
font-weight:700;
}

/* ===========================
   SIDEBAR
=========================== */

.sidebar{
position:sticky;
top:100px;
}

.sidebar-cta{
background:#194a71;
color:#fff;
text-align:center;
border:none;
}

.sidebar-cta h3{
color:#fff;
margin-bottom:10px;
}

.sidebar-cta p{
color:#d8e2f0;
margin-bottom:18px;
line-height:1.8;
}

/* ===========================
   BUTTONS
=========================== */

.btn-primary{
display:flex;
justify-content:center;
align-items:center;
gap:8px;
width:100%;
padding:13px 22px;
background:#0d2448;
color:#fff;
border:none;
border-radius:14px;
text-decoration:none;
font-weight:700;
transition:.3s;
cursor:pointer;
}

.btn-primary:hover{
background:#06152d;
}

.btn-secondary{
display:flex;
justify-content:center;
align-items:center;
gap:8px;
margin-top:10px;
width:100%;
padding:12px 20px;
border:1px solid #0d2448;
border-radius:14px;
color:#0d2448;
text-decoration:none;
font-weight:700;
transition:.3s;
background:#fff;
}

.btn-secondary:hover{
background:#0d2448;
color:#fff;
}

/* ===========================
   LISTS
=========================== */

.features-list{
list-style:none;
display:flex;
flex-direction:column;
gap:12px;
}

.features-list li{
display:flex;
gap:10px;
align-items:center;
color:#5d6b84;
}

.features-list i{
color:#0d2448;
}

.tags-cloud{
display:flex;
flex-wrap:wrap;
gap:8px;
}

.tag-item{
padding:6px 14px;
background:#eef3fb;
border:1px solid #dbe5f1;
border-radius:40px;
color:#0d2448;
}

.related-list{
display:flex;
flex-direction:column;
gap:10px;
}

.related-item{
display:flex;
align-items:center;
gap:12px;
padding:12px;
border-radius:14px;
border:1px solid #dbe5f1;
background:#fff;
text-decoration:none;
transition:.3s;
}

.related-item:hover{
background:#f4f6fb;
border-color:#0d2448;
transform:translateX(-4px);
}

.rel-icon{
width:36px;
height:36px;
display:flex;
justify-content:center;
align-items:center;
background:#eef3fb;
border-radius:10px;
color:#0d2448;
}

.related-item span{
color:#0d2448;
font-weight:700;
}

/* ===========================
   MODAL
=========================== */

.modal-overlay{
position:fixed;
inset:0;
background:rgba(13,36,72,.45);
backdrop-filter:blur(8px);
display:none;
justify-content:center;
align-items:center;
padding:20px;
z-index:2000;
}

.modal-overlay.open{
display:flex;
}

.modal-box{
background:#fff;
border-radius:24px;
padding:36px;
width:100%;
max-width:520px;
max-height:90vh;
overflow:auto;
position:relative;
box-shadow:0 30px 70px rgba(13,36,72,.18);
}

.modal-close{
position:absolute;
top:14px;
left:14px;
width:36px;
height:36px;
border:none;
border-radius:50%;
background:#eef3fb;
cursor:pointer;
color:#0d2448;
}

.modal-box h2{
color:#0d2448;
margin-bottom:6px;
}

.modal-box .sub{
color:#5d6b84;
margin-bottom:22px;
}

.form-group{
margin-bottom:16px;
}

.form-group label{
display:block;
margin-bottom:6px;
font-weight:700;
color:#0d2448;
}

.form-group input,
.form-group textarea,
.form-group select{
width:100%;
padding:12px 15px;
border:1px solid #dbe5f1;
border-radius:12px;
background:#fff;
font-family:'Cairo';
color:#0d2448;
outline:none;
transition:.25s;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus{
border-color:#0d2448;
box-shadow:0 0 0 4px rgba(13,36,72,.08);
}

.success-state{
display:none;
text-align:center;
}

.success-icon{
width:72px;
height:72px;
margin:auto auto 18px;
border-radius:50%;
display:flex;
justify-content:center;
align-items:center;
background:#0d2448;
color:#fff;
font-size:28px;
}

/* ===========================
   REVEAL
=========================== */

.reveal{
opacity:0;
transform:translateY(30px);
transition:.6s;
}

.reveal.visible{
opacity:1;
transform:none;
}

.reveal-delay-1{
transition-delay:.1s;
}

.reveal-delay-2{
transition-delay:.2s;
}

        /*==============================
            FOOTER
==============================*/

.ft-dark{
    background:#0d2448;
    border-top:1px solid rgba(255,255,255,.08);
    padding:24px 0 16px;
}

.ft-wrap{
    max-width:1200px;
    margin:auto;
    padding:0 20px;

    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    gap:14px;
}

.ft-logo{
    height:42px;
    width:auto;
    object-fit:contain;

    /* يجعل اللوجو الغامق أوضح */
    filter:brightness(0) invert(1);
}

.ft-text{
    max-width:650px;
    color:rgba(255,255,255,.85);
    font-size:14px;
    line-height:1.8;
    font-weight:500;
    margin:0;
}

.ft-social{
    display:flex;
    gap:10px;
}

.ft-social a{
    width:38px;
    height:38px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:12px;

    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.15);

    color:#d8e4f7;
    text-decoration:none;

    transition:.3s ease;
}

.ft-social a:hover{
    background:#ffffff;
    color:#0d2448;
    border-color:#ffffff;
    transform:translateY(-5px) scale(1.08);
    box-shadow:0 14px 30px rgba(0,0,0,.25);
}

.ft-copy{
    color:rgba(255,255,255,.7);
    font-size:13px;
}

.ft-copy a{
    color:#d8e4f7;
    font-weight:700;
    text-decoration:none;
    transition:.25s;
}

.ft-copy a:hover{
    color:#ffffff;
}

@media(max-width:768px){

    .ft-dark{
        padding:20px 0 14px;
    }

    .ft-logo{
        height:36px;
    }

    .ft-text{
        font-size:13px;
    }

    .ft-social a{
        width:34px;
        height:34px;
    }
}
    </style>
</head>
<body class="inner-page">
    <canvas class="page-canvas" id="bg-canvas"></canvas>
  <!--  @include('partials.public_nav')-->

    <div class="page-content">
        <div class="breadcrumb-bar">
            <nav class="breadcrumb">
                <a href="/"><i class="fas fa-home"></i> الرئيسية</a>
                <i class="fas fa-chevron-left"></i>
                <a href="/consultants">الاستشارات</a>
                <i class="fas fa-chevron-left"></i>
                <span id="breadcrumbService">تحميل...</span>
            </nav>
        </div>

        <section class="service-hero reveal">
            <div class="hero-top">
                <div class="hero-icon-wrap" id="heroIcon"></div>
                <div class="hero-text">
                    <div class="service-badge" id="heroBadge"><i class="fas fa-star"></i> <span id="badgeText"></span></div>
                    <h1 id="heroTitle"></h1>
                    <p class="hero-desc" id="heroDesc"></p>
                    <div class="hero-stats" id="heroStats"></div>
                </div>
            </div>
        </section>

        <div class="main-layout">
            <div class="left-col">
                <div class="glass-card reveal">
                    <div class="card-title"><i class="fas fa-circle-info"></i> نظرة عامة</div>
                    <p class="overview-text" id="overviewText"></p>
                </div>
                <div class="glass-card reveal">
                    <div class="card-title"><i class="fas fa-list-check"></i> ما نقدمه</div>
                    <div class="offers-grid" id="offersGrid"></div>
                </div>
                <div class="glass-card reveal">
                    <div class="card-title"><i class="fas fa-route"></i> منهجيتنا</div>
                    <div class="process-steps" id="processSteps"></div>
                </div>
                <div class="glass-card reveal">
                    <div class="card-title"><i class="fas fa-bullseye"></i> لمن هذه الخدمة؟</div>
                    <div class="targets-list" id="targetsList"></div>
                </div>
            </div>
            <aside class="sidebar">
                <div class="glass-card sidebar-cta">
                    <h3>ابدأ استشارتك الآن</h3>
                    <p>احجز جلسة مع أحد خبرائنا واحصل على رؤية واضحة لمسارك</p>
                    <button class="btn-primary" onclick="openModal()"><i class="fas fa-calendar-check"></i> احجز استشارة الآن</button>
                    <a href="#" id="sidebarConsultantsLink" class="btn-secondary"><i class="fas fa-users"></i> عرض المستشارين</a>
                </div>
                <div class="glass-card reveal">
                    <div class="card-title"><i class="fas fa-sparkles"></i> مميزات الخدمة</div>
                    <ul class="features-list" id="featuresList"></ul>
                </div>
                <div class="glass-card reveal reveal-delay-1">
                    <div class="card-title"><i class="fas fa-tags"></i> الكلمات المفتاحية</div>
                    <div class="tags-cloud" id="tagsCloud"></div>
                </div>
                <div class="glass-card reveal reveal-delay-2">
                    <div class="card-title"><i class="fas fa-grid-2"></i> خدمات ذات صلة</div>
                    <div class="related-list" id="relatedList"></div>
                </div>
            </aside>
        </div>
    </div>

    <!-- BOOKING MODAL -->
    <div class="modal-overlay" id="bookingModal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            <div id="formState">
                <h2>احجز استشارتك</h2>
                <p class="sub">أدخل بياناتك وسيتواصل معك أحد خبرائنا خلال 24 ساعة</p>
                <form onsubmit="submitBooking(event)">
                    <div class="form-group">
                        <label>الاسم الكامل</label>
                        <input type="text" placeholder="أدخل اسمك الكامل" required>
                    </div>
                    <div class="form-group">
                        <label>رقم الجوال</label>
                        <input type="tel" placeholder="05XXXXXXXX" required>
                    </div>
                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" placeholder="example@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>نوع الاستشارة</label>
                        <select id="serviceTypeSelect" required>
                            <option value="">اختر نوع الاستشارة</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>التاريخ المفضل</label>
                        <input type="date" required>
                    </div>
                    <div class="form-group">
                        <label>رسالتك (اختياري)</label>
                        <textarea placeholder="اذكر تفاصيل استفسارك..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> إرسال الطلب</button>
                </form>
            </div>
            <div class="success-state" id="successState">
                <div class="success-icon"><i class="fas fa-check"></i></div>
                <h3>تم إرسال طلبك بنجاح!</h3>
                <p>سيتواصل معك أحد مستشارينا خلال 24 ساعة على رقم الجوال أو البريد الإلكتروني المُدخل</p>
            </div>
        </div>
    </div>


    
<footer class="ft-dark">
    <div class="ft-wrap">

        <img src="/images/new-logo1.png"
             alt="آمر تم"
             class="ft-logo">

        <p class="ft-text">
            {{ __('footer.tagline') }}
        </p>

        <div class="ft-social">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>

        <div class="ft-copy">
            {{ __('footer.copyright', ['year' => date('Y')]) }}
            &nbsp;|&nbsp;
            <a href="/privacy">{{ __('footer.privacy') }}</a>
        </div>

    </div>
</footer>
    <!--@include('partials.public_footer')-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r158/three.min.js"></script>
    <script>
    const SERVICES = {
        strategy: {
            id:'strategy', title:'استشارات الاستراتيجية', badge:'تخطيط استراتيجي',
            desc:'نساعد المؤسسات والشركات السعودية على بناء خططها الاستراتيجية المتوافقة مع رؤية 2030، وتحليل الأسواق، وتطوير نماذج الأعمال لتحقيق نمو مستدام.',
            icon:'fa-chess', iconClass:'icon-strategy',
            stats:['+18 سنة خبرة','+600 مشروع','94% نجاح','+45 خبير'],
            overview:'تُعدّ الاستراتيجية الواضحة الأساس الذي تقوم عليه كل مؤسسة ناجحة. في أمر تم، نقدم استشارات استراتيجية متكاملة تشمل التخطيط طويل الأمد، وتحليل البيئة التنافسية، ودراسات الجدوى، وإعادة هيكلة نماذج الأعمال. نعتمد على منهجيات عالمية معتمدة مثل McKinsey 7-S وBCG Matrix ونموذج Porter لضمان تقديم توصيات قابلة للتنفيذ ومبنية على بيانات دقيقة. خبراؤنا يمتلكون خبرة موثقة في مختلف القطاعات الاقتصادية السعودية.',
            offers:[
                {icon:'fa-map',title:'التخطيط الاستراتيجي',desc:'وضع خطط استراتيجية شاملة لثلاث إلى خمس سنوات مع مؤشرات أداء واضحة'},
                {icon:'fa-magnifying-glass-chart',title:'تحليل السوق',desc:'دراسة شاملة للسوق والمنافسين وفرص النمو والتهديدات المحتملة'},
                {icon:'fa-file-chart-column',title:'دراسات الجدوى',desc:'إعداد دراسات جدوى اقتصادية ومالية احترافية للمشاريع الجديدة'},
                {icon:'fa-diagram-project',title:'تطوير نماذج الأعمال',desc:'إعادة هيكلة وتطوير نموذج العمل لضمان الاستدامة والتنافسية'}
            ],
            process:[
                {title:'التشخيص والتحليل',desc:'نبدأ بتحليل شامل للوضع الراهن والفجوات والفرص المتاحة'},
                {title:'وضع الاستراتيجية',desc:'نصمم الاستراتيجية المناسبة بناءً على أهدافك وإمكانياتك'},
                {title:'خطة التنفيذ',desc:'نضع خارطة طريق تفصيلية مع مسؤوليات وجداول زمنية واضحة'},
                {title:'المتابعة والتقييم',desc:'نرافقك في مرحلة التنفيذ ونقيّم النتائج ونعدّل المسار عند الحاجة'}
            ],
            targets:['الشركات الناشئة','الشركات العائلية','القطاع الحكومي','المستثمرون','المؤسسات الكبرى','الشركات الراغبة في التوسع'],
            features:['خبراء استراتيجيون معتمدون دولياً','منهجيات عالمية معتمدة','تقارير تفصيلية قابلة للتنفيذ','متابعة ما بعد الاستشارة','سرية تامة للبيانات'],
            tags:['رؤية 2030','التخطيط الاستراتيجي','نماذج الأعمال','تحليل SWOT','دراسات الجدوى','BCG Matrix','تحليل السوق']
        },
        finance: {
            id:'finance', title:'استشارات التمويل والمحاسبة', badge:'استشارات مالية',
            desc:'نقدم خدمات التدقيق المالي والاستشارات الضريبية وإدارة الثروات وهيكلة التمويل للشركات والأفراد في المملكة.',
            icon:'fa-coins', iconClass:'icon-finance',
            stats:['+20 سنة خبرة','+900 عميل','12B+ ريال مُدار','+50 خبير'],
            overview:'الإدارة المالية السليمة هي عصب الأعمال الناجحة. نقدم في أمر تم طيفاً واسعاً من الخدمات المالية والمحاسبية التي تمكّن الشركات من اتخاذ قرارات مبنية على أرقام دقيقة. من التدقيق والمراجعة المالية وفق معايير IFRS، إلى التخطيط الضريبي المتوافق مع هيئة الزكاة والضريبة والجمارك، وصولاً إلى هيكلة التمويل والاستثمار. فريقنا من المحاسبين القانونيين المعتمدين يضمن الامتثال الكامل وتحسين الأداء المالي.',
            offers:[
                {icon:'fa-file-invoice',title:'التدقيق المالي',desc:'مراجعة وتدقيق البيانات المالية وفق معايير المحاسبة الدولية IFRS'},
                {icon:'fa-receipt',title:'الاستشارات الضريبية',desc:'التخطيط الضريبي وضريبة القيمة المضافة والزكاة والامتثال الضريبي'},
                {icon:'fa-piggy-bank',title:'إدارة الثروات',desc:'تخطيط الثروة الشخصية وإدارة المحافظ الاستثمارية وتنويع الأصول'},
                {icon:'fa-building-columns',title:'هيكلة التمويل',desc:'تصميم هياكل تمويلية مثلى للشركات وإعداد ملفات التمويل البنكي'}
            ],
            process:[
                {title:'جمع البيانات المالية',desc:'مراجعة شاملة للقوائم المالية والسجلات المحاسبية'},
                {title:'التحليل والتشخيص',desc:'تحليل الأداء المالي وتحديد الفجوات ومواطن الخطر'},
                {title:'وضع التوصيات',desc:'إعداد تقارير مفصلة بالتوصيات العملية والحلول المقترحة'},
                {title:'التنفيذ والمتابعة',desc:'مساعدة في تنفيذ التوصيات ومتابعة مؤشرات الأداء المالي'}
            ],
            targets:['الشركات الصغيرة والمتوسطة','المجموعات الكبرى','الأفراد أصحاب الثروات','الشركات الناشئة','المستثمرون','القطاع غير الربحي'],
            features:['محاسبون قانونيون معتمدون (CPA, SOCPA)','امتثال كامل لمعايير IFRS','تقارير مالية دقيقة وشاملة','سرية مطلقة للمعلومات المالية','متابعة ضريبية مستمرة'],
            tags:['IFRS','تدقيق مالي','ضريبة القيمة المضافة','الزكاة','إدارة الثروات','CPA','هيكلة تمويل']
        },
        technology: {
            id:'technology', title:'استشارات التحول الرقمي', badge:'استشارات تقنية',
            desc:'نُسرّع رحلة التحول الرقمي للمؤسسات السعودية عبر حلول الذكاء الاصطناعي والأمن السيبراني وتطوير المنظومات الرقمية المتكاملة.',
            icon:'fa-microchip', iconClass:'icon-technology',
            stats:['+12 سنة خبرة','+400 مشروع','99.9% uptime','+60 خبير'],
            overview:'التحول الرقمي لم يعد خياراً بل ضرورة استراتيجية. نساعد المؤسسات السعودية على تبني التقنيات الحديثة بشكل ممنهج ومدروس، من تقييم النضج الرقمي الحالي، إلى تصميم خارطة طريق التحول، وتنفيذ حلول الذكاء الاصطناعي والتعلم الآلي، وبناء منظومات البيانات الضخمة، وتعزيز الأمن السيبراني وفق أفضل الممارسات العالمية.',
            offers:[
                {icon:'fa-robot',title:'حلول الذكاء الاصطناعي',desc:'تصميم وتنفيذ حلول AI مخصصة لأتمتة العمليات وتحليل البيانات'},
                {icon:'fa-shield-halved',title:'الأمن السيبراني',desc:'تقييم الثغرات وبناء منظومة أمنية متكاملة وفق معايير ISO 27001'},
                {icon:'fa-cloud',title:'البنية التحتية السحابية',desc:'تصميم ونقل وإدارة البنى التحتية السحابية الهجينة والعامة'},
                {icon:'fa-database',title:'منظومات البيانات',desc:'بناء منصات البيانات الضخمة وحوكمة البيانات وتحليلات الأعمال'}
            ],
            process:[
                {title:'تقييم النضج الرقمي',desc:'تشخيص الوضع الرقمي الحالي وتحديد الفجوات والفرص'},
                {title:'تصميم خارطة الطريق',desc:'وضع استراتيجية التحول الرقمي مع أولويات واضحة وجدول زمني'},
                {title:'التنفيذ المرحلي',desc:'تطبيق الحلول التقنية بشكل مرحلي مع ضمان استمرارية الأعمال'},
                {title:'التدريب والتمكين',desc:'تدريب الفرق على الأدوات والأنظمة الجديدة وبناء الكفاءات الداخلية'}
            ],
            targets:['الشركات الكبرى','القطاع الحكومي','القطاع الصحي','قطاع التعليم','الشركات الصناعية','قطاع التجزئة'],
            features:['خبراء تقنيون معتمدون (AWS, Azure, GCP)','منهجية Agile في التنفيذ','حلول مخصصة لكل قطاع','دعم 24/7 بعد التطبيق','ضمان التوافق مع اللوائح الوطنية'],
            tags:['ذكاء اصطناعي','تعلم آلي','أمن سيبراني','سحابة','بيانات ضخمة','IoT','رؤية 2030']
        },
        hr: {
            id:'hr', title:'استشارات الموارد البشرية', badge:'استشارات بشرية',
            desc:'نبني منظومات الموارد البشرية المتكاملة للشركات السعودية، من استقطاب المواهب وتطويرها إلى بناء الهياكل التنظيمية وتحقيق أهداف السعودة.',
            icon:'fa-users', iconClass:'icon-hr',
            stats:['+15 سنة خبرة','+500 شركة','88% معدل سعودة','+35 خبير'],
            overview:'رأس المال البشري هو أقيم أصول أي مؤسسة. نقدم في أمر تم استشارات موارد بشرية شاملة تبدأ من تصميم الهيكل التنظيمي المثالي، مروراً بسياسات الاستقطاب والتوظيف، وبرامج التطوير والتدريب، وصولاً إلى أنظمة الأداء والمكافآت. نولي اهتماماً خاصاً لتحقيق متطلبات نظام العمل السعودي وأهداف السعودة ضمن أطر رؤية 2030.',
            offers:[
                {icon:'fa-user-plus',title:'استقطاب المواهب',desc:'تصميم استراتيجيات استقطاب فعّالة واختيار أفضل الكفاءات'},
                {icon:'fa-graduation-cap',title:'تطوير وتدريب الكوادر',desc:'بناء برامج تدريبية ومسارات مهنية وخطط تطوير لكل مستوى وظيفي'},
                {icon:'fa-sitemap',title:'الهياكل التنظيمية',desc:'تصميم هياكل تنظيمية مرنة وكفؤة تدعم النمو والتوسع'},
                {icon:'fa-chart-bar',title:'أنظمة الأداء',desc:'بناء أنظمة تقييم الأداء والحوافز والمكافآت المرتبطة بالنتائج'}
            ],
            process:[
                {title:'تقييم الوضع الحالي',desc:'تحليل السياسات والممارسات البشرية الحالية وتحديد الفجوات'},
                {title:'التصميم والتطوير',desc:'تصميم الحلول والسياسات والأنظمة المناسبة لاحتياجاتك'},
                {title:'التطبيق والتوعية',desc:'تنفيذ الحلول وتدريب الفرق وإدارة التغيير المؤسسي'},
                {title:'القياس والتحسين',desc:'متابعة مؤشرات الأداء البشري وتحسين السياسات بشكل مستمر'}
            ],
            targets:['الشركات العائلية','الشركات متعددة الجنسيات','المؤسسات الحكومية','الشركات الناشئة','قطاع التجزئة','القطاع الصناعي'],
            features:['خبراء HR معتمدون (SHRM, CIPD)','إلمام كامل بنظام العمل السعودي','تصميم حلول مخصصة لكل مؤسسة','دعم تحقيق أهداف السعودة','أنظمة HR رقمية متكاملة'],
            tags:['سعودة','استقطاب','تطوير قيادات','تقييم الأداء','نظام العمل','ثقافة مؤسسية','SHRM']
        },
        marketing: {
            id:'marketing', title:'استشارات التسويق والعلاقات العامة', badge:'استشارات تسويقية',
            desc:'نبني هويات تجارية قوية وننفذ حملات تسويقية رقمية وتقليدية تحقق نتائج قابلة للقياس في السوق السعودي.',
            icon:'fa-bullhorn', iconClass:'icon-marketing',
            stats:['+10 سنة خبرة','+350 حملة','3.5x متوسط ROI','+40 خبير'],
            overview:'في عصر التحول الرقمي، التسويق الفعّال هو ما يُميز العلامات الناجحة. نقدم استشارات تسويقية متكاملة تشمل بناء الهوية والعلامة التجارية، وتصميم استراتيجيات التسويق الرقمي عبر قنوات متعددة، وإدارة العلاقات العامة والأزمات الإعلامية. نستند إلى بيانات السوق السعودي وسلوك المستهلك المحلي لضمان حملات ذات تأثير حقيقي.',
            offers:[
                {icon:'fa-palette',title:'بناء العلامة التجارية',desc:'تصميم الهوية البصرية والقصة التسويقية وموضع العلامة التجارية'},
                {icon:'fa-mobile-screen',title:'التسويق الرقمي',desc:'إدارة حملات سوشيال ميديا وSEO وGoogle Ads وتسويق المحتوى'},
                {icon:'fa-newspaper',title:'العلاقات العامة',desc:'بناء علاقات إعلامية قوية وإدارة السمعة والتواصل مع الجمهور'},
                {icon:'fa-chart-pie',title:'تحليل السوق والمستهلك',desc:'دراسات السوق وتحليل سلوك المستهلك وتجزئة الجمهور المستهدف'}
            ],
            process:[
                {title:'تحليل الوضع الراهن',desc:'مراجعة الهوية والأداء التسويقي الحالي وتحليل المنافسين'},
                {title:'وضع الاستراتيجية',desc:'تصميم استراتيجية تسويقية شاملة مع تحديد القنوات والميزانية'},
                {title:'إنتاج المحتوى والتنفيذ',desc:'إنتاج المحتوى الإبداعي وإطلاق الحملات وإدارتها'},
                {title:'القياس والتحسين',desc:'تتبع مؤشرات الأداء وتحسين الحملات بشكل مستمر لزيادة العائد'}
            ],
            targets:['العلامات التجارية الناشئة','المطاعم والضيافة','قطاع التجزئة','العقارات','الرعاية الصحية','التعليم'],
            features:['خبراء تسويق معتمدون (Google, Meta)','تقارير أداء شهرية مفصلة','فريق إبداعي متكامل','تغطية جميع القنوات الرقمية','فهم عميق للمستهلك السعودي'],
            tags:['SEO','سوشيال ميديا','علاقات عامة','تسويق محتوى','Google Ads','هوية بصرية','تحليل السوق']
        },
        legal: {
            id:'legal', title:'استشارات الشؤون القانونية', badge:'استشارات قانونية',
            desc:'نقدم استشارات قانونية تجارية متخصصة في العقود والحوكمة وتأسيس الشركات وفض النزاعات في إطار الأنظمة السعودية.',
            icon:'fa-scale-balanced', iconClass:'icon-legal',
            stats:['+22 سنة خبرة','+700 قضية','96% نجاح','+30 خبير'],
            overview:'البيئة القانونية السعودية في تطور مستمر خاصة في ظل إصلاحات رؤية 2030. نقدم في أمر تم استشارات قانونية تجارية متخصصة تغطي جميع جوانب الأعمال من تأسيس الشركات وصياغة العقود، إلى حوكمة الشركات وإدارة مجالس الإدارة، وحل النزاعات التجارية عبر التحكيم والوساطة.',
            offers:[
                {icon:'fa-file-contract',title:'صياغة العقود',desc:'صياغة ومراجعة العقود التجارية والاتفاقيات وعقود الشراكة'},
                {icon:'fa-building',title:'تأسيس الشركات',desc:'إجراءات التأسيس وهيكلة الملكية والحصول على التراخيص التجارية'},
                {icon:'fa-landmark',title:'حوكمة الشركات',desc:'تصميم أنظمة الحوكمة ولوائح مجالس الإدارة والجمعيات العامة'},
                {icon:'fa-handshake',title:'فض النزاعات',desc:'التفاوض والوساطة والتحكيم التجاري وتمثيل العملاء قضائياً'}
            ],
            process:[
                {title:'التقييم القانوني',desc:'مراجعة الوضع القانوني الحالي وتحديد المخاطر والفجوات'},
                {title:'الاستشارة والتوصية',desc:'تقديم الرأي القانوني المفصل والتوصيات العملية'},
                {title:'الصياغة والتوثيق',desc:'إعداد الوثائق والعقود والمستندات القانونية المطلوبة'},
                {title:'المتابعة والتمثيل',desc:'متابعة الإجراءات الرسمية والتمثيل أمام الجهات المختصة'}
            ],
            targets:['رجال الأعمال','الشركات الناشئة','الشركات العائلية','المجموعات الاستثمارية','الشركات الأجنبية','القطاع العقاري'],
            features:['محامون ومستشارون مرخصون','إلمام كامل بالأنظمة السعودية','سرية تامة وأخلاقيات مهنية','تغطية جميع المناطق الاقتصادية','متابعة الإصلاحات التشريعية'],
            tags:['قانون تجاري','عقود','حوكمة','تأسيس شركات','تحكيم','ملكية فكرية','نظام الشركات']
        },
        realestate: {
            id:'realestate', title:'استشارات العقارات والاستثمار', badge:'استشارات عقارية',
            desc:'تقييم عقاري احترافي ومحافظ استثمارية وصناديق ريت، نُمكّنك من اتخاذ قرارات استثمارية عقارية مبنية على بيانات دقيقة ورؤية واضحة في السوق السعودي.',
            icon:'fa-building', iconClass:'icon-realestate',
            stats:['+25 سنة خبرة','+800 صفقة','12B+ ريال استثمارات','+40 خبير'],
            overview:'يُعدّ القطاع العقاري السعودي من أكثر القطاعات حيوية ونمواً في المنطقة، مدفوعاً بمشاريع رؤية 2030 العملاقة كنيوم والقدية والبحر الأحمر. في أمر تم، نقدم استشارات عقارية واستثمارية متكاملة تشمل التقييم العقاري المعتمد، وتحليل السوق العقاري وفرص الاستثمار، وبناء المحافظ العقارية المتنوعة، وإدارة صناديق الاستثمار العقاري المتداولة (ريت). نعتمد على بيانات السوق الحديثة وأدوات التحليل المتقدمة لضمان قرارات استثمارية مدروسة ومربحة. خبراؤنا يمتلكون شهادات معتمدة من الهيئة السعودية للمقيمين المعتمدين وخبرات موثقة في مختلف أصناف الأصول العقارية.',
            offers:[
                {icon:'fa-file-invoice-dollar',title:'التقييم العقاري المعتمد',desc:'تقييم عقاري احترافي معتمد من الهيئة السعودية للمقيمين لجميع أنواع الأصول'},
                {icon:'fa-chart-line',title:'تحليل السوق العقاري',desc:'دراسات السوق والتوقعات السعرية وتحديد أفضل فرص الاستثمار العقاري'},
                {icon:'fa-briefcase',title:'إدارة المحافظ العقارية',desc:'بناء وإدارة محافظ عقارية متنوعة مع إدارة المخاطر وتعظيم العائد'},
                {icon:'fa-landmark-dome',title:'صناديق الاستثمار العقاري',desc:'تأسيس وإدارة صناديق ريت والاستشارة في الاستثمار بصناديق متداولة'}
            ],
            process:[
                {title:'تقييم الوضع الاستثماري',desc:'دراسة الأهداف الاستثمارية وتحمل المخاطر والميزانية المتاحة'},
                {title:'تحليل السوق وتحديد الفرص',desc:'فحص السوق واستكشاف الفرص المناسبة ومقارنة الخيارات المتاحة'},
                {title:'هيكلة الصفقة والتفاوض',desc:'دعم التفاوض وهيكلة الصفقة القانونية والمالية والضريبية'},
                {title:'إدارة الأصول والمتابعة',desc:'متابعة الأصول العقارية وإدارتها وتحسين عائد الاستثمار باستمرار'}
            ],
            targets:['المستثمرون الأفراد','الشركات العائلية','الصناديق الاستثمارية','المطورون العقاريون','البنوك والمؤسسات المالية','المغتربون'],
            features:['مقيّمون معتمدون من الهيئة السعودية','تغطية جميع مناطق المملكة','تحليلات سوق في الوقت الفعلي','شبكة علاقات واسعة في القطاع','توافق مع أنظمة هيئة السوق المالية'],
            tags:['تقييم عقاري','صناديق ريت','استثمار عقاري','نيوم','رؤية 2030','محافظ عقارية','سوق العقارات']
        },
        operations: {
            id:'operations', title:'استشارات التشغيل والإدارة', badge:'استشارات تشغيلية',
            desc:'تحسين العمليات وسلاسل الإمداد وضبط الجودة، نُساعد مؤسستك على تحقيق كفاءة تشغيلية عالية وخفض التكاليف وتحسين الإنتاجية.',
            icon:'fa-gears', iconClass:'icon-operations',
            stats:['+20 سنة خبرة','+350 مشروع','40% متوسط تحسين','+55 خبير'],
            overview:'الكفاءة التشغيلية هي المحرك الرئيسي لربحية الأعمال. في أمر تم، نقدم استشارات تشغيلية متخصصة تستهدف تحسين جميع جوانب العمليات المؤسسية. من تحليل وإعادة هندسة العمليات، إلى تحسين سلاسل الإمداد وإدارة المخزون، وتطبيق معايير الجودة الدولية ISO، وتبني منهجيات Lean وSix Sigma لتقليل الهدر وتحسين الإنتاجية. نساعد مؤسستك على بناء قدرات تشغيلية مستدامة تدعم نموها على المدى الطويل.',
            offers:[
                {icon:'fa-arrows-spin',title:'إعادة هندسة العمليات',desc:'تحليل العمليات الحالية وإعادة تصميمها لتحقيق كفاءة أعلى بتكلفة أقل'},
                {icon:'fa-truck',title:'إدارة سلاسل الإمداد',desc:'تحسين سلاسل الإمداد وإدارة المخزون والعلاقة مع الموردين'},
                {icon:'fa-certificate',title:'أنظمة إدارة الجودة',desc:'تطبيق معايير ISO 9001 وISO 14001 وإعداد الشركات للحصول على الشهادات'},
                {icon:'fa-gauge-high',title:'تحسين الإنتاجية',desc:'تطبيق منهجيات Lean وSix Sigma للقضاء على الهدر ورفع كفاءة الأداء'}
            ],
            process:[
                {title:'تشخيص العمليات',desc:'رسم خرائط العمليات الحالية وتحديد نقاط الضعف والاختناقات'},
                {title:'تصميم الحلول',desc:'تصميم حلول تشغيلية مخصصة مع تحديد مؤشرات النجاح'},
                {title:'التطبيق وإدارة التغيير',desc:'تنفيذ الحلول مع برامج تدريب الفرق وإدارة التغيير المؤسسي'},
                {title:'القياس والتحسين المستمر',desc:'مراقبة الأداء ومؤشرات KPI وضمان التحسين المستمر'}
            ],
            targets:['المصانع والقطاع الصناعي','شركات الخدمات اللوجستية','قطاع التجزئة','المستشفيات والرعاية الصحية','شركات البناء والمقاولات','القطاع الحكومي'],
            features:['خبراء Lean وSix Sigma معتمدون','مراجعون ISO معتمدون','تحليل بيانات تشغيلية متقدم','منهجيات عالمية مثبتة الفعالية','تحقيق نتائج مرئية خلال 90 يوماً'],
            tags:['Lean','Six Sigma','ISO 9001','سلاسل الإمداد','BPR','إدارة الجودة','تحسين الإنتاجية']
        }
    };

    const ALL_RELATED = [
        {id:'strategy',label:'الاستراتيجية',icon:'fa-chess'},
        {id:'finance',label:'التمويل',icon:'fa-coins'},
        {id:'technology',label:'التحول الرقمي',icon:'fa-microchip'},
        {id:'hr',label:'الموارد البشرية',icon:'fa-users'},
        {id:'marketing',label:'التسويق',icon:'fa-bullhorn'},
        {id:'legal',label:'الشؤون القانونية',icon:'fa-scale-balanced'},
        {id:'realestate',label:'العقارات',icon:'fa-building'},
        {id:'operations',label:'التشغيل',icon:'fa-gears'}
    ];

    function getParam(n){ return new URLSearchParams(window.location.search).get(n)||'strategy'; }

    function buildPage(){
        const id = getParam('id');
        const s = SERVICES[id] || SERVICES.strategy;
        document.title = s.title + ' | أمر تم';
        document.getElementById('breadcrumbService').textContent = s.title;

        const iw = document.getElementById('heroIcon');
        iw.className = 'hero-icon-wrap ' + s.iconClass;
        iw.innerHTML = '<i class="fas ' + s.icon + '"></i>';

        document.getElementById('badgeText').textContent = s.badge;
        document.getElementById('heroTitle').textContent = s.title;
        document.getElementById('heroDesc').textContent = s.desc;
        document.getElementById('heroStats').innerHTML = s.stats.map(st=>`<div class="hero-stat"><strong>${st}</strong></div>`).join('');
        document.getElementById('overviewText').textContent = s.overview;

        document.getElementById('offersGrid').innerHTML = s.offers.map(o=>`
            <div class="offer-item">
                <div class="offer-icon"><i class="fas ${o.icon}"></i></div>
                <h4>${o.title}</h4><p>${o.desc}</p>
            </div>`).join('');

        document.getElementById('processSteps').innerHTML = s.process.map((p,i)=>`
            <div class="process-step">
                <div class="step-num">${i+1}</div>
                <div class="step-body"><h4>${p.title}</h4><p>${p.desc}</p></div>
            </div>`).join('');

        document.getElementById('targetsList').innerHTML = s.targets.map(t=>`<span class="target-tag">${t}</span>`).join('');
        document.getElementById('sidebarConsultantsLink').href = '/consultants-list?category='+id;
        document.getElementById('featuresList').innerHTML = s.features.map(f=>`<li><i class="fas fa-circle-check"></i> ${f}</li>`).join('');
        document.getElementById('tagsCloud').innerHTML = s.tags.map(t=>`<span class="tag-item">${t}</span>`).join('');

        const related = ALL_RELATED.filter(r=>r.id!==id).slice(0,4);
        document.getElementById('relatedList').innerHTML = related.map(r=>`
            <a href="/service-details?id=${r.id}" class="related-item">
                <div class="rel-icon"><i class="fas ${r.icon}"></i></div>
                <span>${r.label}</span>
            </a>`).join('');

        document.getElementById('serviceTypeSelect').innerHTML =
            '<option value="">اختر نوع الاستشارة</option>' +
            s.offers.map(o=>`<option>${o.title}</option>`).join('');
    }
    buildPage();

    function openModal(){ document.getElementById('bookingModal').classList.add('open'); document.body.style.overflow='hidden'; }
    function closeModal(){ document.getElementById('bookingModal').classList.remove('open'); document.body.style.overflow=''; setTimeout(()=>{ document.getElementById('formState').style.display=''; document.getElementById('successState').style.display='none'; },300); }
    function submitBooking(e){ e.preventDefault(); document.getElementById('formState').style.display='none'; document.getElementById('successState').style.display='block'; }
    document.getElementById('bookingModal').addEventListener('click',function(e){ if(e.target===this)closeModal(); });

    (function(){
        const canvas=document.getElementById('bg-canvas');
        if(!canvas||!window.THREE)return;
        const W=window.innerWidth,H=window.innerHeight;
        const scene=new THREE.Scene();
        const camera=new THREE.PerspectiveCamera(60,W/H,0.1,1000);
        camera.position.z=14;
        const renderer=new THREE.WebGLRenderer({canvas,alpha:true,antialias:true});
        renderer.setSize(W,H);renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));
        renderer.setClearColor(0x000000,0);
        const COUNT=100,geo=new THREE.BufferGeometry();
        const pos=new Float32Array(COUNT*3),vel=[];
        for(let i=0;i<COUNT;i++){pos[i*3]=(Math.random()-.5)*28;pos[i*3+1]=(Math.random()-.5)*28;pos[i*3+2]=(Math.random()-.5)*4;vel.push({x:(Math.random()-.5)*0.01,y:(Math.random()-.5)*0.01});}
        geo.setAttribute('position',new THREE.BufferAttribute(pos,3));
        scene.add(new THREE.Points(geo,new THREE.PointsMaterial({color:0x38bdf8,size:0.09,transparent:true,opacity:0.5})));
        const MAX_L=250,lPos=new Float32Array(MAX_L*6),lGeo=new THREE.BufferGeometry();
        lGeo.setAttribute('position',new THREE.BufferAttribute(lPos,3));lGeo.setDrawRange(0,0);
        scene.add(new THREE.LineSegments(lGeo,new THREE.LineBasicMaterial({color:0x7dd3fc,transparent:true,opacity:0.12})));
        (function animate(){
            requestAnimationFrame(animate);
            for(let i=0;i<COUNT;i++){pos[i*3]+=vel[i].x;pos[i*3+1]+=vel[i].y;if(Math.abs(pos[i*3])>14)vel[i].x*=-1;if(Math.abs(pos[i*3+1])>14)vel[i].y*=-1;}
            geo.attributes.position.needsUpdate=true;
            let li=0;
            for(let i=0;i<COUNT&&li<MAX_L;i++)for(let j=i+1;j<COUNT&&li<MAX_L;j++){const dx=pos[i*3]-pos[j*3],dy=pos[i*3+1]-pos[j*3+1];if(Math.sqrt(dx*dx+dy*dy)<5.5){lPos[li*6]=pos[i*3];lPos[li*6+1]=pos[i*3+1];lPos[li*6+2]=0;lPos[li*6+3]=pos[j*3];lPos[li*6+4]=pos[j*3+1];lPos[li*6+5]=0;li++;}}
            lGeo.setDrawRange(0,li*2);lGeo.attributes.position.needsUpdate=true;
            renderer.render(scene,camera);
        })();
        window.addEventListener('resize',()=>{camera.aspect=window.innerWidth/window.innerHeight;camera.updateProjectionMatrix();renderer.setSize(window.innerWidth,window.innerHeight);});
    })();

    const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting)x.target.classList.add('visible');}),{threshold:0.1});
    document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
    </script>
</body>
</html>
