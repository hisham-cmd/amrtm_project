@extends('jobs.layouts.app')
@section('title', 'نتائج البحث - وظّفني')

@section('content')

{{-- ═══ HERO / SEARCH BAR ═══ --}}
<section class="relative overflow-hidden" style="background:#9d4db8; padding:2rem 1.5rem 2.5rem;">
  <div class="relative z-10 text-center max-w-4xl mx-auto">
    <h1 class="text-2xl md:text-3xl font-bold text-white mb-4">
      <span data-i18n="search.heading">نتائج البحث عن الوظائف</span>
    </h1>

    <form action="{{ route('jobs.search') }}" method="GET"
          class="bg-white rounded-3xl shadow-2xl p-2 max-w-2xl mx-auto"
          style="display:grid; grid-template-columns:1fr 1fr 1fr auto; gap:6px;">
      <input type="text" name="title" value="{{ request('title') }}"
             placeholder="المسمى الوظيفي..."
             class="px-4 py-3 text-sm outline-none text-right rounded-2xl bg-transparent text-slate-800">
      <select name="location" class="px-4 py-3 text-sm outline-none text-right rounded-2xl appearance-none bg-transparent text-slate-700">
        <option value="" {{ !request('location') ? 'selected' : '' }}>المدينة</option>
        <option value="riyadh"  {{ request('location') === 'riyadh'  ? 'selected' : '' }}>الرياض</option>
        <option value="jeddah"  {{ request('location') === 'jeddah'  ? 'selected' : '' }}>جدة</option>
        <option value="dammam"  {{ request('location') === 'dammam'  ? 'selected' : '' }}>الدمام</option>
        <option value="remote"  {{ request('location') === 'remote'  ? 'selected' : '' }}>عن بُعد</option>
      </select>
      <select name="experience_level" class="px-4 py-3 text-sm outline-none text-right rounded-2xl appearance-none bg-transparent text-slate-700">
        <option value="" {{ !request('experience_level') ? 'selected' : '' }}>مستوى الخبرة</option>
        <option value="entry"     {{ request('experience_level') === 'entry'     ? 'selected' : '' }}>دخول</option>
        <option value="mid"       {{ request('experience_level') === 'mid'       ? 'selected' : '' }}>متوسط</option>
        <option value="senior"    {{ request('experience_level') === 'senior'    ? 'selected' : '' }}>رفيع</option>
        <option value="executive" {{ request('experience_level') === 'executive' ? 'selected' : '' }}>تنفيذي</option>
      </select>
      @if(request('type'))
        <input type="hidden" name="type" value="{{ request('type') }}">
      @endif
      <button type="submit" class="flex items-center justify-center gap-2 px-6 py-3 font-bold rounded-2xl transition-all text-sm text-white"
              style="background:linear-gradient(135deg,#7c3aed,#9333ea);">
        <i data-lucide="search" class="w-4 h-4"></i>
        <span>بحث</span>
      </button>
    </form>
  </div>
</section>

{{-- ═══ RESULTS ═══ --}}
<section class="py-10 bg-surface-50 min-h-screen">
  <div class="max-w-5xl mx-auto px-6">

    {{-- Count + active type tag --}}
    <div class="flex items-center justify-between mb-6" dir="rtl">
      <p class="text-sm text-surface-600">
        تم العثور على <span class="font-bold text-surface-900">{{ $jobs->total() }}</span> وظيفة
      </p>
      @if(request('type'))
        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
          <i data-lucide="tag" class="w-3 h-3"></i>
          {{ match(request('type')) {
              'part-time'   => 'دوام جزئي',
              'seasonal'    => 'موسمي',
              'recruitment' => 'استقدام',
              'remote'      => 'عن بُعد',
              default       => request('type'),
          } }}
          <a href="{{ route('jobs.search', request()->except('type')) }}" class="mr-1 text-purple-400 hover:text-purple-700">✕</a>
        </span>
      @endif
    </div>

    @forelse($jobs as $job)
      <div class="bg-white rounded-2xl border border-surface-200 p-5 mb-4 hover:shadow-md transition-shadow" dir="rtl">
        <div class="flex items-start justify-between gap-4">

          {{-- Info --}}
          <div class="flex-1 min-w-0">
            <h2 class="text-base font-bold text-surface-900 mb-1 truncate">{{ $job->title }}</h2>

            <div class="flex flex-wrap items-center gap-3 text-xs text-surface-500 mb-3">
              @if($job->location)
                <span class="flex items-center gap-1">
                  <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                  {{ $job->location }}
                </span>
              @endif
              @if($job->job_type)
                <span class="flex items-center gap-1">
                  <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                  {{ $job->job_type }}
                </span>
              @endif
              @if($job->experience_level)
                <span class="flex items-center gap-1">
                  <i data-lucide="bar-chart-2" class="w-3.5 h-3.5"></i>
                  {{ $job->experience_level }}
                </span>
              @endif
              @if($job->salary_min || $job->salary_max)
                <span class="flex items-center gap-1 text-emerald-600 font-semibold">
                  <i data-lucide="banknote" class="w-3.5 h-3.5"></i>
                  @if($job->salary_min && $job->salary_max)
                    {{ number_format($job->salary_min) }} – {{ number_format($job->salary_max) }} ر.س
                  @elseif($job->salary_min)
                    من {{ number_format($job->salary_min) }} ر.س
                  @else
                    حتى {{ number_format($job->salary_max) }} ر.س
                  @endif
                </span>
              @endif
            </div>

            @if($job->description)
              <p class="text-xs text-surface-600 leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($job->description), 160) }}</p>
            @endif
          </div>

          {{-- CTA --}}
          <div class="shrink-0 flex flex-col items-end gap-2">
            <a href="{{ route('jobs.listings.show', $job->id) }}"
               class="px-5 py-2 rounded-xl text-xs font-bold text-white transition-all"
               style="background:linear-gradient(135deg,#9d4db8,#7c3aed);">
              التفاصيل
            </a>
            @if($job->deadline)
              <span class="text-xs text-surface-400">
                <i data-lucide="calendar" class="w-3 h-3 inline"></i>
                {{ $job->deadline->format('Y/m/d') }}
              </span>
            @endif
          </div>

        </div>
      </div>
    @empty
      <div class="text-center py-20">
        <i data-lucide="search-x" class="w-16 h-16 mx-auto text-surface-300 mb-4"></i>
        <h3 class="text-xl font-bold text-surface-700 mb-2">لا توجد نتائج</h3>
        <p class="text-surface-500 text-sm mb-6">جرّب تعديل معايير البحث أو استعرض جميع الوظائف</p>
        <a href="{{ route('jobs.search') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-bold text-white"
           style="background:linear-gradient(135deg,#9d4db8,#7c3aed);">
          <i data-lucide="layout-grid" class="w-4 h-4"></i>
          عرض جميع الوظائف
        </a>
      </div>
    @endforelse

    {{-- Pagination --}}
    @if($jobs->hasPages())
      <div class="mt-8 flex justify-center" dir="ltr">
        {{ $jobs->links() }}
      </div>
    @endif

  </div>
</section>

@endsection
