<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة الامتياز والوكالات | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <link rel="stylesheet" href="/css/agencies.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="inner-page agencies-page">

<canvas id="bg-canvas" class="page-canvas" data-color="0ea5e9" data-linecolor="38bdf8"></canvas>
@include('partials.public_nav')

<!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
<section class="ag-hero">
    <div class="ag-hero-overlay"></div>
    <div class="ag-hero-content container">
        <div class="ag-hero-text">
            <div class="page-hero-badge"><i class="fa fa-store"></i> منصة الامتياز والوكالات</div>
            <h1>اكتشف فرصة عملك<br><span class="gradient-text">في عالم الامتياز</span></h1>
            <p>منصة سعودية متخصصة تربط أصحاب العلامات التجارية بالمستثمرين الطامحين لبناء مشاريعهم المستقلة تحت مظلة علامة موثوقة.</p>
            <div class="ag-hero-actions">
                <a href="#franchises" class="ag-btn-primary">استعرض الفرص المتاحة <i class="fa fa-arrow-down"></i></a>
                <a href="#register" class="ag-btn-outline">سجّل علامتك التجارية <i class="fa fa-plus"></i></a>
            </div>
            <div class="ag-hero-trust">
                <span><i class="fa fa-check-circle" style="color:#10b981;"></i> +40 علامة موثقة</span>
                <span><i class="fa fa-check-circle" style="color:#10b981;"></i> دعم متكامل للمستثمر</span>
                <span><i class="fa fa-check-circle" style="color:#10b981;"></i> متوافق مع رؤية 2030</span>
            </div>
        </div>
        <div class="ag-hero-visual">
            <div class="ag-floating-cards">
                <div class="ag-float-card ag-fc-1">
                    <i class="fa fa-coffee"></i>
                    <span>مطاعم ومقاهي</span>
                </div>
                <div class="ag-float-card ag-fc-2">
                    <i class="fa fa-graduation-cap"></i>
                    <span>تعليم وتدريب</span>
                </div>
                <div class="ag-float-card ag-fc-3">
                    <i class="fa fa-heartbeat"></i>
                    <span>لياقة وصحة</span>
                </div>
                <div class="ag-float-card ag-fc-4">
                    <i class="fa fa-laptop-code"></i>
                    <span>تقنية</span>
                </div>
                <div class="ag-hero-center-badge">
                    <div class="ag-center-icon"><i class="fa fa-handshake"></i></div>
                    <div class="ag-center-label">منصة الامتياز</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ STATS ═══════════════════════════════ -->
<section class="ag-stats-bar">
    <div class="container">
        <div class="ag-stats-grid">
            <div class="ag-stat-item">
                <span class="ag-stat-num counter" data-target="42">0</span>
                <span class="ag-stat-label">علامة تجارية مرخصة</span>
            </div>
            <div class="ag-stat-divider"></div>
            <div class="ag-stat-item">
                <span class="ag-stat-num counter" data-target="185">0</span>
                <span class="ag-stat-label">مستثمر مسجل</span>
            </div>
            <div class="ag-stat-divider"></div>
            <div class="ag-stat-item">
                <span class="ag-stat-num counter" data-target="67">0</span>
                <span class="ag-stat-label">صفقة امتياز منجزة</span>
            </div>
            <div class="ag-stat-divider"></div>
            <div class="ag-stat-item">
                <span class="ag-stat-num counter" data-target="13">0</span>
                <span class="ag-stat-label">منطقة جغرافية مغطاة</span>
            </div>
            <div class="ag-stat-divider"></div>
            <div class="ag-stat-item">
                <span class="ag-stat-num counter" data-target="98">0</span>
                <span class="ag-stat-label">%</span>
                <span class="ag-stat-label">رضا المستثمرين</span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ HOW IT WORKS ═══════════════════════════════ -->
<section class="content-section" id="how-it-works">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">كيف تعمل المنصة</div>
            <h2 class="section-title">ثلاث خطوات نحو مشروعك</h2>
        </div>
        <div class="ag-steps reveal">
            <div class="ag-step">
                <div class="ag-step-num">01</div>
                <div class="ag-step-icon"><i class="fa fa-search"></i></div>
                <h3>استعرض وقارن</h3>
                <p>تصفح مئات فرص الامتياز المصنفة حسب القطاع والاستثمار والمنطقة، وقارن بينها بكل سهولة.</p>
            </div>
            <div class="ag-step-arrow"><i class="fa fa-chevron-left"></i></div>
            <div class="ag-step">
                <div class="ag-step-num">02</div>
                <div class="ag-step-icon"><i class="fa fa-file-alt"></i></div>
                <h3>قدّم طلبك</h3>
                <p>أرسل طلب التقدم مع المعلومات المطلوبة وسيتواصل معك مسؤول المنصة خلال 48 ساعة.</p>
            </div>
            <div class="ag-step-arrow"><i class="fa fa-chevron-left"></i></div>
            <div class="ag-step">
                <div class="ag-step-num">03</div>
                <div class="ag-step-icon"><i class="fa fa-rocket"></i></div>
                <h3>أطلق مشروعك</h3>
                <p>بعد توقيع العقد يدعمك فريق متخصص طوال رحلة إطلاق مشروعك حتى النجاح.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ CATEGORIES ═══════════════════════════════ -->
<section class="content-section alt-bg">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">القطاعات</div>
            <h2 class="section-title">تصفح حسب المجال</h2>
        </div>
        <div class="ag-cats reveal" id="catFilter">
            <button class="ag-cat active" data-filter="all">
                <i class="fa fa-th-large"></i> الكل
            </button>
            <button class="ag-cat" data-filter="food">
                <i class="fa fa-utensils"></i> مطاعم ومقاهي
            </button>
            <button class="ag-cat" data-filter="edu">
                <i class="fa fa-graduation-cap"></i> تعليم وتدريب
            </button>
            <button class="ag-cat" data-filter="fitness">
                <i class="fa fa-dumbbell"></i> لياقة وصحة
            </button>
            <button class="ag-cat" data-filter="tech">
                <i class="fa fa-laptop-code"></i> تقنية
            </button>
            <button class="ag-cat" data-filter="home">
                <i class="fa fa-broom"></i> خدمات منزلية
            </button>
            <button class="ag-cat" data-filter="retail">
                <i class="fa fa-shopping-bag"></i> تجزئة
            </button>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ FRANCHISES ═══════════════════════════════ -->
<section class="content-section" id="franchises">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">فرص الامتياز</div>
            <h2 class="section-title">علامات تجارية موثوقة تنتظرك</h2>
        </div>

        <div class="ag-franchises-grid" id="franchisesGrid">

            <!-- بن زيد للقهوة العربية -->
            <div class="ag-franchise-card reveal" data-cat="food">
                <div class="ag-fc-header" style="background:linear-gradient(135deg,#92400e,#d97706);">
                    <div class="ag-fc-icon"><i class="fa fa-coffee"></i></div>
                    <div class="ag-fc-badges">
                        <span class="ag-badge ag-badge-hot"><i class="fa fa-fire"></i> الأكثر طلباً</span>
                    </div>
                </div>
                <div class="ag-fc-body">
                    <div class="ag-fc-cat-tag" style="color:#d97706;border-color:rgba(217,119,6,0.3);background:rgba(217,119,6,0.08);">
                        <i class="fa fa-utensils"></i> مطاعم ومقاهي
                    </div>
                    <h3>بن زيد للقهوة العربية</h3>
                    <p class="ag-fc-en">Bin Zaid Arabic Coffee</p>
                    <p class="ag-fc-desc">سلسلة قهوة سعودية أصيلة بنكهة عربية معاصرة، تمتلك أكثر من 30 فرعاً في المملكة وتعمل على التوسع.</p>
                    <div class="ag-fc-meta">
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-coins" style="color:#f59e0b;"></i>
                            <div>
                                <span class="ag-fc-meta-label">الاستثمار</span>
                                <span class="ag-fc-meta-val">250,000 — 500,000 ر.س</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-clock" style="color:#38bdf8;"></i>
                            <div>
                                <span class="ag-fc-meta-label">عائد الاستثمار</span>
                                <span class="ag-fc-meta-val">18 — 24 شهراً</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-map-marker-alt" style="color:#10b981;"></i>
                            <div>
                                <span class="ag-fc-meta-label">المناطق المتاحة</span>
                                <span class="ag-fc-meta-val">الرياض، جدة، الدمام</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-percentage" style="color:#a78bfa;"></i>
                            <div>
                                <span class="ag-fc-meta-label">رسوم الامتياز</span>
                                <span class="ag-fc-meta-val">5% من الإيرادات</span>
                            </div>
                        </div>
                    </div>
                    <div class="ag-fc-requirements">
                        <span class="ag-req-tag"><i class="fa fa-check"></i> خبرة في الأغذية</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> مساحة 40-80م²</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> سجل تجاري</span>
                    </div>
                    <button class="ag-fc-btn" onclick="openApplyModal('بن زيد للقهوة العربية')">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- أكاديمية المستقبل -->
            <div class="ag-franchise-card reveal" data-cat="edu">
                <div class="ag-fc-header" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
                    <div class="ag-fc-icon"><i class="fa fa-graduation-cap"></i></div>
                    <div class="ag-fc-badges">
                        <span class="ag-badge ag-badge-new"><i class="fa fa-star"></i> جديد</span>
                    </div>
                </div>
                <div class="ag-fc-body">
                    <div class="ag-fc-cat-tag" style="color:#3b82f6;border-color:rgba(59,130,246,0.3);background:rgba(59,130,246,0.08);">
                        <i class="fa fa-graduation-cap"></i> تعليم وتدريب
                    </div>
                    <h3>أكاديمية المستقبل</h3>
                    <p class="ag-fc-en">Future Academy</p>
                    <p class="ag-fc-desc">مراكز تعليمية متكاملة للأطفال والشباب تقدم برامج ترميز، مهارات رقمية، وذكاء اصطناعي.</p>
                    <div class="ag-fc-meta">
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-coins" style="color:#f59e0b;"></i>
                            <div>
                                <span class="ag-fc-meta-label">الاستثمار</span>
                                <span class="ag-fc-meta-val">150,000 — 300,000 ر.س</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-clock" style="color:#38bdf8;"></i>
                            <div>
                                <span class="ag-fc-meta-label">عائد الاستثمار</span>
                                <span class="ag-fc-meta-val">12 — 18 شهراً</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-map-marker-alt" style="color:#10b981;"></i>
                            <div>
                                <span class="ag-fc-meta-label">المناطق المتاحة</span>
                                <span class="ag-fc-meta-val">جميع المناطق</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-percentage" style="color:#a78bfa;"></i>
                            <div>
                                <span class="ag-fc-meta-label">رسوم الامتياز</span>
                                <span class="ag-fc-meta-val">8% من الإيرادات</span>
                            </div>
                        </div>
                    </div>
                    <div class="ag-fc-requirements">
                        <span class="ag-req-tag"><i class="fa fa-check"></i> مساحة 80-150م²</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> موقع حيوي</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> فريق تعليمي</span>
                    </div>
                    <button class="ag-fc-btn" onclick="openApplyModal('أكاديمية المستقبل')">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- فيت بلس -->
            <div class="ag-franchise-card reveal" data-cat="fitness">
                <div class="ag-fc-header" style="background:linear-gradient(135deg,#065f46,#059669);">
                    <div class="ag-fc-icon"><i class="fa fa-dumbbell"></i></div>
                </div>
                <div class="ag-fc-body">
                    <div class="ag-fc-cat-tag" style="color:#059669;border-color:rgba(5,150,105,0.3);background:rgba(5,150,105,0.08);">
                        <i class="fa fa-dumbbell"></i> لياقة وصحة
                    </div>
                    <h3>فيت بلس للياقة البدنية</h3>
                    <p class="ag-fc-en">Fit Plus Fitness</p>
                    <p class="ag-fc-desc">صالة رياضية متطورة مع برامج تدريب شخصية وتغذية، تجمع التقنية مع اللياقة لتجربة استثنائية.</p>
                    <div class="ag-fc-meta">
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-coins" style="color:#f59e0b;"></i>
                            <div>
                                <span class="ag-fc-meta-label">الاستثمار</span>
                                <span class="ag-fc-meta-val">400,000 — 800,000 ر.س</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-clock" style="color:#38bdf8;"></i>
                            <div>
                                <span class="ag-fc-meta-label">عائد الاستثمار</span>
                                <span class="ag-fc-meta-val">20 — 30 شهراً</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-map-marker-alt" style="color:#10b981;"></i>
                            <div>
                                <span class="ag-fc-meta-label">المناطق المتاحة</span>
                                <span class="ag-fc-meta-val">الرياض، جدة</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-percentage" style="color:#a78bfa;"></i>
                            <div>
                                <span class="ag-fc-meta-label">رسوم الامتياز</span>
                                <span class="ag-fc-meta-val">6% من الإيرادات</span>
                            </div>
                        </div>
                    </div>
                    <div class="ag-fc-requirements">
                        <span class="ag-req-tag"><i class="fa fa-check"></i> 300-600م²</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> دور أرضي</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> مواقف سيارات</span>
                    </div>
                    <button class="ag-fc-btn" onclick="openApplyModal('فيت بلس للياقة البدنية')">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- تك هاوس -->
            <div class="ag-franchise-card reveal" data-cat="tech">
                <div class="ag-fc-header" style="background:linear-gradient(135deg,#4c1d95,#7c3aed);">
                    <div class="ag-fc-icon"><i class="fa fa-laptop-code"></i></div>
                    <div class="ag-fc-badges">
                        <span class="ag-badge ag-badge-premium">مميز</span>
                    </div>
                </div>
                <div class="ag-fc-body">
                    <div class="ag-fc-cat-tag" style="color:#7c3aed;border-color:rgba(124,58,237,0.3);background:rgba(124,58,237,0.08);">
                        <i class="fa fa-laptop-code"></i> تقنية
                    </div>
                    <h3>تك هاوس للتقنية</h3>
                    <p class="ag-fc-en">Tech House</p>
                    <p class="ag-fc-desc">مركز متخصص في بيع وصيانة الأجهزة التقنية، مع خدمات دعم الشركات والحلول الرقمية المتكاملة.</p>
                    <div class="ag-fc-meta">
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-coins" style="color:#f59e0b;"></i>
                            <div>
                                <span class="ag-fc-meta-label">الاستثمار</span>
                                <span class="ag-fc-meta-val">200,000 — 400,000 ر.س</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-clock" style="color:#38bdf8;"></i>
                            <div>
                                <span class="ag-fc-meta-label">عائد الاستثمار</span>
                                <span class="ag-fc-meta-val">14 — 22 شهراً</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-map-marker-alt" style="color:#10b981;"></i>
                            <div>
                                <span class="ag-fc-meta-label">المناطق المتاحة</span>
                                <span class="ag-fc-meta-val">جميع المناطق</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-percentage" style="color:#a78bfa;"></i>
                            <div>
                                <span class="ag-fc-meta-label">رسوم الامتياز</span>
                                <span class="ag-fc-meta-val">4% من الإيرادات</span>
                            </div>
                        </div>
                    </div>
                    <div class="ag-fc-requirements">
                        <span class="ag-req-tag"><i class="fa fa-check"></i> مساحة 60-120م²</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> موقع تجاري</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> خبرة تقنية</span>
                    </div>
                    <button class="ag-fc-btn" onclick="openApplyModal('تك هاوس للتقنية')">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- سبارك كلين -->
            <div class="ag-franchise-card reveal" data-cat="home">
                <div class="ag-fc-header" style="background:linear-gradient(135deg,#0369a1,#0ea5e9);">
                    <div class="ag-fc-icon"><i class="fa fa-broom"></i></div>
                    <div class="ag-fc-badges">
                        <span class="ag-badge ag-badge-hot"><i class="fa fa-bolt"></i> سريع العائد</span>
                    </div>
                </div>
                <div class="ag-fc-body">
                    <div class="ag-fc-cat-tag" style="color:#0ea5e9;border-color:rgba(14,165,233,0.3);background:rgba(14,165,233,0.08);">
                        <i class="fa fa-broom"></i> خدمات منزلية
                    </div>
                    <h3>سبارك كلين للتنظيف</h3>
                    <p class="ag-fc-en">Spark Clean</p>
                    <p class="ag-fc-desc">شركة تنظيف متخصصة بأساليب عصرية وفريق محترف، تخدم الأفراد والشركات والمجمعات السكنية.</p>
                    <div class="ag-fc-meta">
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-coins" style="color:#f59e0b;"></i>
                            <div>
                                <span class="ag-fc-meta-label">الاستثمار</span>
                                <span class="ag-fc-meta-val">80,000 — 150,000 ر.س</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-clock" style="color:#38bdf8;"></i>
                            <div>
                                <span class="ag-fc-meta-label">عائد الاستثمار</span>
                                <span class="ag-fc-meta-val">8 — 14 شهراً</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-map-marker-alt" style="color:#10b981;"></i>
                            <div>
                                <span class="ag-fc-meta-label">المناطق المتاحة</span>
                                <span class="ag-fc-meta-val">جميع المناطق</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-percentage" style="color:#a78bfa;"></i>
                            <div>
                                <span class="ag-fc-meta-label">رسوم الامتياز</span>
                                <span class="ag-fc-meta-val">7% من الإيرادات</span>
                            </div>
                        </div>
                    </div>
                    <div class="ag-fc-requirements">
                        <span class="ag-req-tag"><i class="fa fa-check"></i> مستودع صغير</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> سيارة/سيارتان</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> فريق عمل</span>
                    </div>
                    <button class="ag-fc-btn" onclick="openApplyModal('سبارك كلين للتنظيف')">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- الأصيل للحلويات -->
            <div class="ag-franchise-card reveal" data-cat="food">
                <div class="ag-fc-header" style="background:linear-gradient(135deg,#be185d,#db2777);">
                    <div class="ag-fc-icon"><i class="fa fa-birthday-cake"></i></div>
                </div>
                <div class="ag-fc-body">
                    <div class="ag-fc-cat-tag" style="color:#db2777;border-color:rgba(219,39,119,0.3);background:rgba(219,39,119,0.08);">
                        <i class="fa fa-utensils"></i> مطاعم ومقاهي
                    </div>
                    <h3>الأصيل للحلويات الشرقية</h3>
                    <p class="ag-fc-en">Al-Aseel Oriental Sweets</p>
                    <p class="ag-fc-desc">علامة حلويات سعودية أصيلة تمزج بين التراث والحداثة، شهرة واسعة وقاعدة عملاء وفية.</p>
                    <div class="ag-fc-meta">
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-coins" style="color:#f59e0b;"></i>
                            <div>
                                <span class="ag-fc-meta-label">الاستثمار</span>
                                <span class="ag-fc-meta-val">180,000 — 350,000 ر.س</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-clock" style="color:#38bdf8;"></i>
                            <div>
                                <span class="ag-fc-meta-label">عائد الاستثمار</span>
                                <span class="ag-fc-meta-val">15 — 20 شهراً</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-map-marker-alt" style="color:#10b981;"></i>
                            <div>
                                <span class="ag-fc-meta-label">المناطق المتاحة</span>
                                <span class="ag-fc-meta-val">الرياض، مكة، المدينة</span>
                            </div>
                        </div>
                        <div class="ag-fc-meta-item">
                            <i class="fa fa-percentage" style="color:#a78bfa;"></i>
                            <div>
                                <span class="ag-fc-meta-label">رسوم الامتياز</span>
                                <span class="ag-fc-meta-val">6% من الإيرادات</span>
                            </div>
                        </div>
                    </div>
                    <div class="ag-fc-requirements">
                        <span class="ag-req-tag"><i class="fa fa-check"></i> 50-100م²</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> موقع تجاري</span>
                        <span class="ag-req-tag"><i class="fa fa-check"></i> ثلاجات عرض</span>
                    </div>
                    <button class="ag-fc-btn" onclick="openApplyModal('الأصيل للحلويات الشرقية')">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════ WHY US ═══════════════════════════════ -->
<section class="content-section alt-bg">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">لماذا أمر تم</div>
            <h2 class="section-title">نقدم أكثر من مجرد قائمة</h2>
        </div>
        <div class="ag-why-grid reveal">
            <div class="ag-why-item">
                <div class="ag-why-icon"><i class="fa fa-shield-alt"></i></div>
                <h4>توثيق وفحص معمّق</h4>
                <p>كل علامة تجارية تمر بعملية فحص شاملة للتأكد من جاهزيتها للامتياز قبل نشرها على المنصة.</p>
            </div>
            <div class="ag-why-item">
                <div class="ag-why-icon"><i class="fa fa-balance-scale"></i></div>
                <h4>دعم قانوني متكامل</h4>
                <p>فريق قانوني متخصص يرافقك من صياغة العقود حتى التوقيع النهائي لحماية حقوقك بالكامل.</p>
            </div>
            <div class="ag-why-item">
                <div class="ag-why-icon"><i class="fa fa-chalkboard-teacher"></i></div>
                <h4>تدريب وتأهيل</h4>
                <p>برامج تدريبية معتمدة لتهيئتك بالكامل لإدارة مشروعك بكفاءة واحترافية عالية.</p>
            </div>
            <div class="ag-why-item">
                <div class="ag-why-icon"><i class="fa fa-chart-line"></i></div>
                <h4>دراسات جدوى دقيقة</h4>
                <p>نوفر لك دراسات جدوى محدّثة لكل فرصة تساعدك على اتخاذ قرار استثماري مدروس.</p>
            </div>
            <div class="ag-why-item">
                <div class="ag-why-icon"><i class="fa fa-headset"></i></div>
                <h4>دعم مستمر بعد الإطلاق</h4>
                <p>لا ينتهي دورنا بتوقيع العقد — نتابع معك خلال الأشهر الأولى حتى تستقر عملياتك.</p>
            </div>
            <div class="ag-why-item">
                <div class="ag-why-icon"><i class="fa fa-globe-asia"></i></div>
                <h4>شبكة استثمارية واسعة</h4>
                <p>شبكة من المستثمرين والشركاء في جميع مناطق المملكة تتيح لك التواصل والنمو بسرعة.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ REGISTER CTA ═══════════════════════════════ -->
<section class="content-section" id="register">
    <div class="container">
        <div class="ag-register-split reveal">
            <div class="ag-reg-card ag-reg-investor">
                <div class="ag-reg-icon"><i class="fa fa-user-tie"></i></div>
                <h3>أنا مستثمر</h3>
                <p>ابحث عن فرصة امتياز تناسب ميزانيتك وأهدافك وابدأ رحلة مشروعك المستقل اليوم.</p>
                <ul>
                    <li><i class="fa fa-check"></i> تصفح كل الفرص مجاناً</li>
                    <li><i class="fa fa-check"></i> تواصل مباشر مع أصحاب العلامات</li>
                    <li><i class="fa fa-check"></i> دعم قانوني وتدريبي متكامل</li>
                </ul>
                <a href="/register" class="ag-reg-btn">سجّل كمستثمر <i class="fa fa-arrow-left"></i></a>
            </div>
            <div class="ag-reg-divider"><span>أو</span></div>
            <div class="ag-reg-card ag-reg-franchisor">
                <div class="ag-reg-icon"><i class="fa fa-store"></i></div>
                <h3>أنا صاحب علامة تجارية</h3>
                <p>سجّل علامتك التجارية على المنصة وابدأ في استقطاب مستثمرين موثوقين لتوسيع شبكتك.</p>
                <ul>
                    <li><i class="fa fa-check"></i> صفحة احترافية لعلامتك</li>
                    <li><i class="fa fa-check"></i> وصول لأكثر من 1,000 مستثمر</li>
                    <li><i class="fa fa-check"></i> إدارة كاملة للطلبات والعقود</li>
                </ul>
                <a href="/contact" class="ag-reg-btn ag-reg-btn-alt">سجّل علامتك <i class="fa fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ TESTIMONIALS ═══════════════════════════════ -->
<section class="content-section alt-bg">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-label">قصص نجاح</div>
            <h2 class="section-title">مستثمرون نجحوا معنا</h2>
        </div>
        <div class="ag-testimonials reveal">
            <div class="ag-testimonial">
                <div class="ag-test-quote"><i class="fa fa-quote-right"></i></div>
                <p>"بدأت مع منصة أمر تم وحصلت على امتياز بن زيد في الرياض. خلال سنة واحدة استرددت أكثر من 60% من استثماري. الدعم كان استثنائياً."</p>
                <div class="ag-test-author">
                    <div class="ag-test-avatar"><i class="fa fa-user"></i></div>
                    <div>
                        <strong>محمد العتيبي</strong>
                        <span>مستثمر، الرياض</span>
                    </div>
                </div>
            </div>
            <div class="ag-testimonial">
                <div class="ag-test-quote"><i class="fa fa-quote-right"></i></div>
                <p>"المنصة وفّرت لي كل ما احتجته: من اختيار الفرصة المناسبة، إلى الدعم القانوني، إلى التدريب. لم أشعر أنني وحدي في أي خطوة."</p>
                <div class="ag-test-author">
                    <div class="ag-test-avatar"><i class="fa fa-user"></i></div>
                    <div>
                        <strong>نورة القحطاني</strong>
                        <span>مستثمرة، جدة</span>
                    </div>
                </div>
            </div>
            <div class="ag-testimonial">
                <div class="ag-test-quote"><i class="fa fa-quote-right"></i></div>
                <p>"سجلت علامتي التجارية على المنصة وخلال 3 أشهر أغلقت 4 عقود امتياز في مناطق مختلفة. أفضل قرار اتخذته لتوسيع أعمالي."</p>
                <div class="ag-test-author">
                    <div class="ag-test-avatar"><i class="fa fa-user"></i></div>
                    <div>
                        <strong>فيصل الغامدي</strong>
                        <span>صاحب علامة تجارية، الدمام</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.public_footer')

<!-- ═══════════════════════════════ APPLY MODAL ═══════════════════════════════ -->
<div class="ag-modal-overlay" id="applyModal">
    <div class="ag-modal">
        <button class="ag-modal-close" onclick="closeApplyModal()"><i class="fa fa-times"></i></button>
        <div class="ag-modal-header">
            <div class="ag-modal-icon"><i class="fa fa-file-signature"></i></div>
            <h3>طلب الامتياز</h3>
            <p id="modalFranchiseName" style="color:#38bdf8;font-weight:700;"></p>
        </div>
        <form class="ag-modal-form" onsubmit="submitApply(event)">
            <div class="ag-form-row">
                <div class="ag-form-group">
                    <label>الاسم الكامل</label>
                    <input type="text" placeholder="أدخل اسمك الكامل" required>
                </div>
                <div class="ag-form-group">
                    <label>رقم الجوال</label>
                    <input type="tel" placeholder="+966 5X XXX XXXX" required>
                </div>
            </div>
            <div class="ag-form-row">
                <div class="ag-form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" placeholder="example@email.com" required>
                </div>
                <div class="ag-form-group">
                    <label>المنطقة</label>
                    <select required>
                        <option value="">اختر المنطقة</option>
                        <option>الرياض</option>
                        <option>جدة</option>
                        <option>مكة المكرمة</option>
                        <option>المدينة المنورة</option>
                        <option>الدمام</option>
                        <option>الأحساء</option>
                        <option>أبها</option>
                        <option>منطقة أخرى</option>
                    </select>
                </div>
            </div>
            <div class="ag-form-group">
                <label>رأس المال المتاح (ريال سعودي)</label>
                <select required>
                    <option value="">اختر النطاق</option>
                    <option>أقل من 100,000</option>
                    <option>100,000 — 300,000</option>
                    <option>300,000 — 600,000</option>
                    <option>أكثر من 600,000</option>
                </select>
            </div>
            <div class="ag-form-group">
                <label>هل لديك خبرة سابقة في الأعمال؟</label>
                <select>
                    <option>نعم، لديّ خبرة</option>
                    <option>لا، مشروعي الأول</option>
                </select>
            </div>
            <div class="ag-form-group">
                <label>ملاحظات إضافية (اختياري)</label>
                <textarea rows="3" placeholder="أي معلومات إضافية تود مشاركتها..."></textarea>
            </div>
            <button type="submit" class="ag-modal-submit">إرسال الطلب <i class="fa fa-paper-plane"></i></button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/three@0.158.0/build/three.min.js"></script>
<script src="/js/particles.js"></script>
<script>
// ---- Category filter ----
document.querySelectorAll('.ag-cat').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.ag-cat').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const f = btn.dataset.filter;
        document.querySelectorAll('.ag-franchise-card').forEach(card => {
            const show = f === 'all' || card.dataset.cat === f;
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            card.style.opacity = show ? '1' : '0.12';
            card.style.transform = show ? '' : 'scale(0.96)';
            card.style.pointerEvents = show ? '' : 'none';
        });
    });
});

// ---- Apply modal ----
function openApplyModal(name) {
    document.getElementById('modalFranchiseName').textContent = name;
    const overlay = document.getElementById('applyModal');
    overlay.classList.add('active');
    overlay.scrollTop = 0;
}
function closeApplyModal() {
    document.getElementById('applyModal').classList.remove('active');
}
function submitApply(e) {
    e.preventDefault();
    const btn = e.target.querySelector('.ag-modal-submit');
    btn.innerHTML = '<i class="fa fa-check"></i> تم إرسال الطلب بنجاح!';
    btn.style.background = 'linear-gradient(135deg,#059669,#34d399)';
    btn.disabled = true;
    setTimeout(closeApplyModal, 2200);
}
document.getElementById('applyModal').addEventListener('click', function(e) {
    if (e.target === this) closeApplyModal();
});

// ---- Counter animation ----
const counterObserver = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (!e.isIntersecting) return;
        const el = e.target;
        const target = +el.dataset.target;
        let current = 0; const step = target / 55;
        const interval = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = Math.floor(current).toLocaleString('ar-SA');
            if (current >= target) clearInterval(interval);
        }, 22);
        counterObserver.unobserve(el);
    });
}, { threshold: 0.5 });
document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

// ---- Reveal on scroll ----
const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ---- Smooth scroll for anchor links ----
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
});
</script>
</body>
</html>
