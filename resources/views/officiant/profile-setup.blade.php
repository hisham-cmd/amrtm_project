@extends('layouts.dashboard')

@section('title', 'بيانات البروفايل — المأذون الشرعي')
@section('page-title', 'بيانات البروفايل')

@section('sidebar-nav')
    <a href="{{ route('officiant.dashboard') }}" class="nav-item {{ request()->routeIs('officiant.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('officiant.profile-setup') }}" class="nav-item active">
        <i class="fas fa-info-circle"></i> بيانات البروفايل
    </a>
    <a href="{{ route('officiant.media') }}" class="nav-item">
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

<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-id-card text-green-600 ml-2"></i> تعديل بيانات البروفايل</h2>
    </div>
    <form method="POST" action="{{ route('officiant.profile-setup.save') }}" enctype="multipart/form-data" class="p-5">
        @csrf

        <div class="form-grid">

            {{-- Profile photo --}}
            <div class="form-group col-span-2" style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
                @if($profile?->profile_photo_url)
                <img src="{{ $profile->profile_photo_url }}" alt="صورة البروفايل"
                     style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:2px solid #eef2ef;">
                @else
                <div style="width:80px; height:80px; border-radius:50%; background:#e8f5ee; display:flex; align-items:center; justify-content:center; font-size:2rem; color:#1a5c38;">
                    <i class="fas fa-user-circle"></i>
                </div>
                @endif
                <div>
                    <label class="form-label">صورة البروفايل</label>
                    <input type="file" name="profile_photo" accept="image/*" class="form-input @error('profile_photo') border-red-500 @enderror">
                    @error('profile_photo')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Cover photo --}}
            <div class="form-group col-span-2">
                <label class="form-label"><i class="fas fa-image" style="color:#1a5c38;margin-left:6px;"></i> صورة الخلفية (باكجراوند البروفايل)</label>
                @if($profile?->cover_photo)
                <div style="margin-bottom:10px;border-radius:12px;overflow:hidden;max-height:140px;">
                    <img src="{{ route('public.storage', ['path' => $profile->cover_photo]) }}"
                         alt="صورة الخلفية" style="width:100%;object-fit:cover;max-height:140px;display:block;">
                </div>
                @endif
                <input type="file" name="cover_photo" accept="image/*"
                       class="form-input @error('cover_photo') border-red-500 @enderror">
                <p style="font-size:12px;color:#6b7280;margin-top:4px;">يُفضّل صورة عرضية بأبعاد 1200×400 بكسل — حجم أقصى 4MB</p>
                @error('cover_photo')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- License number --}}
            <div class="form-group">
                <label class="form-label">رقم الرخصة <span class="text-red-500">*</span></label>
                <input type="text" name="license_number" value="{{ old('license_number', $profile?->license_number) }}"
                       class="form-input @error('license_number') border-red-500 @enderror" required>
                @error('license_number')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Working hours --}}
            <div class="form-group">
                <label class="form-label">ساعات التوفر</label>
                <input type="text" name="working_hours" value="{{ old('working_hours', $profile?->working_hours) }}"
                       class="form-input" placeholder="مثال: 8ص – 6م">
            </div>

            {{-- Phone --}}
            <div class="form-group">
                <label class="form-label">رقم الجوال</label>
                <input type="text" name="phone" value="{{ old('phone', $profile?->phone) }}" class="form-input">
            </div>

            {{-- Country --}}
            <div class="form-group">
                <label class="form-label">الدولة</label>
                <input type="text" name="country" value="{{ old('country', $profile?->country) }}" class="form-input" placeholder="مثال: المملكة العربية السعودية">
            </div>

            {{-- City --}}
            <div class="form-group">
                <label class="form-label">المدينة</label>
                <input type="text" name="city" value="{{ old('city', $profile?->city) }}" class="form-input">
            </div>

            {{-- Neighborhood --}}
            <div class="form-group">
                <label class="form-label">الحي</label>
                <input type="text" name="neighborhood" value="{{ old('neighborhood', $profile?->neighborhood) }}" class="form-input" placeholder="مثال: حي النزهة">
            </div>

            {{-- Street --}}
            <div class="form-group">
                <label class="form-label">الشارع</label>
                <input type="text" name="street" value="{{ old('street', $profile?->street) }}" class="form-input" placeholder="مثال: شارع الملك عبدالله">
            </div>

            {{-- National Address --}}
            <div class="form-group col-span-2">
                <label class="form-label">العنوان الوطني</label>
                <input type="text" name="address" value="{{ old('address', $profile?->address) }}" class="form-input" placeholder="مثال: AAAA1234">
            </div>

            {{-- Bio --}}
            <div class="form-group col-span-2">
                <label class="form-label">نبذة عنك</label>
                <textarea name="bio" rows="3" class="form-input" placeholder="اكتب نبذة مختصرة عن خدماتك وخبراتك...">{{ old('bio', $profile?->bio) }}</textarea>
            </div>

            {{-- Bank account --}}
            <div class="form-group">
                <label class="form-label">رقم الحساب البنكي</label>
                <input type="text" name="bank_account" value="{{ old('bank_account', $profile?->bank_account) }}" class="form-input">
            </div>

            {{-- IBAN --}}
            <div class="form-group">
                <label class="form-label">رقم الآيبان (IBAN)</label>
                <input type="text" name="iban" value="{{ old('iban', $profile?->iban) }}" class="form-input" placeholder="SA...">
            </div>

        </div>

        <div style="margin-top:24px; display:flex; gap:12px;">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> حفظ البيانات
            </button>
            <a href="{{ route('officiant.dashboard') }}" class="btn btn-outline">إلغاء</a>
        </div>
    </form>
</div>

@endsection
