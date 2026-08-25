@extends('layouts.dashboard')

@section('title', 'خدماتي وأسعاري — المأذون الشرعي')
@section('page-title', 'خدماتي وأسعاري')

@section('sidebar-nav')
    <a href="{{ route('officiant.dashboard') }}" class="nav-item">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('officiant.profile-setup') }}" class="nav-item">
        <i class="fas fa-info-circle"></i> بيانات البروفايل
    </a>
    <a href="{{ route('officiant.media') }}" class="nav-item">
        <i class="fas fa-images"></i> معرض الصور
    </a>
    <a href="{{ route('officiant.services') }}" class="nav-item active">
        <i class="fas fa-list-check"></i> خدماتي وأسعاري
    </a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

{{-- Add service form --}}
<div class="section-card mb-5">
    <div class="section-header">
        <h2><i class="fas fa-plus text-green-600 ml-2"></i> إضافة خدمة جديدة</h2>
    </div>
    <form method="POST" action="{{ route('officiant.services.store') }}" class="p-5">
        @csrf
        <div class="form-grid">
            <div class="form-group col-span-2">
                <label class="form-label">اسم الخدمة <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="form-input @error('title') border-red-500 @enderror" required placeholder="مثال: إتمام عقد الزواج">
                @error('title')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">السعر</label>
                <input type="text" name="price" value="{{ old('price') }}" class="form-input" placeholder="مثال: 500 ريال">
            </div>
            <div class="form-group col-span-2">
                <label class="form-label">وصف الخدمة</label>
                <textarea name="description" rows="3" class="form-input" placeholder="تفاصيل إضافية عن الخدمة...">{{ old('description') }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn-primary mt-3">
            <i class="fas fa-plus"></i> إضافة الخدمة
        </button>
    </form>
</div>

{{-- Services list --}}
<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-list-check text-green-600 ml-2"></i> الخدمات الحالية ({{ $services->count() }})</h2>
    </div>
    <div class="p-5">
        @if($services->isEmpty())
        <div class="text-center py-10 text-gray-400">
            <i class="fas fa-list text-5xl opacity-20 block mb-3"></i>
            لا توجد خدمات مضافة بعد
        </div>
        @else
        <div class="flex flex-col gap-3">
            @foreach($services as $svc)
            <div class="flex items-start gap-4 p-4 bg-[#f8fdf9] rounded-xl border border-[#e2ede7]">
                <div class="flex-1">
                    <div class="font-extrabold text-[#0f3d24] text-sm">{{ $svc->title }}</div>
                    @if($svc->description)
                    <p class="text-xs text-gray-500 mt-1">{{ $svc->description }}</p>
                    @endif
                </div>
                @if($svc->price)
                <span class="bg-[#1a5c38] text-white text-xs font-bold px-3 py-1 rounded-full shrink-0">
                    {{ $svc->price }}
                </span>
                @endif
                <form method="POST" action="{{ route('officiant.services.delete', $svc->id) }}"
                      onsubmit="return confirm('حذف هذه الخدمة؟')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm transition shrink-0">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
