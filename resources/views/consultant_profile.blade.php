<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بروفايل المستشار | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>

        /* Override home-page GIF background from style.css */
        body {
            background: #f8fafc !important;
            color: #1e293b;
        }

        /* ===========================
           STEPS BAR
        =========================== */
        .steps-bar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 18px 5%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
            white-space: nowrap;
        }

        .step.done              { color: #4299e1; }
        .step.done  .step-num  { background: #4299e1; color: #fff; }
        .step.active            { color: #0f172a; }
        .step.active .step-num  { background: #0f172a; color: #fff; }

        .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .step-divider {
            width: 60px;
            height: 2px;
            background: #e2e8f0;
            margin: 0 10px;
            flex-shrink: 0;
        }

        .step-divider.done { background: #4299e1; }

        /* ===========================
           PAGE BANNER
        =========================== */
        .page-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 32px 5%;
            color: #fff;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .breadcrumb a             { color: #94a3b8; text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover       { color: #4299e1; }
        .breadcrumb .current      { color: #4299e1; }
        .breadcrumb i             { font-size: 10px; }

        .banner-title { font-size: 24px; font-weight: 800; color: #fff; margin-bottom: 4px; }
        .banner-sub   { font-size: 13px; color: #94a3b8; }

        /* ===========================
           PROFILE LAYOUT
        =========================== */
        .profile-container {
            max-width: 1180px;
            margin: 40px auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 330px 1fr;
            gap: 30px;
            align-items: start;
        }

        /* ===========================
           LEFT — STICKY CARD
        =========================== */
        .profile-card {
            background: #fff;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            position: sticky;
            top: 95px;
        }

        .profile-photo {
            width: 100%;
            height: 255px;
            object-fit: cover;
            object-position: top;
            display: block;
        }

        .profile-info { padding: 22px; }

        .profile-badge {
            display: inline-block;
            background: #eff6ff;
            color: #2563eb;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .profile-name         { font-size: 21px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .profile-specialty    { color: #64748b; font-size: 13px; margin-bottom: 15px; }

        .stars {
            display: flex;
            align-items: center;
            gap: 3px;
            margin-bottom: 18px;
        }

        .stars i            { color: #f59e0b; font-size: 14px; }
        .stars .rating-text { color: #64748b; font-size: 12px; margin-right: 4px; }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .stat-item  { background: #f8fafc; padding: 13px 6px; text-align: center; }
        .stat-value { display: block; font-size: 19px; font-weight: 800; color: #0f172a; }
        .stat-label { display: block; font-size: 10px; color: #64748b; margin-top: 2px; }

        .btn-select {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, #1d4ed8, #4299e1);
            color: #fff;
            text-align: center;
            padding: 14px;
            border-radius: 13px;
            font-size: 15px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-family: 'Cairo', sans-serif;
        }

        .btn-select:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        /* ===========================
           RIGHT — DETAIL SECTIONS
        =========================== */
        .profile-details { display: flex; flex-direction: column; gap: 22px; }

        .detail-section {
            background: #fff;
            border-radius: 20px;
            padding: 26px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 18px;
            padding-bottom: 13px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .section-title i { color: #4299e1; }

        /* Bio */
        .bio-text { color: #475569; font-size: 14px; line-height: 2; }

        /* Skills */
        .skills-grid { display: flex; flex-wrap: wrap; gap: 8px; }

        .skill-tag {
            background: #f1f5f9;
            color: #334155;
            padding: 7px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }

        /* Experience */
        .exp-list { list-style: none; display: flex; flex-direction: column; gap: 15px; }

        .exp-item { display: flex; gap: 13px; align-items: flex-start; }

        .exp-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #4299e1;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .exp-title { font-weight: 700; color: #1e293b; font-size: 14px; margin-bottom: 2px; }
        .exp-sub   { color: #64748b; font-size: 12px; }

        /* Reviews */
        .review-card {
            background: #f8fafc;
            border-radius: 13px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            margin-bottom: 12px;
        }

        .review-card:last-child   { margin-bottom: 0; }
        .review-header            { display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px; }
        .reviewer-name            { font-weight: 700; color: #1e293b; font-size: 14px; }
        .review-stars i           { color: #f59e0b; font-size: 12px; }
        .review-text              { color: #64748b; font-size: 13px; line-height: 1.75; }

        /* ===========================
           RESPONSIVE
        =========================== */
        @media (max-width: 900px) {
            .profile-container      { grid-template-columns: 1fr; }
            .profile-card           { position: static; }
            .step span              { display: none; }
            .step-divider           { width: 30px; }
        }
    </style>
</head>
<body>

<!-- ============ PROGRESS STEPS ============ -->
<div class="steps-bar">
    <div class="step done">
        <div class="step-num"><i class="fa fa-check" style="font-size:10px;"></i></div>
        <span>نوع الاستشارة</span>
    </div>
    <div class="step-divider done"></div>
    <div class="step done">
        <div class="step-num"><i class="fa fa-check" style="font-size:10px;"></i></div>
        <span>قائمة المستشارين</span>
    </div>
    <div class="step-divider done"></div>
    <div class="step active">
        <div class="step-num">3</div>
        <span>بروفايل المستشار</span>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-num">4</div>
        <span>تأكيد الحجز</span>
    </div>
</div>

<!-- ============ PAGE BANNER ============ -->
<div class="page-banner">
    <div class="breadcrumb">
        <a href="/">الرئيسية</a>
        <i class="fa fa-angle-left"></i>
        <a href="/consultants">الاستشارات</a>
        <i class="fa fa-angle-left"></i>
        <a href="/consultants-list">المستشارون</a>
        <i class="fa fa-angle-left"></i>
        <span class="current">بروفايل المستشار</span>
    </div>
    <h1 class="banner-title">د. أحمد محمد الزهراني</h1>
    <p class="banner-sub">مستشار استراتيجي أول · خبرة 18 سنة</p>
</div>

<!-- ============ PROFILE CONTENT ============ -->
<div class="profile-container">

    <!-- LEFT: Sticky Card -->
    <div class="profile-card">
        <img src="https://api.dicebear.com/7.x/initials/svg?seed=pixel-art-${i}&backgroundColor=2c3e50,34495e,7f8c8d" alt="د. أحمد الزهراني" class="profile-photo">
        <div class="profile-info">

            <span class="profile-badge">مستشار كبير · معتمد</span>
            <h2 class="profile-name">د. أحمد محمد الزهراني</h2>
            <p class="profile-specialty">
                <i class="fa fa-briefcase" style="color:#4299e1; margin-left:5px;"></i>
                الاستراتيجية وتطوير الأعمال
            </p>

            <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-alt"></i>
                <span class="rating-text">4.8 (127 تقييم)</span>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-value">18</span>
                    <span class="stat-label">سنوات خبرة</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">240+</span>
                    <span class="stat-label">عميل سابق</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">98%</span>
                    <span class="stat-label">رضا العملاء</span>
                </div>
            </div>

            <a href="/consultant_booking-confirm" class="btn-select">
                <i class="fa fa-calendar-check" style="margin-left:8px;"></i>
                احجز مع هذا المستشار
            </a>

        </div>
    </div>

    <!-- RIGHT: Details -->
    <div class="profile-details">

        <!-- نبذة -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fa fa-user-circle"></i> نبذة عن المستشار</h3>
            <p class="bio-text">
                د. أحمد الزهراني خبير استراتيجي معتمد بخبرة تمتد لأكثر من 18 عاماً في مجال الاستراتيجية وتطوير الأعمال.
                عمل مع كبرى الشركات السعودية والخليجية في مجالات التحول الاستراتيجي، دخول الأسواق الجديدة، وإعادة الهيكلة التنظيمية.
                <br><br>
                حاصل على درجة الدكتوراه في إدارة الأعمال من جامعة هارفارد، وشريك سابق في شركة ماكنزي للاستشارات الدولية.
                يتميز بأسلوبه التحليلي العميق وقدرته على تقديم حلول عملية تحقق نتائج ملموسة في وقت قصير.
            </p>
        </div>

        <!-- مجالات التخصص -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fa fa-tags"></i> مجالات التخصص</h3>
            <div class="skills-grid">
                <span class="skill-tag">الاستراتيجية التنافسية</span>
                <span class="skill-tag">دخول الأسواق الجديدة</span>
                <span class="skill-tag">الاندماج والاستحواذ</span>
                <span class="skill-tag">التحول الرقمي</span>
                <span class="skill-tag">إدارة المخاطر</span>
                <span class="skill-tag">رؤية 2030</span>
                <span class="skill-tag">نمذجة الأعمال</span>
                <span class="skill-tag">حوكمة الشركات</span>
            </div>
        </div>

        <!-- المسيرة المهنية -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fa fa-briefcase"></i> المسيرة المهنية</h3>
            <ul class="exp-list">
                <li class="exp-item">
                    <div class="exp-dot"></div>
                    <div>
                        <div class="exp-title">شريك أول · شركة أمر تم</div>
                        <div class="exp-sub">2019 – حتى الآن · الرياض، المملكة العربية السعودية</div>
                    </div>
                </li>
                <li class="exp-item">
                    <div class="exp-dot"></div>
                    <div>
                        <div class="exp-title">شريك · ماكنزي للاستشارات</div>
                        <div class="exp-sub">2012 – 2019 · دبي، الإمارات العربية المتحدة</div>
                    </div>
                </li>
                <li class="exp-item">
                    <div class="exp-dot"></div>
                    <div>
                        <div class="exp-title">مستشار أول · بوز ألن هاميلتون</div>
                        <div class="exp-sub">2006 – 2012 · الرياض، المملكة العربية السعودية</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- آراء العملاء -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fa fa-star"></i> آراء العملاء</h3>

            <div class="review-card">
                <div class="review-header">
                    <span class="reviewer-name">م. خالد العتيبي</span>
                    <div class="review-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    </div>
                </div>
                <p class="review-text">تجربة استثنائية، ساعدنا في إعادة هيكلة استراتيجية الشركة بالكامل وتحقيق نمو 40% في سنة واحدة.</p>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <span class="reviewer-name">أ. فاطمة السلمي</span>
                    <div class="review-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i>
                    </div>
                </div>
                <p class="review-text">أسلوبه واضح ومباشر، يقدم حلولاً عملية قابلة للتطبيق. أنصح به بشدة لأي شركة تبحث عن التوسع.</p>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <span class="reviewer-name">أ. عبدالرحمن القحطاني</span>
                    <div class="review-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    </div>
                </div>
                <p class="review-text">خبير متميز بكل المقاييس، لديه رؤية عميقة للسوق السعودي وفهم دقيق لمتطلبات رؤية 2030.</p>
            </div>

        </div>

    </div>
</div>



<script>
    const accountBtn   = document.getElementById('accountBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    accountBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('active');
    });
    document.addEventListener('click', () => dropdownMenu.classList.remove('active'));
</script>

</body>
</html>
