@extends('layouts.dashboard')

@section('title', 'بيانات البروفايل')
@section('page-title', 'بيانات البروفايل')

@section('sidebar-nav')
    <a href="{{ route('partner.dashboard') }}" class="nav-item">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('partner.profile-setup') }}" class="nav-item active">
        <i class="fas fa-info-circle"></i> بيانات البروفايل
    </a>
    <a href="{{ route('partner.media') }}" class="nav-item">
        <i class="fas fa-images"></i> معرض الصور
    </a>
    <a href="{{ route('partner.services') }}" class="nav-item">
        <i class="fas fa-list-check"></i> خدماتي وأسعاري
    </a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-id-card text-green-600 ml-2"></i> بيانات بروفايل شركتك</h2>
    </div>

    <form method="POST" action="{{ route('partner.profile-setup.save') }}" enctype="multipart/form-data" class="p-5">
        @csrf

        <div class="form-grid">

            {{-- اسم الشركة --}}
            <div class="form-group col-span-2">
                <label class="form-label">اسم الشركة / المنشأة <span class="text-red-500">*</span></label>
                <input type="text" name="company_name" value="{{ old('company_name', $profile?->company_name) }}"
                       class="form-input @error('company_name') border-red-500 @enderror" required>
                @error('company_name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- التصنيف --}}
            <div class="form-group">
                <label class="form-label">تصنيف الخدمة</label>
                <select name="category_id" class="form-input">
                    <option value="">— اختر التصنيف —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $profile?->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- المدينة --}}
            <div class="form-group">
                <label class="form-label">المدينة <span class="text-red-500">*</span></label>
                <input type="text" name="city" value="{{ old('city', $profile?->city) }}"
                       class="form-input @error('city') border-red-500 @enderror" required>
                @error('city')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- الشارع / الحي --}}
            <div class="form-group col-span-2">
                <label class="form-label">الشارع / الحي</label>
                <input type="text" name="address" value="{{ old('address', $profile?->address) }}"
                       class="form-input">
            </div>

            {{-- الوصف --}}
            <div class="form-group col-span-2">
                <label class="form-label">وصف الشركة / الخدمة</label>
                <textarea name="description" rows="4" class="form-input">{{ old('description', $profile?->description) }}</textarea>
                @error('description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- الهاتف --}}
            <div class="form-group">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone', $profile?->phone) }}" class="form-input">
            </div>

            {{-- واتساب --}}
            <div class="form-group">
                <label class="form-label">واتساب</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $profile?->whatsapp) }}" class="form-input">
            </div>

            {{-- الموقع الإلكتروني --}}
            <div class="form-group col-span-2">
                <label class="form-label">الموقع الإلكتروني</label>
                <input type="url" name="website" value="{{ old('website', $profile?->website) }}" class="form-input" placeholder="https://example.com">
                @error('website')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- الشعار --}}
            <div class="form-group">
                <label class="form-label">الشعار (Logo)</label>
                @if($profile?->logo_url)
                <img src="{{ $profile->logo_url }}" alt="logo" class="w-20 h-20 rounded-full object-cover border mb-2">
                @endif
                <input type="file" name="logo" accept="image/*" class="form-input">
                @error('logo')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- صورة الغلاف --}}
            <div class="form-group">
                <label class="form-label">صورة الغلاف (Cover)</label>
                @if($profile?->cover_url)
                <img src="{{ $profile->cover_url }}" alt="cover" class="w-full h-24 object-cover rounded-lg border mb-2">
                @endif
                <input type="file" name="cover" accept="image/*" class="form-input">
                @error('cover')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> حفظ البيانات
            </button>
            <a href="{{ route('partner.dashboard') }}" class="btn-secondary">إلغاء</a>
        </div>

    </form>
</div>

@endsection
