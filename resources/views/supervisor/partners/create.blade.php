@extends('layouts.dashboard')

@section('title', 'إنشاء شريك جديد')
@section('page-title', 'إنشاء شريك جديد')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item active"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-user-plus text-green-600 ml-2"></i> بيانات الشريك الجديد</h2>
        <a href="{{ route($routePrefix . '.index') }}" class="btn-secondary btn-sm">
            <i class="fas fa-arrow-right"></i> رجوع
        </a>
    </div>

    <form method="POST" action="{{ route($routePrefix . '.store') }}" class="p-5">
        @csrf

        <h3 class="text-sm font-extrabold text-[#1a5c38] mb-3 pb-2 border-b border-gray-100">
            <i class="fas fa-user ml-1"></i> بيانات حساب الدخول
        </h3>
        <div class="form-grid mb-5">
            <div class="form-group">
                <label class="form-label">الاسم الكامل <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-input @error('email') border-red-500 @enderror" required>
                @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">رقم الجوال <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="form-input @error('phone') border-red-500 @enderror" required>
                @error('phone')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">كلمة المرور <span class="text-red-500">*</span></label>
                <input type="password" name="password"
                       class="form-input @error('password') border-red-500 @enderror" required minlength="8">
                @error('password')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <h3 class="text-sm font-extrabold text-[#1a5c38] mb-3 pb-2 border-b border-gray-100">
            <i class="fas fa-building ml-1"></i> بيانات الشركة / المنشأة
        </h3>
        <div class="form-grid">
            <div class="form-group col-span-2">
                <label class="form-label">اسم الشركة <span class="text-red-500">*</span></label>
                <input type="text" name="company_name" value="{{ old('company_name') }}"
                       class="form-input @error('company_name') border-red-500 @enderror" required>
                @error('company_name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">التصنيف</label>
                <select name="category_id" class="form-input">
                    <option value="">— اختر التصنيف —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">المدينة <span class="text-red-500">*</span></label>
                <input type="text" name="city" value="{{ old('city') }}"
                       class="form-input @error('city') border-red-500 @enderror" required>
                @error('city')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="form-group col-span-2">
                <label class="form-label">الشارع / الحي</label>
                <input type="text" name="address" value="{{ old('address') }}" class="form-input">
            </div>
            <div class="form-group col-span-2">
                <label class="form-label">وصف الخدمة</label>
                <textarea name="description" rows="3" class="form-input">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">هاتف الشركة</label>
                <input type="text" name="phone_biz" value="{{ old('phone_biz') }}" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">واتساب</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="form-input">
            </div>
            <div class="form-group col-span-2">
                <label class="form-label">الموقع الإلكتروني</label>
                <input type="url" name="website" value="{{ old('website') }}" class="form-input" placeholder="https://example.com">
                @error('website')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="btn-primary">
                <i class="fas fa-plus-circle"></i> إنشاء حساب الشريك
            </button>
            <a href="{{ route($routePrefix . '.index') }}" class="btn-secondary">إلغاء</a>
        </div>
    </form>
</div>

@endsection
