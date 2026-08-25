@extends('jobs.layouts.app')

@section('title', 'تعديل الوظيفة: ' . $job->title)

@section('content')
<div class="min-h-screen bg-surface-50 py-12">
  <div class="max-w-4xl mx-auto px-6">
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-surface-900">تعديل الوظيفة</h1>
      <p class="text-surface-600 mt-2">{{ $job->title }}</p>
    </div>

    <form action="{{ route('jobs.listings.update', $job) }}" method="POST" class="bg-white rounded-xl p-8 shadow-lg">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">المسمى الوظيفي <span class="text-red-600">*</span></label>
          <input type="text" name="title" value="{{ old('title', $job->title) }}"
                 class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600" required>
        </div>
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">نوع الوظيفة <span class="text-red-600">*</span></label>
          <select name="job_main_type" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600" required>
            <option value="leadership" {{ $job->job_main_type === 'leadership' ? 'selected' : '' }}>وظائف قيادية</option>
            <option value="professional" {{ $job->job_main_type === 'professional' ? 'selected' : '' }}>وظائف مهنية</option>
            <option value="administrative" {{ $job->job_main_type === 'administrative' ? 'selected' : '' }}>وظائف إدارية</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">الموقع <span class="text-red-600">*</span></label>
          <input type="text" name="location" value="{{ old('location', $job->location) }}"
                 class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600" required>
        </div>
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">نوع الدوام <span class="text-red-600">*</span></label>
          <select name="job_type" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600" required>
            <option value="full_time" {{ $job->job_type === 'full_time' ? 'selected' : '' }}>دوام كامل</option>
            <option value="part_time" {{ $job->job_type === 'part_time' ? 'selected' : '' }}>دوام جزئي</option>
            <option value="remote" {{ $job->job_type === 'remote' ? 'selected' : '' }}>عن بُعد</option>
            <option value="freelance" {{ $job->job_type === 'freelance' ? 'selected' : '' }}>مستقل</option>
          </select>
        </div>
      </div>

      <div class="mb-6">
        <label class="block text-sm font-bold text-surface-900 mb-2">وصف الوظيفة <span class="text-red-600">*</span></label>
        <textarea name="description" rows="6"
                  class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600" required>{{ old('description', $job->description) }}</textarea>
      </div>

      <div class="flex gap-4">
        <button type="submit" class="px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition">
          حفظ التعديلات
        </button>
        <a href="{{ route('jobs.company.dashboard') }}" class="px-6 py-3 bg-surface-100 text-surface-700 font-bold rounded-xl hover:bg-surface-200 transition">
          إلغاء
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
