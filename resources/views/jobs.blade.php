<!doctype html>
<html lang="ar" dir="rtl" class="h-full scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>وظّفني - منصة التوظيف الذكية | وظائف في السعودية والخليج</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
  <meta name="description" content="منصة التوظيف الأولى في المنطقة. ابحث عن آلاف الوظائف المتاحة في السعودية والخليج. نربط الكفاءات بالفرص المناسبة بتقنيات ذكية.">
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'IBM Plex Sans Arabic', sans-serif; }
    html, body { height: 100%; margin: 0; }

    /* ===== ANIMATIONS ===== */
    @keyframes floatUp {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-12px); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes pulseGlow {
      0%, 100% { box-shadow: 0 0 20px rgba(179, 102, 217, 0.3); }
      50% { box-shadow: 0 0 40px rgba(179, 102, 217, 0.6); }
    }
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
    }

    .float-animation { animation: floatUp 6s ease-in-out infinite; }
    .fade-in-up { animation: fadeInUp 0.7s ease forwards; }
    .fade-in-up-d1 { animation: fadeInUp 0.7s ease 0.1s forwards; opacity: 0; }
    .fade-in-up-d2 { animation: fadeInUp 0.7s ease 0.2s forwards; opacity: 0; }
    .fade-in-up-d3 { animation: fadeInUp 0.7s ease 0.3s forwards; opacity: 0; }

    /* ===== GLASS MORPHISM ===== */
    .glass-card {
      background: rgba(255,255,255,0.07);
      backdrop-filter: blur(16px);
      border: 1px solid rgba(255,255,255,0.12);
    }

    .hero-grid {
      background-image:
        linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }

    /* ===== SERVICE CARDS ===== */
    .service-card {
      transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
    }
    
    .service-card:hover {
      transform: translateY(-20px) scale(1.02);
      box-shadow: 0 40px 80px rgba(99, 102, 241, 0.3), inset 0 1px 0 rgba(255,255,255,0.8);
    }

    /* ===== JOB CARDS ===== */
    .job-card {
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      border: 1px solid #e5e7eb;
      background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
      position: relative;
      overflow: hidden;
    }

    .job-card::before {
      content: '';
      position: absolute;
      top: 0;
      right: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(125, 0, 133, 0.08), transparent);
      transition: right 0.6s ease;
    }

    .job-card:hover {
      border-color: #b366d9;
      box-shadow: 0 20px 50px rgba(125, 0, 133, 0.15);
      transform: translateY(-8px) scale(1.01);
    }

    .job-card:hover::before { right: 100%; }

    /* ===== FILTERS ===== */
    .filter-badge {
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .filter-badge:hover {
      background-color: #b366d9;
      color: white;
      transform: scale(1.05);
    }

    .filter-badge.active {
      background-color: #b366d9;
      color: white;
    }

    /* ===== GRADIENT TEXT ===== */
    .gradient-text {
      background: linear-gradient(135deg, #b366d9, #d699e6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* ===== STATS ===== */
    .stat-card {
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
      border: 1px solid rgba(255,255,255,0.15);
    }
    .stat-card:hover {
      transform: scale(1.08) translateY(-8px);
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    }

    /* ===== NAV ===== */
    .nav-link {
      position: relative;
      font-weight: 500;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -6px;
      right: 0;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, #b366d9, #d699e6);
      transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .nav-link:hover::after { width: 100%; }

    /* ===== NEW FEATURES ===== */
    .badge-new {
      animation: pulseGlow 2s ease-in-out infinite;
    }

    .tag-input {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      padding: 12px;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      background: white;
    }

    .tag {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      background: #f3e8ff;
      color: #7c3aed;
      border-radius: 20px;
      font-size: 13px;
    }

    .tag button {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 18px;
      padding: 0;
    }

    .loading-skeleton {
      background: linear-gradient(90deg, #f0f0f0 25%, #f8f8f8 50%, #f0f0f0 75%);
      background-size: 200% 100%;
      animation: shimmer 2s infinite;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .job-card { padding: 1rem; }
      .service-card { padding: 1rem; }
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              50:'#f0e6ff', 100:'#e0ccff', 500:'#b366d9',
              600:'#9d4db8', 700:'#8633a0', 800:'#6b2685',
              900:'#52206a'
            },
            surface: {
              50:'#f8fafc', 100:'#f1f5f9', 200:'#e2e8f0',
              800:'#1e293b', 900:'#0f172a'
            }
          }
        }
      }
    }
  </script>
</head>
<body class="h-full bg-white text-surface-800 overflow-x-hidden">

<!-- ===== NAVBAR ===== -->
<nav class="bg-white/80 backdrop-blur-xl border-b border-surface-200 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center">
          <i data-lucide="briefcase" class="w-5 h-5 text-white"></i>
        </div>
        <span class="text-xl font-bold gradient-text">وظّفني</span>
      </div>

      <div class="hidden md:flex items-center gap-8">
        <a href="#jobs" class="nav-link text-sm font-medium text-surface-800 hover:text-brand-600">الوظائف</a>
        <a href="#companies" class="nav-link text-sm font-medium text-surface-800 hover:text-brand-600">الشركات</a>
        <a href="#insights" class="nav-link text-sm font-medium text-surface-800 hover:text-brand-600">الإحصائيات</a>
        <a href="#reviews" class="nav-link text-sm font-medium text-surface-800 hover:text-brand-600">التقييمات</a>
        <a href="#blog" class="nav-link text-sm font-medium text-surface-800 hover:text-brand-600">المدونة</a>
      </div>

      <div class="hidden md:flex items-center gap-3">
        <button class="px-5 py-2 text-sm font-semibold text-brand-600 border-2 border-brand-500 rounded-full hover:bg-brand-500 hover:text-white transition-all">تسجيل دخول</button>
        <button class="px-5 py-2 text-sm font-semibold text-white bg-brand-600 rounded-full hover:bg-brand-700 transition-all shadow-lg">إنشاء حساب</button>
      </div>

      <button id="mobile-menu-btn" class="md:hidden p-2">
        <i data-lucide="menu" class="w-6 h-6"></i>
      </button>
    </div>
  </div>
</nav>

<!-- ===== HERO SECTION ===== -->
<section class="relative overflow-hidden hero-grid" style="min-height: 600px; background: linear-gradient(135deg, #2d1b4e 0%, #1a0f2e 50%, #0f1329 100%);">
  <div class="relative z-10 max-w-5xl mx-auto px-6 py-24 text-center">
    <div class="fade-in-up inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-card text-cyan-300 text-xs font-bold mb-6 badge-new">
      <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
      <span>🔥 الآن مع تقنيات AI للمطابقة الذكية</span>
    </div>

    <h1 class="fade-in-up-d1 text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
      ابحث عن <span class="gradient-text">وظيفتك المثالية</span>
    </h1>

    <p class="fade-in-up-d2 text-xl text-slate-300 max-w-3xl mx-auto mb-12 leading-relaxed">
      منصة التوظيف الأذكى في المنطقة - نربط الكفاءات  بالفرص المناسبة بتقنيات متقدمة. ابحث من بين آلاف الوظائف والشركات الموثوقة
    </p>

    <!-- ===== ADVANCED SEARCH ===== -->
    <div class="fade-in-up-d3 max-w-4xl mx-auto">
      <div class="bg-white rounded-3xl shadow-2xl p-2 md:p-3 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-3">
          <!-- Job Search -->
          <div class="relative">
            <input type="text" id="search-job" placeholder="المسمى الوظيفي..." 
                   class="w-full px-4 py-3 text-sm outline-none bg-transparent text-right rounded-2xl">
          </div>

          <!-- Location Filter -->
          <div class="relative">
            <select id="search-location" class="w-full px-4 py-3 text-sm outline-none bg-transparent text-right rounded-2xl appearance-none">
              <option selected disabled>المدينة</option>
              <option value="riyadh">الرياض</option>
              <option value="jeddah">جدة</option>
              <option value="dammam">الدمام</option>
              <option value="abha">أبها</option>
              <option value="remote">عن بُعد</option>
            </select>
          </div>

          <!-- Experience Level -->
          <div class="relative">
            <select id="search-level" class="w-full px-4 py-3 text-sm outline-none bg-transparent text-right rounded-2xl appearance-none">
              <option selected disabled>مستوى الخبرة</option>
              <option value="entry">دخول</option>
              <option value="mid">متوسط</option>
              <option value="senior">رفيع</option>
              <option value="executive">تنفيذي</option>
            </select>
          </div>

          <!-- Search Button -->
          <button class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-brand-600 to-brand-700 hover:to-brand-800 text-white font-bold rounded-2xl transition-all text-sm whitespace-nowrap">
            <i data-lucide="search" class="w-4 h-4"></i>
            <span>بحث</span>
          </button>
        </div>
      </div>

      <!-- Popular Searches -->
      <div class="flex flex-wrap justify-center gap-2">
        <span class="text-xs text-slate-400 mb-2 w-full">البحث الشهير:</span>
        <button class="px-4 py-2 rounded-full text-sm glass-card text-slate-300 hover:bg-white/15 transition">🔥 مهندس برمجيات</button>
        <button class="px-4 py-2 rounded-full text-sm glass-card text-slate-300 hover:bg-white/15 transition">💰 تحليل البيانات</button>
        <button class="px-4 py-2 rounded-full text-sm glass-card text-slate-300 hover:bg-white/15 transition">🎨 تصميم UI/UX</button>
        <button class="px-4 py-2 rounded-full text-sm glass-card text-slate-300 hover:bg-white/15 transition">📊 مدير تسويق</button>
      </div>
    </div>

  </div>
</section>

<!-- ===== ADVANCED FILTERS SECTION ===== -->
<section class="py-8 bg-surface-50 border-b border-surface-200">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div>
        <h3 class="text-sm font-bold text-surface-800 mb-3">تصفية الوظائف</h3>
        <div class="flex flex-wrap gap-2">
          <button class="filter-badge px-4 py-2 bg-surface-100 text-surface-800 rounded-full text-sm font-medium hover:bg-brand-500 hover:text-white">دوام كامل</button>
          <button class="filter-badge px-4 py-2 bg-surface-100 text-surface-800 rounded-full text-sm font-medium hover:bg-brand-500 hover:text-white">عن بُعد</button>
          <button class="filter-badge px-4 py-2 bg-surface-100 text-surface-800 rounded-full text-sm font-medium hover:bg-brand-500 hover:text-white">تدريب</button>
          <button class="filter-badge px-4 py-2 bg-surface-100 text-surface-800 rounded-full text-sm font-medium hover:bg-brand-500 hover:text-white">مشاريع</button>
          <button class="filter-badge px-4 py-2 bg-surface-100 text-surface-800 rounded-full text-sm font-medium hover:bg-brand-500 hover:text-white">+ المزيد</button>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <span class="text-sm text-surface-600">الترتيب:</span>
        <select class="px-4 py-2 border border-surface-200 rounded-full text-sm bg-white outline-none">
          <option>الأحدث</option>
          <option>الراتب (الأعلى)</option>
          <option>الراتب (الأقل)</option>
          <option>الأكثر ملاءمة</option>
        </select>
      </div>
    </div>
  </div>
</section>
<section id="services" class="py-20 bg-surface-50" style="padding-top: 3rem;">
    <div class="max-w-7xl mx-auto px-6">
     <div class="text-center mb-14"><span class="text-brand-600 font-semibold text-sm tracking-wide">خدماتنا</span>
      <h2 id="services-title" class="text-3xl md:text-4xl font-bold text-surface-900 mt-2 mb-4">حلول توظيف متكاملة</h2>
      <p class="text-surface-800/60 max-w-xl mx-auto">نقدم مجموعة شاملة من الخدمات لتلبية احتياجات التوظيف لجميع المستويات</p>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
      <div class="service-card rounded-xl p-5 border-2 cursor-pointer group" style="background: linear-gradient(135deg, #f3e8ff 0%, #fae8ff 100%); border-color: #e9d5ff;">
       <div class="service-icon-wrapper" style="display: flex; align-items: center; justify-content: center;background: linear-gradient(135deg, #b366d9 0%, #9d4db8 100%); width: 70px; height: 70px; margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="crown" class="lucide lucide-crown w-7 h-7 text-white"><path d="m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"></path></svg>
       </div>
       <h3 class="text-base font-bold text-surface-900 mb-1"> الوظائف القياديه </h3>
       <p class="text-xs text-surface-800/60 leading-relaxed">استقطاب القيادات التنفيذية العليا وأصحاب الخبرات المتميزة</p>
       <div class="flex items-center gap-2 mt-5 text-purple-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition"><span>اكتشف المزيد</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
       </div>
      </div>
      <div class="service-card rounded-xl p-5 border-2 cursor-pointer group" style="background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); border-color: #f9a8d4;">
       <div class="service-icon-wrapper" style="display: flex; align-items: center; justify-content: center;background: linear-gradient(135deg, #d946a6 0%, #b91c8c 100%); width: 70px; height: 70px; margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="briefcase" class="lucide lucide-briefcase w-7 h-7 text-white"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
       </div>
       <h3 class="text-base font-bold text-surface-900 mb-1"> الوظائف المهنيه</h3>
       <p class="text-xs text-surface-800/60 leading-relaxed">توفير الكفاءات المهنية المتخصصة في مختلف القطاعات</p>
       <div class="flex items-center gap-2 mt-5 text-pink-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition"><span>اكتشف المزيد</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
       </div>
      </div>
      <div class="service-card rounded-xl p-5 border-2 cursor-pointer group" style="background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%); border-color: #c7d2fe;">
       <div class="service-icon-wrapper" style="display: flex; align-items: center; justify-content: center;background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); width: 70px; height: 70px; margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="building-2" class="lucide lucide-building-2 w-7 h-7 text-white"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
       </div>
       <h3 class="text-base font-bold text-surface-900 mb-1"> الوظائف الاداريه</h3>
       <p class="text-xs text-surface-800/60 leading-relaxed">حلول متكاملة لتوظيف الكوادر الإدارية والمكتبية</p>
       <div class="flex items-center gap-2 mt-5 text-indigo-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition"><span>اكتشف المزيد</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
       </div>
      </div>
      <div class="service-card rounded-xl p-5 border-2 cursor-pointer group" style="background: linear-gradient(135deg, #f0fdfa 0%, #e0f2fe 100%); border-color: #a5f3fc;">
       <div class="service-icon-wrapper" style="display: flex; align-items: center; justify-content: center;background: linear-gradient(135deg, #0891b2 0%, #0369a1 100%); width: 70px; height: 70px; margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="hard-hat" class="lucide lucide-hard-hat w-7 h-7 text-white"><path d="M2 18a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2z"></path><path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"></path><path d="M4 15v-3a6 6 0 0 1 6-6h0"></path><path d="M14 6h0a6 6 0 0 1 6 6v3"></path></svg>
       </div>
       <h3 class="text-base font-bold text-surface-900 mb-1"> شركات ترغب التنازل عن العماله</h3>
       <p class="text-xs text-surface-800/60 leading-relaxed">توفير القوى العاملة المدربة للمشاريع الكبرى والمنشآت</p>
       <div class="flex items-center gap-2 mt-5 text-cyan-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition"><span>اكتشف المزيد</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
       </div>
      </div>
      <div class="service-card rounded-xl p-5 border-2 cursor-pointer group" style="background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); border-color: #e9d5ff;">
       <div class="service-icon-wrapper" style="display: flex; align-items: center; justify-content: center;background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); width: 70px; height: 70px; margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="zap" class="lucide lucide-zap w-7 h-7 text-white"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
       </div>
       <h3 class="text-base font-bold text-surface-900 mb-1"> شركات التوظيف</h3>
       <p class="text-xs text-surface-800/60 leading-relaxed">تقنيات ذكاء اصطناعي لمطابقة المرشحين مع الوظائف المناسبة</p>
       <div class="flex items-center gap-2 mt-5 text-purple-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition"><span>اكتشف المزيد</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
       </div>
      </div>
      <div class="service-card rounded-xl p-5 border-2 cursor-pointer group" style="background: linear-gradient(135deg, #fce7f3 0%, #f3e8ff 100%); border-color: #f472b6;">
       <div class="service-icon-wrapper" style="display: flex; align-items: center; justify-content: center;background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); width: 70px; height: 70px; margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="file-check-2" class="lucide lucide-file-check-2 w-7 h-7 text-white"><path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4"></path><polyline points="14 2 14 8 20 8"></polyline><path d="m3 15 2 2 4-4"></path></svg>
       </div>
       <h3 class="text-base font-bold text-surface-900 mb-1"> شركات تاجير العماله</h3>
       <p class="text-xs text-surface-800/60 leading-relaxed">إدارة شاملة لعقود التوظيف والتعاقد مع ضمان الامتثال</p>
       <div class="flex items-center gap-2 mt-5 text-rose-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition"><span>اكتشف المزيد</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-left" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
       </div>
      </div>
     </div>
    </div>
   </section>
<!-- ===== FEATURED JOBS WITH RATINGS ===== -->
<section id="jobs" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-14">
      <div>
        <span class="text-brand-600 font-bold text-sm tracking-wide">أحدث الفرص</span>
        <h2 class="text-4xl md:text-5xl font-bold text-surface-900 mt-3">وظائف مميزة اليوم</h2>
      </div>
      <a href="#" class="mt-6 md:mt-0 text-brand-600 font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">
        عرض جميع الوظائف (4,250+)
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Job Card 1 -->
      <div class="job-card rounded-2xl p-6 cursor-pointer group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-start gap-4 flex-1">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
              S
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-bold text-surface-900 text-lg">مهندس برمجيات أول</h3>
                <span class="px-2 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded">جديد</span>
              </div>
              <p class="text-sm text-surface-800/60">شركة سابك للتقنية</p>
              <div class="flex items-center gap-2 mt-2">
                <div class="flex text-amber-400">
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                </div>
                <span class="text-xs text-surface-600">(4.8) 245 تقييم</span>
              </div>
            </div>
          </div>
          <button class="p-2 rounded-lg hover:bg-surface-100 transition flex-shrink-0">
            <i data-lucide="bookmark" class="w-5 h-5 text-surface-800/30"></i>
          </button>
        </div>

        <p class="text-sm text-surface-700 mb-4 line-clamp-2">تطوير وصيانة التطبيقات الضخمة. خبرة في المشاريع الكبرى والعمل مع فريق متعدد.</p>

        <div class="flex flex-wrap gap-2 mb-4">
          <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-medium rounded-full">دوام كامل</span>
          <span class="px-3 py-1 bg-surface-100 text-surface-800/60 text-xs font-medium rounded-full">الرياض</span>
          <span class="px-3 py-1 bg-surface-100 text-surface-800/60 text-xs font-medium rounded-full">عن بُعد</span>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-surface-200">
          <span class="text-brand-600 font-bold text-lg">18,000 - 25,000 ر.س</span>
          <span class="text-xs text-surface-800/40">منذ ساعتين</span>
        </div>
      </div>

      <!-- Job Card 2 -->
      <div class="job-card rounded-2xl p-6 cursor-pointer group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-start gap-4 flex-1">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-400 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
              ن
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-bold text-surface-900 text-lg">مدير تسويق رقمي</h3>
                <span class="px-2 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded">جديد</span>
              </div>
              <p class="text-sm text-surface-800/60">نيوم (Neom)</p>
              <div class="flex items-center gap-2 mt-2">
                <div class="flex text-amber-400">
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3"></i>
                </div>
                <span class="text-xs text-surface-600">(4.5) 189 تقييم</span>
              </div>
            </div>
          </div>
          <button class="p-2 rounded-lg hover:bg-surface-100 transition flex-shrink-0">
            <i data-lucide="bookmark" class="w-5 h-5 text-surface-800/30"></i>
          </button>
        </div>

        <p class="text-sm text-surface-700 mb-4 line-clamp-2">قيادة استراتيجية التسويق الرقمي وإدارة فريق متخصص في المحتوى والإعلانات.</p>

        <div class="flex flex-wrap gap-2 mb-4">
          <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-medium rounded-full">دوام كامل</span>
          <span class="px-3 py-1 bg-surface-100 text-surface-800/60 text-xs font-medium rounded-full">تبوك</span>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-surface-200">
          <span class="text-brand-600 font-bold text-lg">22,000 - 30,000 ر.س</span>
          <span class="text-xs text-surface-800/40">منذ 3 أيام</span>
        </div>
      </div>

      <!-- Job Card 3 -->
      <div class="job-card rounded-2xl p-6 cursor-pointer group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-start gap-4 flex-1">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-400 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
              أ
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-bold text-surface-900 text-lg">محلل بيانات (Data Analyst)</h3>
                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded">مستعجل</span>
              </div>
              <p class="text-sm text-surface-800/60">أرامكو الرقمية</p>
              <div class="flex items-center gap-2 mt-2">
                <div class="flex text-amber-400">
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                </div>
                <span class="text-xs text-surface-600">(4.9) 312 تقييم</span>
              </div>
            </div>
          </div>
          <button class="p-2 rounded-lg hover:bg-surface-100 transition flex-shrink-0">
            <i data-lucide="bookmark" class="w-5 h-5 text-surface-800/30"></i>
          </button>
        </div>

        <p class="text-sm text-surface-700 mb-4 line-clamp-2">تحليل البيانات الضخمة واستخراج الرؤى لدعم القرارات الإستراتيجية.</p>

        <div class="flex flex-wrap gap-2 mb-4">
          <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-medium rounded-full">دوام كامل</span>
          <span class="px-3 py-1 bg-surface-100 text-surface-800/60 text-xs font-medium rounded-full">الظهران</span>
          <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-medium rounded-full">عن بُعد متاح</span>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-surface-200">
          <span class="text-brand-600 font-bold text-lg">15,000 - 22,000 ر.س</span>
          <span class="text-xs text-surface-800/40">منذ يوم</span>
        </div>
      </div>

      <!-- Job Card 4 -->
      <div class="job-card rounded-2xl p-6 cursor-pointer group">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-start gap-4 flex-1">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-400 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
              ر
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-2 mb-1">
                <h3 class="font-bold text-surface-900 text-lg">مصمم واجهات UX/UI</h3>
              </div>
              <p class="text-sm text-surface-800/60">رؤية للتقنية</p>
              <div class="flex items-center gap-2 mt-2">
                <div class="flex text-amber-400">
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                  <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                </div>
                <span class="text-xs text-surface-600">(5.0) 156 تقييم</span>
              </div>
            </div>
          </div>
          <button class="p-2 rounded-lg hover:bg-surface-100 transition flex-shrink-0">
            <i data-lucide="bookmark" class="w-5 h-5 text-surface-800/30"></i>
          </button>
        </div>

        <p class="text-sm text-surface-700 mb-4 line-clamp-2">تصميم واجهات احترافية وتجارب مستخدم متقدمة للتطبيقات والمواقع.</p>

        <div class="flex flex-wrap gap-2 mb-4">
          <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-medium rounded-full">عن بُعد</span>
          <span class="px-3 py-1 bg-surface-100 text-surface-800/60 text-xs font-medium rounded-full">مرن</span>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-surface-200">
          <span class="text-brand-600 font-bold text-lg">12,000 - 18,000 ر.س</span>
          <span class="text-xs text-surface-800/40">منذ 5 أيام</span>
        </div>
      </div>
    </div>

    <!-- Load More -->
    <div class="text-center mt-12">
      <button class="px-8 py-4 border-2 border-brand-600 text-brand-600 font-bold rounded-full hover:bg-brand-600 hover:text-white transition-all">
        تحميل المزيد من الوظائف
      </button>
    </div>
  </div>
</section>

<!-- ===== COMPANY RATINGS & REVIEWS ===== -->
<section id="reviews" class="py-20 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-14">
      <span class="text-brand-600 font-bold text-sm tracking-wide">تقييمات الشركات</span>
      <h2 class="text-4xl font-bold text-surface-900 mt-3">رؤى من الموظفين الحاليين والسابقين</h2>
      <p class="text-surface-800/60 mt-4 max-w-2xl mx-auto">اقرأ تقييمات حقيقية من موظفين فعليين عن الشركات الرائدة</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Review Card 1 -->
      <div class="bg-white rounded-2xl p-6 border border-surface-200 hover:border-brand-300 hover:shadow-lg transition-all">
        <div class="flex items-start justify-between mb-4">
          <div>
            <h3 class="font-bold text-surface-900 mb-1">شركة سابك للتقنية</h3>
            <div class="flex items-center gap-2">
              <div class="flex text-amber-400">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
              </div>
              <span class="text-sm font-bold text-surface-900">4.8/5.0</span>
            </div>
          </div>
          <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full">الأفضل</span>
        </div>

        <p class="text-sm text-surface-700 mb-4">"بيئة عمل رائعة وفرص نمو حقيقية. الإدارة تهتم بتطوير الموظفين وتوفر جميع الموارد اللازمة."</p>

        <div class="flex items-center justify-between pt-4 border-t border-surface-200">
          <span class="text-xs text-surface-600">محمد علي | مهندس برمجيات</span>
          <span class="text-xs text-surface-500">منذ شهر</span>
        </div>
      </div>

      <!-- Review Card 2 -->
      <div class="bg-white rounded-2xl p-6 border border-surface-200 hover:border-brand-300 hover:shadow-lg transition-all">
        <div class="flex items-start justify-between mb-4">
          <div>
            <h3 class="font-bold text-surface-900 mb-1">نيوم (NEOM)</h3>
            <div class="flex items-center gap-2">
              <div class="flex text-amber-400">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4"></i>
              </div>
              <span class="text-sm font-bold text-surface-900">4.5/5.0</span>
            </div>
          </div>
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full">موصى به</span>
        </div>

        <p class="text-sm text-surface-700 mb-4">"مشاريع ضخمة وعالمية. الراتب جيد لكن الضغط عالي جداً. سعر المعيشة مرتفع ."</p>

        <div class="flex items-center justify-between pt-4 border-t border-surface-200">
          <span class="text-xs text-surface-600">فاطمة محمود | مدير مشاريع</span>
          <span class="text-xs text-surface-500">منذ أسبوعين</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== STATS SECTION ===== -->
<section id="insights" class="py-20 bg-surface-900 relative overflow-hidden">
  <div class="relative z-10 max-w-7xl mx-auto px-6">
    <div class="text-center mb-14">
      <span class="text-brand-500 font-bold text-sm">إنجازاتنا وإحصائياتنا</span>
      <h2 class="text-4xl md:text-5xl font-bold text-white mt-3">أرقام تتحدث عن نجاحنا</h2>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="stat-card glass-card rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-xl bg-brand-500/20 flex items-center justify-center mx-auto mb-4">
          <i data-lucide="briefcase" class="w-6 h-6 text-brand-500"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1 counter" data-target="145200">0</div>
        <div class="text-sm text-slate-400">وظيفة نشطة</div>
      </div>

      <div class="stat-card glass-card rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center mx-auto mb-4">
          <i data-lucide="user-check" class="w-6 h-6 text-emerald-400"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1 counter" data-target="127450">0</div>
        <div class="text-sm text-slate-400">موظف تم توظيفه</div>
      </div>

      <div class="stat-card glass-card rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center mx-auto mb-4">
          <i data-lucide="building-2" class="w-6 h-6 text-amber-400"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1 counter" data-target="4250">0</div>
        <div class="text-sm text-slate-400">شركة شريكة</div>
      </div>

      <div class="stat-card glass-card rounded-2xl p-6 text-center">
        <div class="w-12 h-12 rounded-xl bg-pink-500/20 flex items-center justify-center mx-auto mb-4">
          <i data-lucide="star" class="w-6 h-6 text-pink-400"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1">97%</div>
        <div class="text-sm text-slate-400">رضا المستخدمين</div>
      </div>
    </div>
  </div>
</section>

<!-- ===== SALARY INSIGHTS ===== -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-14">
      <span class="text-brand-600 font-bold text-sm">رؤى الرواتب</span>
      <h2 class="text-4xl font-bold text-surface-900 mt-3">متوسط الرواتب حسب التخصص</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-surface-50 rounded-2xl p-6 border border-surface-200">
        <h3 class="font-bold text-surface-900 mb-4">🔧 هندسة البرمجيات</h3>
        <div class="space-y-3">
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">دخول</span>
              <span class="font-bold text-surface-900">8,000-12,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-brand-600 h-2 rounded-full" style="width: 30%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">متوسط</span>
              <span class="font-bold text-surface-900">15,000-20,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-brand-600 h-2 rounded-full" style="width: 50%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">رفيع</span>
              <span class="font-bold text-surface-900">25,000-35,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-brand-600 h-2 rounded-full" style="width: 75%"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-surface-50 rounded-2xl p-6 border border-surface-200">
        <h3 class="font-bold text-surface-900 mb-4">📊 التسويق الرقمي</h3>
        <div class="space-y-3">
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">دخول</span>
              <span class="font-bold text-surface-900">6,000-9,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-emerald-600 h-2 rounded-full" style="width: 28%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">متوسط</span>
              <span class="font-bold text-surface-900">12,000-16,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-emerald-600 h-2 rounded-full" style="width: 45%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">رفيع</span>
              <span class="font-bold text-surface-900">20,000-28,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-emerald-600 h-2 rounded-full" style="width: 65%"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-surface-50 rounded-2xl p-6 border border-surface-200">
        <h3 class="font-bold text-surface-900 mb-4">🎨 تصميم وواجهات</h3>
        <div class="space-y-3">
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">دخول</span>
              <span class="font-bold text-surface-900">5,500-8,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-amber-600 h-2 rounded-full" style="width: 25%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">متوسط</span>
              <span class="font-bold text-surface-900">11,000-15,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-amber-600 h-2 rounded-full" style="width: 42%"></div>
            </div>
          </div>
          <div>
            <div class="flex justify-between mb-1">
              <span class="text-sm text-surface-600">رفيع</span>
              <span class="font-bold text-surface-900">18,000-25,000</span>
            </div>
            <div class="w-full bg-surface-200 rounded-full h-2">
              <div class="bg-amber-600 h-2 rounded-full" style="width: 60%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="py-20 bg-gradient-to-r from-brand-600 via-brand-700 to-brand-800 relative overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, white, transparent 50%), radial-gradient(circle at 80% 20%, white, transparent 40%);"></div>
  </div>

  <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">هل أنت مستعد لخطوتك المهنية القادمة؟</h2>
    <p class="text-xl text-white/85 mb-10 leading-relaxed">انضم إلى آلاف المهنيين الذين وجدوا وظائفهم المثالية عبر منصتنا. ابدأ البحث الآن وطور مسارك الوظيفي</p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <button class="px-8 py-4 bg-white text-brand-700 font-bold rounded-full hover:bg-surface-100 transition-all shadow-xl text-base">
        ابدأ البحث الآن
      </button>
      <button class="px-8 py-4 border-2 border-white/40 text-white font-bold rounded-full hover:bg-white/10 transition-all text-base backdrop-blur-sm">
        سجّل ملفك الآن
      </button>
    </div>

    <p class="text-white/70 text-sm mt-8">✓ مجاني تماماً • ✓ بدون التزامات • ✓ خصوصيتك محمية</p>
  </div>
</section>

<!-- ===== BLOG SECTION ===== -->
<section id="blog" class="py-20 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-14">
      <span class="text-brand-600 font-bold text-sm">نصائح مهنية</span>
      <h2 class="text-4xl font-bold text-surface-900 mt-3">دليلك الكامل للنجاح الوظيفي</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <article class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition-all cursor-pointer group">
        <div class="h-48 bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white text-5xl">
          <i data-lucide="file-text"></i>
        </div>
        <div class="p-6">
          <span class="text-xs font-bold text-brand-600">نصائح التوظيف</span>
          <h3 class="font-bold text-surface-900 mt-2 mb-3">كيفية إنشاء سيرة ذاتية احترافية تلفت الانتباه</h3>
          <p class="text-sm text-surface-700 mb-4">تعلم أسرار كتابة سيرة ذاتية فعالة تزيد فرصك في الحصول على مقابلة</p>
          <a href="#" class="text-brand-600 font-bold text-sm flex items-center gap-2 group-hover:gap-3 transition-all">
            اقرأ المقال
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
          </a>
        </div>
      </article>

      <article class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition-all cursor-pointer group">
        <div class="h-48 bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white text-5xl">
          <i data-lucide="briefcase"></i>
        </div>
        <div class="p-6">
          <span class="text-xs font-bold text-emerald-600">تطوير الذات</span>
          <h3 class="font-bold text-surface-900 mt-2 mb-3">المهارات الأكثر طلباً في 2026</h3>
          <p class="text-sm text-surface-700 mb-4">اكتشف أهم المهارات التقنية والناعمة للتنافس في سوق العمل</p>
          <a href="#" class="text-emerald-600 font-bold text-sm flex items-center gap-2 group-hover:gap-3 transition-all">
            اقرأ المقال
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
          </a>
        </div>
      </article>

      <article class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition-all cursor-pointer group">
        <div class="h-48 bg-gradient-to-br from-amber-500 to-orange-700 flex items-center justify-center text-white text-5xl">
          <i data-lucide="zap"></i>
        </div>
        <div class="p-6">
          <span class="text-xs font-bold text-amber-600">المقابلات</span>
          <h3 class="font-bold text-surface-900 mt-2 mb-3">10 أسئلة شائعة وكيفية الإجابة عليها</h3>
          <p class="text-sm text-surface-700 mb-4">استعد للمقابلة الشخصية مع نصائح عملية وإجابات قوية</p>
          <a href="#" class="text-amber-600 font-bold text-sm flex items-center gap-2 group-hover:gap-3 transition-all">
            اقرأ المقال
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
          </a>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="bg-surface-900 pt-20 pb-8">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
      <div>
        <div class="flex items-center gap-3 mb-5">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center">
            <i data-lucide="briefcase" class="w-5 h-5 text-white"></i>
          </div>
          <span class="text-xl font-bold text-white">وظّفني</span>
        </div>
        <p class="text-sm text-slate-400 leading-relaxed">منصة التوظيف الأولى والأفضل في المنطقة. نربط الكفاءات بالفرص المناسبة</p>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5 text-sm">للباحثين عن عمل</h4>
        <ul class="space-y-3">
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">البحث عن وظائف</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">تحميل السيرة الذاتية</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">المقالات والنصائح</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">تقييمات الشركات</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5 text-sm">للشركات</h4>
        <ul class="space-y-3">
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">نشر وظيفة</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">البحث عن المرشحين</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">حلول التوظيف</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">الأسعار والباقات</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5 text-sm">عن الموقع</h4>
        <ul class="space-y-3">
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">من نحن</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">الأخبار والمدونة</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">الشروط والأحكام</a></li>
          <li><a href="#" class="text-sm text-slate-400 hover:text-brand-500 transition">سياسة الخصوصية</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold mb-5 text-sm">تابعنا</h4>
        <div class="flex gap-3">
          <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-brand-500 flex items-center justify-center transition text-slate-400">
            <i data-lucide="linkedin" class="w-5 h-5"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-brand-500 flex items-center justify-center transition text-slate-400">
            <i data-lucide="twitter" class="w-5 h-5"></i>
          </a>
          <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-brand-500 flex items-center justify-center transition text-slate-400">
            <i data-lucide="instagram" class="w-5 h-5"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="border-t border-white/10 pt-8">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-slate-500">© 2026 وظّفني. جميع الحقوق محفوظة</p>
        <div class="flex gap-6">
          <a href="#" class="text-sm text-slate-500 hover:text-brand-500 transition">سياسة الخصوصية</a>
          <a href="#" class="text-sm text-slate-500 hover:text-brand-500 transition">الشروط والأحكام</a>
          <a href="#" class="text-sm text-slate-500 hover:text-brand-500 transition">اتصل بنا</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- ===== SCRIPTS ===== -->
<script>
  // Counter Animation
  function animateCounter() {
    const counters = document.querySelectorAll('.counter');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const target = parseInt(counter.dataset.target);
          const increment = target / 60;
          let current = 0;

          const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
              counter.textContent = target.toLocaleString('ar-SA');
              clearInterval(timer);
            } else {
              counter.textContent = Math.floor(current).toLocaleString('ar-SA');
            }
          }, 30);

          observer.unobserve(counter);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
  }

  // Smooth Scroll
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const target = document.querySelector(link.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Mobile Menu
  document.getElementById('mobile-menu-btn').addEventListener('click', () => {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });

  // Initialize
  lucide.createIcons();
  window.addEventListener('load', animateCounter);
</script>
</body>
</html>