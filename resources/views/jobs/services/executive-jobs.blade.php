@extends('jobs.layouts.app')

@section('title', $serviceTitle)

@section('content')

{{-- ═══════════ HERO ═══════════ --}}

<section class="py-12 bg-gradient-to-r from-brand-600 via-brand-700 to-brand-800 relative overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, white, transparent 50%), radial-gradient(circle at 80% 20%, white, transparent 40%);"></div>
  </div>
  
  <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-3"><span data-i18n="svc.executive.title">{{ $serviceTitle }}</span></h1>
    <p class="text-xl text-white/85 max-w-2xl mx-auto" data-i18n="svc.executive.sub">{{ $serviceDescription }}</p>
  </div>
</section>

{{-- ═══════════ TABS BAR ═══════════ --}}
<div class="bg-white border-b border-surface-200 sticky top-0 z-40 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 flex items-center gap-1 py-1">
    <button class="tab-btn group flex items-center gap-2 px-5 py-3 text-sm font-bold text-brand-600 border-b-2 border-brand-600 transition" data-tab="jobs">
      <i data-lucide="briefcase" class="w-4 h-4"></i>
      <span data-i18n="jobs_page.tab_jobs">الوظائف المتاحة</span>
      <span class="bg-brand-100 text-brand-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $jobs->total() }}</span>
    </button>
    <button class="tab-btn group flex items-center gap-2 px-5 py-3 text-sm font-bold text-surface-500 border-b-2 border-transparent hover:text-brand-600 transition" data-tab="seekers">
      <i data-lucide="users" class="w-4 h-4"></i>
      <span data-i18n="jobs_page.tab_seekers">الباحثون عن عمل</span>
      <span class="bg-surface-100 text-surface-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $jobSeekers->total() }}</span>
    </button>
  </div>
</div>

{{-- ═══════════ MAIN LAYOUT: sidebar + content ═══════════ --}}
<div class="bg-surface-50 min-h-screen">
  <div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex gap-6 items-start">

      {{-- ═══ RIGHT SIDEBAR FILTERS ═══ --}}
      <aside class=" shrink-0 sticky top-20 max-h-[calc(100vh-6rem)] overflow-y-auto" id="sidebar" style="max-width:320px;">

        {{-- ── JOBS FILTERS ── --}}
        <div id="jobs-sidebar" class="space-y-3">
          <form method="GET" id="jobs-filter-form">
            <input type="hidden" name="tab" value="jobs">

            {{-- Header --}}
            <div class="bg-white border border-surface-200 p-5">
              <div class="flex items-center justify-between mb-4">
                <h3 class="font-extrabold text-surface-900 text-base flex items-center gap-2">
                  <i data-lucide="sliders-horizontal" class="w-4 h-4 text-brand-600"></i>
                 <span data-i18n="jobs_page.advanced_search">بحث متقدم</span>
                </h3>
                <a href="{{ url()->current() }}?tab=jobs"
                  class="text-xs text-brand-600 font-semibold hover:text-brand-800 transition">
                  مسح الكل
                </a>
              </div>

              {{-- Keyword --}}
              <div class="relative">
                <i data-lucide="search" class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-surface-400 pointer-events-none"></i>
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                  placeholder="مسمى وظيفي، شركة..." data-i18n-placeholder="jobs_page.search_placeholder"
                  class="w-full pr-10 pl-3 py-2.5 border border-surface-200 rounded-xl text-sm bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition"/>
              </div>
            </div>

            {{-- نوع الدوام --}}
            <div class="bg-white border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="clock" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_type">نوع الدوام</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 space-y-2.5 border-t border-surface-100">
                @foreach(['full_time'=>'دوام كامل','part_time'=>'دوام جزئي','remote'=>'عن بُعد','hybrid'=>'هجين','contract'=>'عقد مؤقت','freelance'=>'فريلانس'] as $val => $label)
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="job_type" value="{{ $val }}"
                    {{ request('job_type') == $val ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-700 group-hover:text-brand-600 transition font-medium">{{ $label }}</span>
                </label>
                @endforeach
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="job_type" value=""
                    {{ !request('job_type') ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-400 group-hover:text-brand-600 transition" data-i18n="jobs_page.all">الكل</span>
                </label>
              </div>
            </div>

            {{-- مستوى الخبرة --}}
            <div class="bg-white border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="trending-up" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_exp">مستوى الخبرة</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 space-y-2.5 border-t border-surface-100">
                @foreach(['entry'=>'مبتدئ (0–2 سنة)','mid'=>'متوسط (2–5 سنوات)','senior'=>'خبير (5–10 سنوات)','executive'=>'تنفيذي (+10 سنوات)'] as $val => $label)
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="experience_level" value="{{ $val }}"
                    {{ request('experience_level') == $val ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-700 group-hover:text-brand-600 transition font-medium">{{ $label }}</span>
                </label>
                @endforeach
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="experience_level" value=""
                    {{ !request('experience_level') ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-400 group-hover:text-brand-600 transition" data-i18n="jobs_page.all">الكل</span>
                </label>
              </div>
            </div>

            {{-- الراتب --}}
            <div class="bg-white  border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="banknote" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_salary">الراتب الشهري</span> <span style="font-size:11px;opacity:.6;">(ر.س)</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-5 border-t border-surface-100">
                <div class="mt-3 mb-2 flex items-center justify-between">
                  <span class="text-xs text-surface-500" data-i18n="jobs_page.from">من</span>
                  <span class="text-xs font-bold text-brand-600" id="job-salary-label">
                    {{ request('salary_min') ? number_format(request('salary_min'),0,'',',') : '0' }}
                    —
                    {{ request('salary_max') ? number_format(request('salary_max'),0,'',',') : 'أي' }}
                  </span>
                  <span class="text-xs text-surface-500" data-i18n="jobs_page.to">إلى</span>
                </div>
                <div class="flex items-center gap-2">
                  <input type="number" name="salary_min" value="{{ request('salary_min',0) }}" min="0" step="500" placeholder="0"
                    id="job-sal-min"
                    class="w-full px-2.5 py-2 border border-surface-200 rounded-lg text-xs bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition text-center"/>
                  <span class="text-surface-300 shrink-0">—</span>
                  <input type="number" name="salary_max" value="{{ request('salary_max') }}" min="0" step="500" placeholder="∞"
                    id="job-sal-max"
                    class="w-full px-2.5 py-2 border border-surface-200 rounded-lg text-xs bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition text-center"/>
                </div>
              </div>
            </div>

            {{-- الموقع --}}
            <div class="bg-white border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="map-pin" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="common.location">الموقع</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 border-t border-surface-100">
                <div class="relative mt-3">
                  <i data-lucide="map-pin" class="absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-surface-400 pointer-events-none"></i>
                  <input type="text" name="location" value="{{ request('location') }}" placeholder="المدينة أو المنطقة" data-i18n-placeholder="jobs_page.city_placeholder"
                    class="w-full pr-9 pl-3 py-2.5 border border-surface-200 rounded-xl text-sm bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition"/>
                </div>
              </div>
            </div>

            {{-- الموعد النهائي --}}
            <div class="bg-white  border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="calendar" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_deadline">الموعد النهائي</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 border-t border-surface-100">
                <input type="date" name="deadline_before" value="{{ request('deadline_before') }}"
                  class="mt-3 w-full px-3 py-2.5 border border-surface-200 rounded-xl text-sm bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition"/>
              </div>
            </div>

            {{-- عدد الشواغر --}}
            <div class="bg-white  border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="users-round" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_vacancies">عدد الشواغر</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 space-y-2.5 border-t border-surface-100">
                @foreach(['1'=>'شاغر واحد فقط','5'=>'حتى 5 شواغر','10'=>'أكثر من 5 شواغر'] as $val => $label)
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="positions" value="{{ $val }}"
                    {{ request('positions') == $val ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-700 group-hover:text-brand-600 transition font-medium">{{ $label }}</span>
                </label>
                @endforeach
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="positions" value=""
                    {{ !request('positions') ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-400 group-hover:text-brand-600 transition" data-i18n="jobs_page.all">الكل</span>
                </label>
              </div>
            </div>

            {{-- Apply Button --}}
            <button type="submit"
              class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold transition text-sm flex items-center justify-center gap-2 shadow-md shadow-brand-200">
              <i data-lucide="search" class="w-4 h-4"></i> <span data-i18n="jobs_page.apply_filters">تطبيق الفلاتر</span>
            </button>
          </form>
        </div>

        {{-- ── SEEKERS FILTERS ── --}}
        <div id="seekers-sidebar" class="space-y-3 hidden">
          <form method="GET" id="seekers-filter-form">
            <input type="hidden" name="tab" value="seekers">

            <div class="bg-white border border-surface-200 p-5">
              <div class="flex items-center justify-between mb-4">
                <h3 class="font-extrabold text-surface-900 text-base flex items-center gap-2">
                  <i data-lucide="sliders-horizontal" class="w-4 h-4 text-brand-600"></i>
                  <span data-i18n="jobs_page.all_filters">كل الفلاتر</span>
                </h3>
                <a href="{{ url()->current() }}?tab=seekers"
                  class="text-xs text-brand-600 font-semibold hover:text-brand-800 transition" data-i18n="jobs_page.clear_all">مسح الكل</a>
              </div>
              <div class="relative">
                <i data-lucide="search" class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-surface-400 pointer-events-none"></i>
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                  placeholder="الاسم أو المسمى الوظيفي..." data-i18n-placeholder="jobs_page.name_placeholder"
                  class="w-full pr-10 pl-3 py-2.5 border border-surface-200 rounded-xl text-sm bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition"/>
              </div>
            </div>

            {{-- المهارات --}}
            <div class="bg-white rounded-2xl border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="zap" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_skills">المهارات</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 border-t border-surface-100">
                <input type="text" name="skills" value="{{ request('skills') }}"
                  placeholder="مثال: Leadership, Excel (فاصلة)"
                  class="mt-3 w-full px-3 py-2.5 border border-surface-200 rounded-xl text-sm bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition"/>
              </div>
            </div>

            {{-- مستوى الخبرة --}}
            <div class="bg-white rounded-2xl border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="trending-up" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_exp">مستوى الخبرة</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 space-y-2.5 border-t border-surface-100">
                @foreach(['entry'=>'مبتدئ','mid'=>'متوسط','senior'=>'خبير','executive'=>'تنفيذي'] as $val => $label)
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="experience_level" value="{{ $val }}"
                    {{ request('experience_level') == $val ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-700 group-hover:text-brand-600 transition font-medium">{{ $label }}</span>
                </label>
                @endforeach
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="experience_level" value=""
                    {{ !request('experience_level') ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-400" data-i18n="jobs_page.all">الكل</span>
                </label>
              </div>
            </div>

            {{-- الراتب المتوقع --}}
            <div class="bg-white rounded-2xl border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="banknote" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_expected_salary">الراتب المتوقع</span> <span style="font-size:11px;opacity:.6;">(ر.س)</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-5 border-t border-surface-100">
                <div class="flex items-center gap-2 mt-3">
                  <input type="number" name="salary_min" value="{{ request('salary_min') }}" placeholder="من"
                    class="w-full px-2.5 py-2 border border-surface-200 rounded-lg text-xs bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition text-center"/>
                  <span class="text-surface-300 shrink-0">—</span>
                  <input type="number" name="salary_max" value="{{ request('salary_max') }}" placeholder="إلى"
                    class="w-full px-2.5 py-2 border border-surface-200 rounded-lg text-xs bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition text-center"/>
                </div>
              </div>
            </div>

            {{-- الموقع --}}
            <div class="bg-white rounded-2xl border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="map-pin" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="common.location">الموقع</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 border-t border-surface-100">
                <input type="text" name="location" value="{{ request('location') }}" placeholder="المدينة أو المنطقة" data-i18n-placeholder="jobs_page.city_placeholder"
                  class="mt-3 w-full px-3 py-2.5 border border-surface-200 rounded-xl text-sm bg-surface-50 focus:outline-none focus:border-brand-400 focus:bg-white transition"/>
              </div>
            </div>

            {{-- نوع الدوام المفضل --}}
            <div class="bg-white rounded-2xl border border-surface-200 overflow-hidden filter-group">
              <button type="button" class="filter-group-toggle w-full flex items-center justify-between px-5 py-4 text-sm font-bold text-surface-800 hover:bg-surface-50 transition">
                <div class="flex items-center gap-2">
                  <i data-lucide="clock" class="w-4 h-4 text-brand-500"></i>
                  <span data-i18n="jobs_page.filter_pref_type">نوع الدوام المفضل</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-surface-400 transition-transform filter-chevron"></i>
              </button>
              <div class="filter-group-content px-5 pb-4 space-y-2.5 border-t border-surface-100">
                @foreach(['full_time'=>'دوام كامل','part_time'=>'دوام جزئي','remote'=>'عن بُعد','contract'=>'عقد مؤقت'] as $val => $label)
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="job_type" value="{{ $val }}"
                    {{ request('job_type') == $val ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-700 group-hover:text-brand-600 transition font-medium">{{ $label }}</span>
                </label>
                @endforeach
                <label class="flex items-center gap-3 cursor-pointer group">
                  <input type="radio" name="job_type" value=""
                    {{ !request('job_type') ? 'checked' : '' }}
                    class="w-4 h-4 text-brand-600 border-surface-300 focus:ring-brand-500 cursor-pointer">
                  <span class="text-sm text-surface-400" data-i18n="jobs_page.all">الكل</span>
                </label>
              </div>
            </div>

            <button type="submit"
              class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold transition text-sm flex items-center justify-center gap-2 shadow-md shadow-brand-200">
              <i data-lucide="search" class="w-4 h-4"></i> <span data-i18n="jobs_page.apply_filters">تطبيق الفلاتر</span>
            </button>
          </form>
        </div>

      </aside>

      {{-- ═══ LEFT MAIN CONTENT ═══ --}}
      <main class="flex-1 min-w-0">

        {{-- ── JOBS TAB ── --}}
        <div id="jobs-tab" class="tab-content">

          {{-- Results Bar --}}
          <div class="flex items-center justify-between mb-5">
            <div>
             
              {{-- Active Tags --}}
              <div class="flex flex-wrap gap-2 mt-2" id="jobs-active-tags"></div>
            </div>
            <div class="flex items-center gap-3">
              {{-- Sort --}}
              <select name="sort" id="jobs-sort-select"
                class="text-sm border border-surface-200 rounded-xl px-3 py-2 bg-white focus:outline-none focus:border-brand-400 text-surface-700 font-medium cursor-pointer">
                <option value="latest"      {{ request('sort')=='latest'      ?'selected':'' }} data-i18n="filter.newest">الأحدث</option>
                 {{ request('sort')=='salary_high' ?'selected':'' }} data-i18n="filter.salary_high">الراتب الأعلى</option>
                <option value="salary_low"  {{ request('sort')=='salary_low'  ?'selected':'' }} data-i18n="filter.salary_low">الراتب الأقل</option>
                <option value="deadline"    {{ request('sort')=='deadline'    ?'selected':'' }} data-i18n="jobs_page.sort_deadline">قرب الانتهاء</option>
              </select>
              {{-- View Toggle --}}
              <div class="flex items-center bg-white border border-surface-200 rounded-xl p-1 gap-1">
                <button class="view-toggle-btn p-1.5 rounded-lg bg-brand-600 text-white" data-view="list">
                  <i data-lucide="layout-list" class="w-4 h-4"></i>
                </button>
                <button class="view-toggle-btn p-1.5 rounded-lg text-surface-400 hover:text-surface-700" data-view="grid">
                  <i data-lucide="layout-grid" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </div>

          {{-- Job Cards — List View (default) --}}
          <div id="jobs-container" class="space-y-3">
            @forelse($jobs as $idx => $job)
            @php
              $gradients = [
                'from-violet-500 to-violet-700',
                'from-teal-500 to-teal-700',
                'from-orange-500 to-orange-700',
                'from-brand-500 to-brand-700',
              ];
              $g = $gradients[$idx % 4];
            @endphp

            {{-- LIST CARD --}}
            <div class="job-card-list bg-white rounded-2xl border border-surface-200 hover:border-brand-400 hover:shadow-md transition-all p-5 flex items-start gap-5 group cursor-pointer"
              style="animation: fadeUp 300ms {{ $idx * 45 }}ms both">

              {{-- Logo --}}
              <div class="w-14 h-14 rounded-xl bg-gradient-to-br {{ $g }} flex items-center justify-center text-white font-extrabold text-xl shrink-0">
                {{ strtoupper(substr($job->company->company_name ?? 'S', 0, 1)) }}
              </div>

              {{-- Body --}}
              <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-3 mb-2">
                  <div class="min-w-0">
                    <h3 class="font-bold text-surface-900 text-base group-hover:text-brand-600 transition truncate">{{ $job->title }}</h3>
                    <p class="text-sm text-surface-500 font-medium">{{ $job->company->company_name ?? 'شركة' }}</p>
                  </div>
                  <div class="flex items-center gap-2 shrink-0">
                    @if($job->deadline)
                    <span class="hidden sm:flex items-center gap-1 text-xs text-red-500 font-semibold bg-red-50 px-2.5 py-1 rounded-full">
                      <i data-lucide="clock" class="w-3 h-3"></i>
                      {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}
                    </span>
                    @endif
                    <button class="p-2 rounded-lg border border-surface-200 hover:border-brand-400 hover:bg-brand-50 transition text-surface-400 hover:text-brand-600"
                      onclick="toggleBookmark(this,{{ $job->id }})">
                      <i data-lucide="bookmark" class="w-4 h-4"></i>
                    </button>
                  </div>
                </div>

                <p class="text-sm text-surface-600 line-clamp-2 mb-3 leading-relaxed">{{ $job->description }}</p>

                <div class="flex flex-wrap items-center gap-2 mb-3">
                  <span class="flex items-center gap-1.5 px-2.5 py-1 bg-brand-50 text-brand-600 text-xs font-semibold rounded-full">
                    <i data-lucide="clock" class="w-3 h-3"></i>
                    @php $_jtk=['full_time'=>'job.full_time','part_time'=>'job.part_time','remote'=>'job.remote','hybrid'=>'jobs_page.hybrid','contract'=>'jobs_page.contract_temp','freelance'=>'job.freelance'][$job->job_type??'']; @endphp<span data-i18n="{{ $_jtk }}">{{ ['full_time'=>'دوام كامل','part_time'=>'جزئي','remote'=>'عن بُعد','hybrid'=>'هجين','contract'=>'عقد','freelance'=>'فريلانس'][$job->job_type] ?? $job->job_type }}</span>
                  </span>
                  @if($job->location)
                  <span class="flex items-center gap-1.5 px-2.5 py-1 bg-surface-100 text-surface-600 text-xs font-semibold rounded-full">
                    <i data-lucide="map-pin" class="w-3 h-3"></i>
                    {{ $job->location }}
                  </span>
                  @endif
                  @if($job->experience_level)
                  <span class="flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                    @php $_expk=['entry'=>'jobs_page.exp_entry_short','mid'=>'jobs_page.exp_mid_short','senior'=>'jobs_page.exp_senior_short','executive'=>'jobs_page.exp_exec_short'][$job->experience_level??'']; @endphp<span data-i18n="{{ $_expk }}">{{ ['entry'=>'مبتدئ','mid'=>'متوسط','senior'=>'خبير','executive'=>'تنفيذي'][$job->experience_level] ?? $job->experience_level }}</span>
                  </span>
                  @endif
                  @if($job->positions_available)
                  <span class="flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full">
                    <i data-lucide="users" class="w-3 h-3"></i>
                    {{ $job->positions_available }} شاغر
                  </span>
                  @endif
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-surface-100">
                  <div>
                    <span class="text-lg font-extrabold text-brand-700">{{ number_format($job->salary_min ?? 0, 0, '', ',') }}</span>
                    @if($job->salary_max)
                    <span class="text-sm text-surface-400"> — {{ number_format($job->salary_max, 0, '', ',') }}</span>
                    @endif
                    <span class="text-xs text-surface-400 font-medium"> <span data-i18n="jobs_page.sar_month">ر.س/شهر</span></span>
                  </div>
                  <a href="#" class="flex items-center gap-1.5 text-sm font-bold text-brand-600 hover:text-brand-800 transition px-4 py-2 bg-brand-50 hover:bg-brand-100 rounded-xl">
                    عرض التفاصيل
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                  </a>
                </div>
              </div>
            </div>
            @empty
            <div class="text-center py-24">
              <div class="w-20 h-20 bg-surface-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="search-x" class="w-10 h-10 text-surface-400"></i>
              </div>
              <p class="text-surface-700 text-lg font-bold mb-1" data-i18n="jobs_page.no_jobs">لا توجد وظائف مطابقة</p>
              <p class="text-surface-400 text-sm" data-i18n="jobs_page.no_jobs_hint">جرّب تعديل الفلاتر أو توسيع نطاق البحث</p>
              <a href="{{ url()->current() }}?tab=jobs" class="inline-flex items-center gap-2 mt-5 px-6 py-2.5 bg-brand-600 text-white font-bold rounded-xl text-sm hover:bg-brand-700 transition">
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                مسح الفلاتر
              </a>
            </div>
            @endforelse
          </div>

          @if($jobs->hasPages())
          <div class="mt-10 flex justify-center">
            {{ $jobs->appends(request()->query())->links('pagination::tailwind') }}
          </div>
          @endif
        </div>

        {{-- ── SEEKERS TAB ── --}}
        <div id="seekers-tab" class="tab-content hidden">

          <div class="flex items-center justify-between mb-5">
          
            <select id="seekers-sort-select"
              class="text-sm border border-surface-200 rounded-xl px-3 py-2 bg-white focus:outline-none focus:border-brand-400 text-surface-700 font-medium cursor-pointer">
              <option value="latest"      {{ request('sort')=='latest'      ?'selected':'' }} data-i18n="filter.newest">الأحدث</option>
                 {{ request('sort')=='salary_high' ?'selected':'' }} data-i18n="filter.salary_high">الراتب الأعلى</option>
              <option value="salary_low"  {{ request('sort')=='salary_low'  ?'selected':'' }} data-i18n="filter.salary_low">الراتب الأقل</option>
              <option value="name"        {{ request('sort')=='name'        ?'selected':'' }} data-i18n="jobs_page.sort_name">الاسم أبجدياً</option>
            </select>
          </div>

          {{-- Seeker Cards Grid --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse($jobSeekers as $si => $seeker)
            @php
              $avColors = [
                ['bg-violet-100','text-violet-700','from-violet-400 to-violet-600'],
                ['bg-teal-100','text-teal-700','from-teal-400 to-teal-600'],
                ['bg-orange-100','text-orange-700','from-orange-400 to-orange-600'],
                ['bg-blue-100','text-blue-700','from-blue-400 to-blue-600'],
              ];
              [$bgLight,$textColor,$avGrad] = $avColors[$si % 4];
            @endphp
            <div class="bg-white rounded-2xl border border-surface-200 hover:border-brand-400 hover:shadow-md transition-all p-6 group cursor-pointer flex flex-col items-center text-center"
              style="animation: fadeUp 300ms {{ $si * 55 }}ms both">

              {{-- Avatar --}}
              <div class="w-16 h-16 rounded-full bg-gradient-to-br {{ $avGrad }} flex items-center justify-center text-white font-extrabold text-xl mb-3 ring-4 ring-white shadow-md">
                {{ strtoupper(substr($seeker->first_name,0,1)) }}{{ strtoupper(substr($seeker->last_name,0,1)) }}
              </div>

              <h3 class="font-bold text-surface-900 text-base group-hover:text-brand-600 transition mb-0.5">
                {{ $seeker->first_name }} {{ $seeker->last_name }}
              </h3>
              <p class="text-sm text-brand-600 font-semibold mb-3">{{ $seeker->job_title ?? 'باحث عن عمل' }}</p>

              <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $bgLight }} {{ $textColor }} text-xs font-bold rounded-full mb-4">
                @switch($seeker->seeker_type)
                  @case('leadership')
                    <i data-lucide="crown" class="w-3 h-3"></i> قيادي @break
                  @case('professional')
                    <i data-lucide="briefcase" class="w-3 h-3"></i> مهني @break
                  @default
                    <i data-lucide="clipboard" class="w-3 h-3"></i> إداري
                @endswitch
              </span>

              @if($seeker->skills && count($seeker->skills))
              <div class="flex flex-wrap gap-1.5 justify-center mb-4">
                @foreach(array_slice($seeker->skills,0,3) as $sk)
                <span class="px-2.5 py-1 bg-surface-100 text-surface-600 text-xs font-semibold rounded-lg">{{ $sk }}</span>
                @endforeach
                @if(count($seeker->skills)>3)
                <span class="px-2.5 py-1 bg-surface-100 text-surface-400 text-xs rounded-lg">+{{ count($seeker->skills)-3 }}</span>
                @endif
              </div>
              @endif

              <div class="flex flex-col items-center gap-1.5 text-xs text-surface-500 mb-4">
                @if($seeker->location)
                <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i>{{ $seeker->location }}</span>
                @endif
                @if($seeker->expected_salary_min)
                <span class="flex items-center gap-1 text-emerald-600 font-bold">
                  <i data-lucide="banknote" class="w-3 h-3"></i>
                  {{ number_format($seeker->expected_salary_min,0,'',',') }}
                  @if($seeker->expected_salary_max) — {{ number_format($seeker->expected_salary_max,0,'',',') }} @endif
                  ر.س
                </span>
                @endif
              </div>

              <button class="w-full mt-auto py-2.5 px-4 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl transition text-sm">
                عرض الملف الكامل
              </button>
            </div>
            @empty
            <div class="col-span-3 text-center py-24">
              <div class="w-20 h-20 bg-surface-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="users-x" class="w-10 h-10 text-surface-400"></i>
              </div>
              <p class="text-surface-700 text-lg font-bold mb-1" data-i18n="jobs_page.no_seekers">لا يوجد باحثون مطابقون</p>
              <p class="text-surface-400 text-sm" data-i18n="jobs_page.no_seekers_hint">جرّب توسيع نطاق البحث</p>
              <a href="{{ url()->current() }}?tab=seekers" class="inline-flex items-center gap-2 mt-5 px-6 py-2.5 bg-brand-600 text-white font-bold rounded-xl text-sm hover:bg-brand-700 transition">
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                مسح الفلاتر
              </a>
            </div>
            @endforelse
          </div>

          @if($jobSeekers->hasPages())
          <div class="mt-10 flex justify-center">
            {{ $jobSeekers->appends(request()->query())->links('pagination::tailwind') }}
          </div>
          @endif
        </div>

      </main>
    </div>{{-- end flex --}}
  </div>
</div>

@endsection

@section('extra-scripts')
<style>
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}
.filter-group-content { display: none; padding-top: 14px; }
.filter-group-content.open { display: block; }
.filter-chevron.rotated { transform: rotate(180deg); }

/* Grid view for jobs */
#jobs-container.grid-view {
  display: grid !important;
  grid-template-columns: repeat(2, 1fr);
  gap: 14px;
}
#jobs-container.grid-view .job-card-list {
  flex-direction: column;
}
#jobs-container.grid-view .job-card-list > .w-14 {
  width: 40px; height: 40px; font-size: 15px;
}
</style>
<script>
(function(){
  const $ = s => document.querySelector(s);
  const $$ = s => [...document.querySelectorAll(s)];
  const params = new URLSearchParams(location.search);
  let activeTab = params.get('tab') || 'jobs';

  /* ── TABS ── */
  function switchTab(name) {
    activeTab = name;
    $$('.tab-content').forEach(el => el.classList.toggle('hidden', el.id !== name + '-tab'));
    $$('.tab-btn').forEach(b => {
      const on = b.dataset.tab === name;
      b.classList.toggle('border-brand-600', on);
      b.classList.toggle('text-brand-600', on);
      b.classList.toggle('border-transparent', !on);
      b.classList.toggle('text-surface-500', !on);
    });
    $('#jobs-sidebar').classList.toggle('hidden', name !== 'jobs');
    $('#seekers-sidebar').classList.toggle('hidden', name !== 'seekers');
  }
  $$('.tab-btn').forEach(b => b.addEventListener('click', () => switchTab(b.dataset.tab)));
  switchTab(activeTab);

  /* ── FILTER GROUP ACCORDIONS ── */
  $$('.filter-group-toggle').forEach(btn => {
    const content = btn.nextElementSibling;
    const chevron = btn.querySelector('.filter-chevron');
    // open by default if has active value
    const inputs = content.querySelectorAll('input,select');
    const hasValue = [...inputs].some(el => el.value && el.value !== '' && (el.type !== 'radio' || el.checked));
    if (hasValue) { content.classList.add('open'); chevron.classList.add('rotated'); }

    btn.addEventListener('click', () => {
      content.classList.toggle('open');
      chevron.classList.toggle('rotated');
    });
  });

  /* ── ACTIVE FILTER TAGS ── */
  const tagLabels = { keyword:'بحث', job_type:'نوع الدوام', location:'الموقع', experience_level:'الخبرة', salary_min:'من', salary_max:'حتى', skills:'المهارات', positions:'الشواغر', deadline_before:'الموعد' };
  const filterKeys = Object.keys(tagLabels);

  function renderTags(containerId) {
    const wrap = document.getElementById(containerId);
    if (!wrap) return;
    wrap.innerHTML = '';
    filterKeys.forEach(k => {
      const v = params.get(k);
      if (!v || v === '') return;
      const tag = document.createElement('span');
      tag.className = 'inline-flex items-center gap-1.5 px-3 py-1 bg-brand-50 text-brand-700 text-xs font-bold rounded-full border border-brand-100';
      tag.innerHTML = `${tagLabels[k]}: ${v} <button onclick="removeFilter('${k}')" style="margin-right:2px;color:#6d28d9;opacity:.7;background:none;border:none;cursor:pointer;font-size:14px;line-height:1;">×</button>`;
      wrap.appendChild(tag);
    });
  }
  renderTags('jobs-active-tags');
  window.removeFilter = k => { params.delete(k); location.search = params.toString(); };

  /* ── HERO SEARCH ── */
  const heroIn = $('#hero-search');
  $('#hero-search-btn').addEventListener('click', () => {
    if (heroIn.value.trim()) { params.set('keyword', heroIn.value.trim()); params.set('tab', activeTab); location.search = params.toString(); }
  });
  heroIn.addEventListener('keydown', e => { if (e.key === 'Enter') $('#hero-search-btn').click(); });

  /* ── SORT SELECT → auto-submit ── */
  ['jobs-sort-select','seekers-sort-select'].forEach(id => {
    const sel = document.getElementById(id);
    if (!sel) return;
    sel.addEventListener('change', () => {
      params.set('sort', sel.value);
      params.set('tab', activeTab);
      location.search = params.toString();
    });
  });

  /* ── VIEW TOGGLE ── */
  const jobsContainer = $('#jobs-container');
  $$('.view-toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      $$('.view-toggle-btn').forEach(b => {
        b.classList.remove('bg-brand-600','text-white');
        b.classList.add('text-surface-400');
      });
      btn.classList.add('bg-brand-600','text-white');
      btn.classList.remove('text-surface-400');
      jobsContainer.classList.toggle('grid-view', btn.dataset.view === 'grid');
    });
  });

  /* ── BOOKMARK ── */
  window.toggleBookmark = (btn, id) => {
    const on = btn.classList.toggle('border-brand-400');
    btn.classList.toggle('bg-brand-50', on);
    btn.classList.toggle('text-brand-600', on);
  };

  /* ── SALARY LIVE LABEL ── */
  const sMin = $('#job-sal-min'), sMax = $('#job-sal-max'), sLabel = $('#job-salary-label');
  if (sMin && sMax && sLabel) {
    const upd = () => {
      const a = parseInt(sMin.value)||0, b = parseInt(sMax.value)||0;
      sLabel.textContent = (a?a.toLocaleString('ar-SA'):'0') + ' — ' + (b?b.toLocaleString('ar-SA'):'أي');
    };
    sMin.addEventListener('input', upd);
    sMax.addEventListener('input', upd);
  }
})();
</script>
@endsection
