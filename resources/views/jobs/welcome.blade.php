<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>وظّفني - منصة التوظيف الذكية</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Tajawal', 'Segoe UI', Tahoma, sans-serif; }
    body { margin: 0; background: #fff; }
    .nav-link { color: #374151; font-weight: 500; font-size: 0.95rem; transition: color .2s; }
    .nav-link:hover { color: #9333ea; }
    select { background-image: none; }

    /* ===== Hero decorative background ===== */
    .hero {
      position: relative;
      background:
        radial-gradient(900px 420px at 85% -10%, rgba(147,51,234,.10), transparent 60%),
        radial-gradient(820px 420px at 10% 110%, rgba(29,78,216,.10), transparent 60%),
        radial-gradient(640px 360px at 50% 120%, rgba(8,145,178,.08), transparent 60%),
        linear-gradient(180deg, #f8f9fb 0%, #eef2f9 100%);
    }
    /* faint dot grid for texture */
    .hero::before {
      content: "";
      position: absolute; inset: 0;
      background-image: radial-gradient(rgba(99,102,241,.10) 1px, transparent 1.4px);
      background-size: 26px 26px;
      mask-image: radial-gradient(ellipse 75% 75% at 50% 40%, #000 35%, transparent 80%);
      -webkit-mask-image: radial-gradient(ellipse 75% 75% at 50% 40%, #000 35%, transparent 80%);
      pointer-events: none;
    }
    /* soft floating light blobs */
    .blob { position: absolute; border-radius: 9999px; filter: blur(46px); opacity: .55; pointer-events: none; }
    .blob-1 { width: 320px; height: 320px; top: -90px; right: -40px;
      background: radial-gradient(circle at 30% 30%, #c4b5fd, #a78bfa00 70%); animation: float1 11s ease-in-out infinite; }
    .blob-2 { width: 300px; height: 300px; bottom: -120px; left: -30px;
      background: radial-gradient(circle at 30% 30%, #93c5fd, #60a5fa00 70%); animation: float2 13s ease-in-out infinite; }
    .blob-3 { width: 220px; height: 220px; top: 40%; left: 18%;
      background: radial-gradient(circle at 30% 30%, #a5f3fc, #67e8f900 70%); animation: float1 9s ease-in-out infinite; opacity: .4; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(18px,-22px) scale(1.06); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-22px,18px) scale(1.08); } }
    @media (prefers-reduced-motion: reduce) { .blob { animation: none !important; } }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <header dir="ltr" class="w-full bg-white border-b border-gray-100">
    <div class="max-w-screen-2xl mx-auto px-6 h-16 flex items-center justify-between">

      <!-- Left: auth + country/lang -->
      <div class="flex items-center gap-3">
        <!-- signup (filled purple) -->
        <a href="#" class="px-5 py-2 rounded-lg text-sm font-bold text-white transition-all hover:shadow-md"
           style="background: linear-gradient(135deg,#9333ea,#7e22ce);">إنشاء حساب</a>
        <!-- login (outlined purple) -->
        <a href="#" class="px-5 py-2 rounded-lg text-sm font-bold transition-all hover:bg-purple-50"
           style="color:#9333ea; border:1.5px solid #d8b4fe;">تسجيل دخول</a>

        <!-- language pill -->
        <button class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-all">
          SA
          <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-400"></i>
        </button>
        <!-- country pill -->
        <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 border border-gray-200 hover:bg-gray-50 transition-all">
          <span class="w-5 h-3.5 rounded-sm overflow-hidden inline-flex items-center justify-center text-[7px] font-bold text-white" style="background:#1a7d3c;">SA</span>
          السعودية
          <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-400"></i>
        </button>
      </div>

      <!-- Center: nav links -->
      <nav class="hidden lg:flex items-center gap-7">
        <a href="#" class="nav-link">الوظائف</a>
        <a href="#" class="nav-link">الإحصائيات</a>
        <a href="#" class="nav-link">الشركات</a>
        <a href="#" class="nav-link">المدونة</a>
        <a href="#" class="nav-link">التقييمات</a>
      </nav>

      <!-- Right: logo -->
      <a href="#" class="flex items-center gap-2">
        <span class="text-xl font-extrabold" style="color:#9333ea;">وظّفني</span>
        <span class="w-9 h-9 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#9333ea,#7e22ce);">
          <i data-lucide="briefcase" class="w-5 h-5 text-white"></i>
        </span>
      </a>

    </div>
  </header>

  <!-- ===== HERO ===== -->
  <section class="hero overflow-hidden" style="padding: 3.5rem 1.5rem 3rem;">
    <span class="blob blob-1"></span>
    <span class="blob blob-2"></span>
    <span class="blob blob-3"></span>
    <div class="relative z-10 text-center max-w-5xl mx-auto">

      <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 leading-tight">
        منصة تقدم خدمات متكاملة للتوظيف والاستقدام
      </h1>

      <p class="text-sm md:text-base text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
        تربط بين الباحثين عن العمل وأصحاب الأعمال ومقدمي خدمات التوظيف والاستقدام، من خلال حلول رقمية منظورة تسهل استقطاب الكفاءات والعمالة بمختلف فئاتها وتخصصاتها
      </p>

      <!-- Search Bar -->
      <form class="bg-white rounded-2xl shadow-md p-2 max-w-4xl mx-auto"
            style="display:grid; grid-template-columns:2fr 1fr 1fr auto; gap:8px; align-items:center; border:1px solid #e5e7eb;">

        <!-- keywords -->
        <div class="relative">
          <input type="text" placeholder="المسمى الوظيفي أو الكلمات المفتاحية"
                 class="w-full pr-10 pl-4 py-2.5 text-sm outline-none text-right rounded-lg bg-transparent text-gray-800 placeholder-gray-400">
          <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute top-1/2 -translate-y-1/2 right-3 pointer-events-none"></i>
        </div>

        <!-- fields -->
        <div class="relative">
          <select class="w-full pr-4 pl-8 py-2.5 text-sm outline-none text-right rounded-lg appearance-none text-gray-500 bg-white border border-gray-200">
            <option selected>جميع المجالات</option>
            <option>دخول</option><option>متوسط</option><option>رفيع</option><option>تنفيذي</option>
          </select>
          <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-400 absolute top-1/2 -translate-y-1/2 left-3 pointer-events-none"></i>
        </div>

        <!-- cities -->
        <div class="relative">
          <select class="w-full pr-4 pl-8 py-2.5 text-sm outline-none text-right rounded-lg appearance-none text-gray-500 bg-white border border-gray-200">
            <option selected>جميع المدن</option>
            <option>الرياض</option><option>جدة</option><option>الدمام</option><option>عن بُعد</option>
          </select>
          <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-400 absolute top-1/2 -translate-y-1/2 left-3 pointer-events-none"></i>
        </div>

        <!-- search button -->
        <button type="submit"
                class="flex items-center justify-center px-8 py-2.5 font-bold rounded-lg transition-all text-sm text-white hover:shadow-md"
                style="background:linear-gradient(135deg,#1d4ed8,#1e40af);">بحث</button>
      </form>
    </div>
  </section>

  <!-- ===== SERVICES ===== -->
  <section class="bg-white py-14" style="padding-top: 1rem;padding-bottom: 1rem;">
    <div class="max-w-7xl mx-auto px-6">

      <div class="text-center mb-10" style="margin-bottom: 1rem">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 flex items-center justify-center gap-4" style="font-size: 1.2rem;">
          <span class="inline-block w-8 h-0.5 bg-blue-600 rounded-full"></span>
          خدمات التوظيف والاستقدام
          <span class="inline-block w-8 h-0.5 bg-blue-600 rounded-full"></span>
        </h2>
        <p class="text-gray-500 text-base">كل ما تحتاجه في مكان واحد</p>
      </div>

      <!-- 7-card row -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-7 gap-4">

        <!-- card template macro replaced inline below -->
        <!-- 1 الوظائف القيادية -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-amber-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#fff0cc,#fffaeb);">
            <i data-lucide="crown" class="w-7 h-7" style="color:#eab308;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">الوظائف القيادية</h3>
          <p class="text-xs text-gray-500 leading-relaxed">فرص وظائف قيادية في مختلف المجالات</p>
          <a href="#" class="text-amber-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

        <!-- 2 التوظيف -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-purple-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#e5d9f4,#f3e8ff);">
            <i data-lucide="briefcase-business" class="w-7 h-7" style="color:#a855f7;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">التوظيف</h3>
          <p class="text-xs text-gray-500 leading-relaxed">ابحث عن وظائف مناسبة لمهاراتك وخبرتك</p>
          <a href="#" class="text-purple-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

        <!-- 3 شركات ومكاتب الاستقدام -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-indigo-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#dcd7f7,#e8e0ff);">
            <i data-lucide="building-2" class="w-7 h-7" style="color:#4f46e5;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">شركات ومكاتب الاستقدام</h3>
          <p class="text-xs text-gray-500 leading-relaxed">استعرض شركات ومكاتب الاستقدام المعتمدة</p>
          <a href="#" class="text-indigo-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

        <!-- 4 شركات التوظيف -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-cyan-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#cef3ff,#e8f8ff);">
            <i data-lucide="users" class="w-7 h-7" style="color:#0891b2;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">شركات التوظيف</h3>
          <p class="text-xs text-gray-500 leading-relaxed">تواصل مع شركات التوظيف المعتمدة</p>
          <a href="#" class="text-cyan-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

        <!-- 5 شركات تأجير العمالة -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-green-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#d1f3e8,#e8faf5);">
            <i data-lucide="refresh-cw" class="w-7 h-7" style="color:#10b981;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">شركات تأجير العمالة</h3>
          <p class="text-xs text-gray-500 leading-relaxed">خدمات تأجير العمالة للمشاريع والمنشآت</p>
          <a href="#" class="text-green-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

        <!-- 6 التنازل عن العمالة -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-orange-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#ffe8cc,#fff4e0);">
            <i data-lucide="file-text" class="w-7 h-7" style="color:#f97316;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">التنازل عن العمالة من الشركات والأفراد</h3>
          <p class="text-xs text-gray-500 leading-relaxed">التنازل عن العمالة من الشركات والأفراد</p>
          <a href="#" class="text-orange-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

        <!-- 7 العمالة المنزلية -->
        <div class="group bg-white rounded-2xl p-5 border border-gray-200 hover:border-purple-300 hover:shadow-lg transition-all cursor-pointer flex flex-col text-right" style="min-height:230px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background:linear-gradient(135deg,#e8d4f8,#f5e8ff);">
            <i data-lucide="home" class="w-7 h-7" style="color:#7c3aed;"></i>
          </div>
          <h3 class="text-sm font-bold text-gray-900 mb-2 leading-snug">عرض وطلب العمالة المنزلية</h3>
          <p class="text-xs text-gray-500 leading-relaxed">عرض وطلب العمالة المنزلية</p>
          <a href="#" class="text-purple-600 text-xs font-semibold mt-auto pt-4 flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== FLEXIBLE WORK ===== -->
  <section class="bg-white py-14" style="padding-top: 1rem;">
    <div class="max-w-7xl mx-auto px-6">

      <div class="text-center mb-10" style="margin-bottom: 1rem;">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 flex items-center justify-center gap-4" style="font-size: 1.2rem;">
          <span class="inline-block w-8 h-0.5 bg-blue-600 rounded-full"></span>
          العمل المرن المؤقت
          <span class="inline-block w-8 h-0.5 bg-blue-600 rounded-full"></span>
        </h2>
        <p class="text-gray-500 text-base">اختر نوع العمل الذي يناسب احتياجاتك</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

        <!-- 1 العمل الموسمي -->
        <a href="#" class="group rounded-2xl p-7 transition-all duration-300 hover:shadow-xl border flex items-center gap-5"
           style="background:#fff7ed; border-color:#fed7aa;">
          <div class="flex-1 text-right">
            <h3 class="text-lg font-bold text-gray-900 mb-2">العمل الموسمي</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4">فرص عمل موسمية في أوقات الذروة والمواسم المختلفة</p>
            <span class="text-orange-600 text-sm font-semibold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></span>
          </div>
          <div class="shrink-0">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12" style="color:#f97316;">
              <path d="M13 8c0-2.76-2.46-5-5.5-5S2 5.24 2 8h2l1-1 1 1h4"/>
              <path d="M13 7.14A5.82 5.82 0 0 1 16.5 6c3.04 0 5.5 2.24 5.5 5h-3l-1-1-1 1h-3"/>
              <path d="M5.89 9.71c-2.15 2.15-2.3 5.47-.35 7.43l4.24-4.25.7-.7.71-.71 2.12-2.12c-1.95-1.96-5.27-1.8-7.42.35"/>
              <path d="M11 15.5c.5 2.5-.17 4.5-1 6.5h4c2-5.5-.5-12-1-14"/>
            </svg>
          </div>
        </a>

        <!-- 2 العمل عن بعد -->
        <a href="#" class="group rounded-2xl p-7 transition-all duration-300 hover:shadow-xl border hover:border-blue-300 flex items-center gap-5"
           style="background:#f8fbff; border-color:#dbeafe;">
          <div class="flex-1 text-right">
            <h3 class="text-lg font-bold text-gray-900 mb-2">العمل عن بعد</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4">اعمل من أي مكان وفي أي وقت مع أفضل الشركات</p>
            <span class="text-blue-600 text-sm font-semibold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></span>
          </div>
          <div class="shrink-0">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12" style="color:#2563eb;">
              <path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"/>
            </svg>
          </div>
        </a>

        <!-- 3 الدوام الجزئي -->
        <a href="#" class="group rounded-2xl p-7 transition-all duration-300 hover:shadow-xl border hover:border-green-300 flex items-center gap-5"
           style="background:#f6fdfa; border-color:#d1fae5;">
          <div class="flex-1 text-right">
            <h3 class="text-lg font-bold text-gray-900 mb-2">الدوام الجزئي</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4">وظائف بدوام جزئي تناسب وقتك وتوفر مرونة أكبر</p>
            <span class="text-green-600 text-sm font-semibold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">عرض الكل <i data-lucide="arrow-left" class="w-4 h-4"></i></span>
          </div>
          <div class="shrink-0">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12" style="color:#10b981;">
              <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/>
              <path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/>
              <circle cx="16" cy="16" r="6"/><path d="M16 14v2l1.5 1"/>
            </svg>
          </div>
        </a>

      </div>
    </div>
  </section>

  <script>lucide.createIcons();</script>
</body>
</html>
