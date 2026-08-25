@extends('jobs.layouts.app')

@section('title', $job->title)

@section('content')
<div class="min-h-screen bg-surface-50 py-12">
  <div class="max-w-4xl mx-auto px-6">
    <div class="bg-white rounded-xl p-8 shadow-lg">
      <div class="flex items-start justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-surface-900">{{ $job->title }}</h1>
          <p class="text-surface-600 mt-1">{{ $job->company->company_name ?? '' }}</p>
        </div>
        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-sm font-bold rounded-full">{{ $job->status === 'active' ? 'نشطة' : $job->status }}</span>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-sm text-surface-700">
        <div><i class="fa fa-location-dot ml-1"></i>{{ $job->location }}</div>
        <div><i class="fa fa-briefcase ml-1"></i>{{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</div>
        <div><i class="fa fa-chart-bar ml-1"></i>{{ ucfirst($job->experience_level) }}</div>
        @if($job->salary_min || $job->salary_max)
        <div><i class="fa fa-money-bill ml-1"></i>{{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} ر.س</div>
        @endif
      </div>

      <div class="prose max-w-none text-surface-800 mb-8">
        <h2 class="text-lg font-bold mb-2">وصف الوظيفة</h2>
        <p class="leading-relaxed">{{ $job->description }}</p>
      </div>

      @auth('jobs')
      <a href="{{ route('jobs.listings.store') }}" class="inline-block px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition">
        تقدم للوظيفة
      </a>
      @else
      <a href="{{ route('jobs.login') }}" class="inline-block px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition">
        سجل دخولك للتقديم
      </a>
      @endauth
    </div>
  </div>
</div>
@endsection
