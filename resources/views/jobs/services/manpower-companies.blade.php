@extends('jobs.layouts.app')

@section('title', 'شركات ترغب التنازل عن العمالة')

@section('content')

<!-- ===== HERO ===== -->
<section class="py-12 bg-gradient-to-r from-cyan-600 via-cyan-700 to-cyan-800 relative overflow-hidden">
  <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 50%, white, transparent 50%), radial-gradient(circle at 80% 20%, white, transparent 40%);"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">{{ $serviceTitle }}</h1>
    <p class="text-xl text-white/85 max-w-2xl mx-auto">{{ $serviceDescription }}</p>
  </div>
</section>

<!-- ===== FILTERS ===== -->
<section class="py-6 bg-white border-b border-surface-200">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row gap-4">
      <input type="text" placeholder="ابحث عن شركة..."
             class="flex-1 px-4 py-3 border border-surface-200 rounded-xl outline-none focus:border-cyan-500 text-sm">
      <select class="px-4 py-3 border border-surface-200 rounded-xl outline-none focus:border-cyan-500 text-sm bg-white">
        <option>الترتيب حسب</option>
        <option>الأحدث</option>
        <option>الأعلى تقييماً</option>
        <option>الأكثر توظيفاً</option>
      </select>
    </div>
  </div>
</section>

<!-- ===== COMPANIES GRID ===== -->
<section class="py-12 bg-surface-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      @forelse($companies as $company)

      @php
      $reasonLabels = [
        'project_end'    => ['label' => 'انتهاء المشروع',   'icon' => 'ti-flag',          'class' => 'bg-amber-50 text-amber-800 border border-amber-200'],
        'cost_reduction' => ['label' => 'تخفيض التكاليف',   'icon' => 'ti-trending-down',  'class' => 'bg-red-50 text-red-800 border border-red-200'],
        'restructuring'  => ['label' => 'إعادة هيكلة',      'icon' => 'ti-git-branch',     'class' => 'bg-purple-50 text-purple-800 border border-purple-200'],
        'seasonal'       => ['label' => 'عمالة موسمية',     'icon' => 'ti-sun',            'class' => 'bg-orange-50 text-orange-800 border border-orange-200'],
        'overstaffing'   => ['label' => 'فائض في الكوادر',  'icon' => 'ti-users',          'class' => 'bg-blue-50 text-blue-800 border border-blue-200'],
        'other'          => ['label' => 'أسباب أخرى',       'icon' => 'ti-dots',           'class' => 'bg-surface-100 text-surface-700 border border-surface-200'],
      ];
      @endphp

      <div class="company-card bg-white rounded-2xl border border-surface-200 overflow-hidden hover:border-cyan-400 hover:shadow-lg transition-all duration-300 group flex flex-col">

        <!-- Cover -->
        <div class="h-20 bg-gradient-to-r from-cyan-500 to-cyan-700 relative flex-shrink-0">
          <div class="absolute inset-0 opacity-20" style="background: radial-gradient(circle at 20% 60%, white, transparent 60%);"></div>
          <div class="absolute top-3 left-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-white" style="background:rgba(255,255,255,0.18); border:1px solid rgba(255,255,255,0.3);">
              <i class="ti ti-transfer-in text-sm"></i> تنازل عن عمالة
            </span>
          </div>
        </div>

        <!-- Avatar -->
        <div class="px-5 relative">
          <div class="w-14 h-14 rounded-xl border-4 border-white -mt-7 flex items-center justify-center text-white font-bold text-xl shadow-md overflow-hidden"
               style="background: linear-gradient(135deg,#22d3ee,#0891b2);">
            @if($company->logo)
              <img src="{{ asset('storage/'.$company->logo) }}" class="w-full h-full object-cover">
            @else
              {{ mb_substr($company->company_name, 0, 1) }}
            @endif
          </div>
        </div>

        <!-- Body -->
        <div class="px-5 pb-5 pt-3 flex flex-col flex-1">

          <!-- Name + Industry -->
          <h3 class="text-base font-bold text-surface-900 group-hover:text-cyan-700 transition mb-0.5">
            {{ $company->company_name }}
          </h3>
          <p class="text-xs text-surface-500 mb-3">{{ $company->industry ?? 'صناعة' }}</p>

          <!-- Rating -->
          <div class="flex items-center gap-1.5 mb-3">
            <div class="flex text-amber-400 text-xs">
              @for($i = 0; $i < 5; $i++)
                <i class="ti {{ $i < round($company->rating ?? 0) ? 'ti-star-filled' : 'ti-star' }}"></i>
              @endfor
            </div>
            <span class="text-xs text-surface-500">{{ round($company->rating ?? 0, 1) }} ({{ $company->reviews_count ?? 0 }} تقييم)</span>
          </div>

          <!-- Description -->
          <p class="text-xs text-surface-600 leading-relaxed mb-4 line-clamp-2">
            {{ $company->description ?? 'شركة رائدة تمتلك كوادر بشرية مدربة ترغب في نقل عقودها.' }}
          </p>

          <!-- Stats -->
          <div class="grid grid-cols-2 gap-2 mb-4">
            <div class="bg-cyan-50 rounded-xl p-3 text-center">
              <p class="text-sm font-bold text-cyan-700">{{ $company->jobs->count() }}</p>
              <p class="text-xs text-surface-500 mt-0.5">وظيفة نشطة</p>
            </div>
            <div class="bg-cyan-50 rounded-xl p-3 text-center">
              <p class="text-sm font-bold text-cyan-700">{{ $company->employee_count ?? 'ن/م' }}</p>
              <p class="text-xs text-surface-500 mt-0.5">عامل متاح</p>
            </div>
          </div>

          <!-- ✅ أسباب التنازل -->
         @php $reasons = is_array($company->transfer_reasons) ? $company->transfer_reasons : json_decode($company->transfer_reasons ?? '[]', true); @endphp
@if(!empty($reasons))
          <div class="rounded-xl p-3 mb-4" style="background:#f0fdff; border:1px solid #a5f3fc;">
            <p class="text-xs font-bold mb-2 flex items-center gap-1.5" style="color:#164e63;">
              <i class="ti ti-info-circle text-cyan-600"></i>
              أسباب التنازل
            </p>
            <div class="flex flex-wrap gap-1.5 mb-2">
             @foreach($reasons as $reason)
                @if(isset($reasonLabels[$reason]))
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold {{ $reasonLabels[$reason]['class'] }}">
                  <i class="ti {{ $reasonLabels[$reason]['icon'] }}" style="font-size:11px;"></i>
                  {{ $reasonLabels[$reason]['label'] }}
                </span>
                @endif
              @endforeach
            </div>
            @if($company->transfer_notes)
            <p class="text-xs leading-relaxed rounded-lg px-2.5 py-2" style="color:#164e63; background:#cffafe; border:1px solid #a5f3fc;">
              {{ $company->transfer_notes }}
            </p>
            @endif
          </div>
          @endif

          <!-- Contact Info -->
          <div class="space-y-1.5 mb-4">
            @if($company->location)
            <div class="flex items-center gap-2 text-xs text-surface-500">
              <i class="ti ti-map-pin text-cyan-600 text-sm flex-shrink-0"></i>
              <span>{{ $company->location }}</span>
            </div>
            @endif
            @if($company->website)
            <div class="flex items-center gap-2 text-xs text-surface-500">
              <i class="ti ti-world text-cyan-600 text-sm flex-shrink-0"></i>
              <a href="{{ $company->website }}" target="_blank" class="text-cyan-600 hover:underline">
                {{ parse_url($company->website, PHP_URL_HOST) }}
              </a>
            </div>
            @endif
            @if($company->phone)
            <div class="flex items-center gap-2 text-xs text-surface-500">
              <i class="ti ti-phone text-cyan-600 text-sm flex-shrink-0"></i>
              <span>{{ $company->phone }}</span>
            </div>
            @endif
          </div>

          <!-- CTA Buttons -->
          <div class="grid grid-cols-2 gap-2 mt-auto">
            <a href="" class="py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white font-bold rounded-xl transition text-xs text-center">
              عرض الملف
            </a>
            <button class="py-2.5 border-2 border-cyan-600 text-cyan-600 hover:bg-cyan-50 font-bold rounded-xl transition text-xs">
              تواصل معنا
            </button>
          </div>

          <!-- Verified -->
          @if($company->is_verified)
          <div class="mt-3 flex items-center justify-center gap-1.5 text-xs font-bold text-cyan-700">
            <i class="ti ti-circle-check text-sm"></i>
            شركة موثقة
          </div>
          @endif

        </div>
      </div>

      @empty
      <div class="col-span-3 text-center py-20">
        <i class="ti ti-inbox text-6xl text-surface-300 block mb-4"></i>
        <p class="text-surface-500 text-lg">لا توجد شركات متاحة حالياً</p>
      </div>
      @endforelse

    </div>

    @if($companies->hasPages())
    <div class="mt-12 flex justify-center">
      {{ $companies->links('pagination::tailwind') }}
    </div>
    @endif

  </div>
</section>

@endsection

@section('extra-scripts')
<style>
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }
</style>
<script>
  document.querySelectorAll('.company-card').forEach((card, i) => {
    card.style.animation = `fadeInUp 0.5s ease-out ${i * 0.08}s both`;
  });
</script>
@endsection
