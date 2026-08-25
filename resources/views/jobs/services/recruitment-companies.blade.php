@extends('jobs.layouts.app')

@section('title', 'شركات التوظيف')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section class="py-12 bg-gradient-to-r from-purple-600 via-purple-700 to-purple-800 relative overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, white, transparent 50%), radial-gradient(circle at 80% 20%, white, transparent 40%);"></div>
  </div>
  
  <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">{{ $serviceTitle }}</h1>
    <p class="text-xl text-white/85 max-w-2xl mx-auto">{{ $serviceDescription }}</p>
  </div>
</section>

<!-- ===== FILTERS SECTION ===== -->
<section class="py-8 bg-white border-b border-surface-200">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row gap-4">
      <input type="text" placeholder="ابحث عن شركة توظيف..." class="flex-1 px-4 py-3 border border-surface-200 rounded-lg outline-none focus:border-purple-500">
      <select class="px-4 py-3 border border-surface-200 rounded-lg outline-none focus:border-purple-500">
        <option>الترتيب حسب</option>
        <option>الأحدث</option>
        <option>الأعلى تقييماً</option>
        <option>الأكثر وظائف</option>
      </select>
    </div>
  </div>
</section>

<!-- ===== COMPANIES GRID ===== -->
<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($companies as $company)
      <div class="company-card rounded-2xl overflow-hidden border-2 border-surface-200 hover:border-purple-500 hover:shadow-xl transition-all duration-300 group cursor-pointer">
        <!-- Header with Cover -->
        <div class="h-32 bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 relative overflow-hidden">
          <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 30% 20%, white, transparent 50%);"></div>
        </div>

        <!-- Logo -->
        <div class="relative px-6 pb-6">
          <div class="absolute -top-12 left-6 w-20 h-20 rounded-2xl bg-white border-4 border-surface-100 flex items-center justify-center shadow-lg overflow-hidden">
            @if($company->logo)
            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->company_name }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold text-2xl">
              {{ substr($company->company_name, 0, 1) }}
            </div>
            @endif
          </div>

          <!-- Info -->
          <div class="pt-16">
            <h3 class="text-xl font-bold text-surface-900 group-hover:text-purple-600 transition mb-1">
              {{ $company->company_name }}
            </h3>
            <p class="text-sm text-surface-600 mb-3">{{ $company->industry ?? 'توظيف' }}</p>

            <!-- Rating -->
            <div class="flex items-center gap-2 mb-4">
              <div class="flex text-amber-400">
                @for($i = 0; $i < 5; $i++)
                  <i data-lucide="star" class="w-4 h-4 {{ $i < round($company->rating ?? 0) ? 'fill-current' : '' }}"></i>
                @endfor
              </div>
              <span class="text-xs font-semibold text-surface-600">{{ round($company->rating ?? 0, 1) }} ({{ $company->reviews_count }} تقييم)</span>
            </div>

            <!-- Description -->
            <p class="text-sm text-surface-700 mb-4 line-clamp-2">
              {{ $company->description ?? 'شركة متخصصة في التوظيف والتطابق الذكي' }}
            </p>

            <!-- Details Grid -->
            <div class="grid grid-cols-2 gap-3 mb-4 text-xs">
              <div class="bg-purple-50 rounded-lg p-3 text-center">
                <p class="text-purple-600 font-bold">{{ $company->jobs->count() }}</p>
                <p class="text-surface-600">وظيفة نشطة</p>
              </div>
              <div class="bg-purple-50 rounded-lg p-3 text-center">
                <p class="text-purple-600 font-bold">{{ $company->employee_count ?? 'ن/م' }}</p>
                <p class="text-surface-600">موظف</p>
              </div>
            </div>

            <!-- Contact Info -->
            <div class="space-y-2 mb-4 text-xs text-surface-600">
              @if($company->location)
              <div class="flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4 text-purple-600"></i>
                <span>{{ $company->location }}</span>
              </div>
              @endif
              @if($company->website)
              <div class="flex items-center gap-2">
                <i data-lucide="globe" class="w-4 h-4 text-purple-600"></i>
                <a href="{{ $company->website }}" target="_blank" class="text-purple-600 hover:underline">{{ parse_url($company->website, PHP_URL_HOST) }}</a>
              </div>
              @endif
              @if($company->phone)
              <div class="flex items-center gap-2">
                <i data-lucide="phone" class="w-4 h-4 text-purple-600"></i>
                <span>{{ $company->phone }}</span>
              </div>
              @endif
            </div>

            <!-- AI Matching Badge -->
            <div class="mb-4 px-3 py-2 bg-purple-50 rounded-lg text-center text-xs text-purple-600 font-semibold">
              <i data-lucide="brain" class="w-3 h-3 inline mr-1"></i>
              تقنية AI متقدمة للتطابق
            </div>

            <!-- CTA Buttons -->
            <div class="flex gap-2">
              <a href="" class="flex-1 py-2 px-4 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg transition text-sm text-center">
                عرض الملف
              </a>
              <button class="flex-1 py-2 px-4 border-2 border-purple-600 text-purple-600 hover:bg-purple-50 font-bold rounded-lg transition text-sm">
                تابع
              </button>
            </div>

            <!-- Verified Badge -->
            @if($company->is_verified)
            <div class="mt-3 flex items-center justify-center gap-1 text-xs text-purple-600 font-bold">
              <i data-lucide="check-circle" class="w-4 h-4 fill-current"></i>
              شركة موثقة
            </div>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-3 text-center py-12">
        <i data-lucide="inbox" class="w-16 h-16 mx-auto text-surface-300 mb-4"></i>
        <p class="text-surface-600 text-lg">لا توجد شركات توظيف متاحة حالياً</p>
      </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($companies->hasPages())
    <div class="mt-12 flex justify-center">
      {{ $companies->links('pagination::tailwind') }}
    </div>
    @endif
  </div>
</section>

@endsection

@section('extra-scripts')
<script>
  document.querySelectorAll('.company-card').forEach((card, index) => {
    card.style.animation = `fadeInUp 0.6s ease-out ${index * 0.1}s both`;
  });
</script>
<style>
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
@endsection
