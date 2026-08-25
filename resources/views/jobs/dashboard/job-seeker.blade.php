@extends('jobs.layouts.app')

@section('title', 'لوحة تحكم الباحث عن عمل - وظّفني')

@section('content')
<div class="min-h-screen bg-surface-50 py-12">
  <div class="max-w-7xl mx-auto px-6">
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-surface-900">مرحباً {{ auth()->user()->name }}! 👋</h1>
      <p class="text-surface-600 mt-2">ابحث عن فرصتك المثالية</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-xl p-6 border-l-4 border-brand-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">التطبيقات</p>
            <p class="text-3xl font-bold text-surface-900">{{ $applications_count ?? 0 }}</p>
          </div>
          <i data-lucide="send" class="w-12 h-12 text-brand-600 opacity-20"></i>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border-l-4 border-emerald-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">الموفوقة</p>
            <p class="text-3xl font-bold text-surface-900">{{ $accepted_count ?? 0 }}</p>
          </div>
          <i data-lucide="check-circle" class="w-12 h-12 text-emerald-600 opacity-20"></i>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border-l-4 border-amber-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">المحفوظة</p>
            <p class="text-3xl font-bold text-surface-900">{{ $saved_jobs ?? 0 }}</p>
          </div>
          <i data-lucide="bookmark" class="w-12 h-12 text-amber-600 opacity-20"></i>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border-l-4 border-pink-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">المشاهدات</p>
            <p class="text-3xl font-bold text-surface-900">{{ $views ?? 0 }}</p>
          </div>
          <i data-lucide="eye" class="w-12 h-12 text-pink-600 opacity-20"></i>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-wrap gap-4 mb-8">
      <a href="#" class="px-6 py-3 bg-brand-600 text-white font-bold rounded-lg hover:bg-brand-700 transition flex items-center gap-2">
        <i data-lucide="search" class="w-5 h-5"></i>
        البحث عن وظائف
      </a>
      <a href="#" class="px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">
        تعديل الملف الشخصي
      </a>
    </div>

    <!-- Recent Applications -->
    <div class="bg-white rounded-xl p-6 mb-8">
      <h2 class="text-2xl font-bold text-surface-900 mb-6">آخر التطبيقات</h2>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-surface-50">
            <tr>
              <th class="px-6 py-3 text-right text-sm font-bold text-surface-900">الوظيفة</th>
              <th class="px-6 py-3 text-right text-sm font-bold text-surface-900">الشركة</th>
              <th class="px-6 py-3 text-right text-sm font-bold text-surface-900">الحالة</th>
              <th class="px-6 py-3 text-right text-sm font-bold text-surface-900">التاريخ</th>
            </tr>
          </thead>
          <tbody>
            @forelse($job_seeker->applications()->with('job')->latest()->limit(5)->get() ?? [] as $application)
            <tr class="border-b border-gray-200 hover:bg-surface-50">
              <td class="px-6 py-4 text-sm text-surface-900">{{ $application->job->title ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm text-surface-900">{{ $application->job->company->company_name ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-sm">
                <span class="px-3 py-1 rounded-full text-xs font-bold 
                  {{ match($application->status) {
                    'accepted' => 'bg-green-100 text-green-800',
                    'rejected' => 'bg-red-100 text-red-800',
                    'reviewed' => 'bg-blue-100 text-blue-800',
                    default => 'bg-gray-100 text-gray-800'
                  } }}">
                  {{ $application->status }}
                </span>
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="px-6 py-12 text-center text-gray-600">لم تقدم على أي وظيفة بعد</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection