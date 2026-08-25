@extends('layouts.dashboard')

@section('title', 'معرض الصور — المأذون الشرعي')
@section('page-title', 'معرض الصور')

@section('sidebar-nav')
    <a href="{{ route('officiant.dashboard') }}" class="nav-item">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('officiant.profile-setup') }}" class="nav-item">
        <i class="fas fa-info-circle"></i> بيانات البروفايل
    </a>
    <a href="{{ route('officiant.media') }}" class="nav-item active">
        <i class="fas fa-images"></i> معرض الصور
    </a>
    <a href="{{ route('officiant.services') }}" class="nav-item">
        <i class="fas fa-list-check"></i> خدماتي وأسعاري
    </a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

{{-- Upload form --}}
<div class="section-card mb-5">
    <div class="section-header">
        <h2><i class="fas fa-upload text-green-600 ml-2"></i> رفع صور جديدة</h2>
    </div>
    <form method="POST" action="{{ route('officiant.media.upload') }}" enctype="multipart/form-data" class="p-5">
        @csrf
        <div class="form-group">
            <label class="form-label">اختر الصور (حتى 10 صور)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="form-input @error('images') border-red-500 @enderror">
            @error('images')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="btn-primary mt-3">
            <i class="fas fa-upload"></i> رفع الصور
        </button>
    </form>
</div>

{{-- Gallery grid --}}
<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-images text-green-600 ml-2"></i> الصور الحالية ({{ $media->count() }})</h2>
    </div>
    <div class="p-5">
        @if($media->isEmpty())
        <div class="text-center py-10 text-gray-400">
            <i class="fas fa-images text-5xl opacity-20 block mb-3"></i>
            لا توجد صور بعد
        </div>
        @else
        <div class="grid gap-4" style="grid-template-columns: repeat(auto-fill, minmax(160px, 1fr))">
            @foreach($media as $img)
            <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                <img src="{{ route('public.storage', ['path' => $img->file_path]) }}" alt="صورة" class="w-full h-36 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <form method="POST" action="{{ route('officiant.media.delete', $img->id) }}"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الصورة؟')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 rounded-full w-10 h-10 flex items-center justify-center transition">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
