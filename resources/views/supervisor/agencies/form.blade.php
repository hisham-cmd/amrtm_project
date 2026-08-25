@extends('layouts.dashboard')

@section('title', $agency ? 'تعديل الوكالة' : 'إضافة وكالة')
@section('page-title', 'الوكالات التجارية')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item active"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')
<style>
.frm-section{background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.07);padding:28px;margin-bottom:20px;}
.frm-section h3{font-size:1rem;font-weight:800;color:#0f2d5a;margin:0 0 20px;padding-bottom:12px;border-bottom:2px solid #e2e8f0;}
.frm-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.frm-grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;}
.frm-group{margin-bottom:16px;}
.frm-label{font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;}
.frm-input{width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:'Cairo',sans-serif;font-size:.9rem;box-sizing:border-box;transition:border-color .2s;}
.frm-input:focus{outline:none;border-color:#0d2448;}
.frm-hint{font-size:11px;color:#94a3b8;margin:5px 0 0;}
</style>

<div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
    <a href="{{ route('supervisor.agencies.index') }}" style="color:#64748b;text-decoration:none;font-size:.9rem;"><i class="fas fa-arrow-right"></i> الوكالات</a>
    <span style="color:#cbd5e1;">/</span>
    <span style="font-weight:700;color:#0f2d5a;">{{ $agency ? 'تعديل: '.$agency->name : 'إضافة وكالة جديدة' }}</span>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 18px;margin-bottom:20px;color:#991b1b;">
    <ul style="margin:0;padding-right:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form method="POST" enctype="multipart/form-data"
      action="{{ $agency ? route('supervisor.agencies.update',$agency) : route('supervisor.agencies.store') }}">
    @csrf
    @if($agency) @method('PUT') @endif

    {{-- ── LOGO ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-image"></i> الشعار / الصورة</h3>
        @if($agency && $agency->logo_url)
        <div style="margin-bottom:16px;display:flex;align-items:center;gap:14px;">
            <img src="{{ $agency->logo_url }}" alt="الشعار الحالي" style="width:80px;height:80px;object-fit:contain;border-radius:12px;border:1.5px solid #e2e8f0;background:#f8fafc;padding:4px;">
            <span style="font-size:13px;color:#64748b;">الشعار الحالي</span>
        </div>
        @endif
        <div class="frm-group">
            <label class="frm-label">{{ $agency?->logo ? 'تغيير الشعار (اختياري)' : 'رفع شعار الوكالة' }}</label>
            <input class="frm-input" type="file" name="logo" accept="image/*" style="padding:8px;">
            <p class="frm-hint">PNG أو JPG — الحد الأقصى 4MB</p>
        </div>
    </div>

    {{-- ── BASIC INFO ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-info-circle"></i> المعلومات الأساسية</h3>
        <div class="frm-grid-2">
            <div class="frm-group">
                <label class="frm-label">اسم الوكالة (عربي) *</label>
                <input class="frm-input" type="text" name="name" value="{{ old('name', $agency->name ?? '') }}" required placeholder="شركة سامسونج للإلكترونيات">
            </div>
            <div class="frm-group">
                <label class="frm-label">الاسم (إنجليزي)</label>
                <input class="frm-input" type="text" name="name_en" value="{{ old('name_en', $agency->name_en ?? '') }}" placeholder="Samsung Electronics">
            </div>
        </div>
        <div class="frm-group">
            <label class="frm-label">الوصف (عربي)</label>
            <textarea class="frm-input" name="description" rows="3" placeholder="وصف موجز عن الوكالة...">{{ old('description', $agency->description ?? '') }}</textarea>
        </div>
        <div class="frm-group">
            <label class="frm-label">الوصف (إنجليزي)</label>
            <textarea class="frm-input" name="description_en" rows="2" placeholder="Brief description in English...">{{ old('description_en', $agency->description_en ?? '') }}</textarea>
        </div>
        <div class="frm-grid-3">
            <div class="frm-group">
                <label class="frm-label">الفئة *</label>
                <select class="frm-input" name="category" required>
                    @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ old('category', $agency->category ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="frm-group">
                <label class="frm-label">نوع الوكالة *</label>
                <select class="frm-input" name="agency_type" required>
                    @foreach($agencyTypes as $key => $label)
                    <option value="{{ $key }}" {{ old('agency_type', $agency->agency_type ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="frm-group">
                <label class="frm-label">بلد المنشأ</label>
                <input class="frm-input" type="text" name="country_origin" value="{{ old('country_origin', $agency->country_origin ?? 'السعودية') }}" placeholder="السعودية / كوريا الجنوبية">
            </div>
        </div>
        <div class="frm-grid-3">
            <div class="frm-group">
                <label class="frm-label">الحالة</label>
                <select class="frm-input" name="status">
                    <option value="active"   {{ old('status', $agency->status ?? 'active') === 'active'   ? 'selected' : '' }}>نشط</option>
                    <option value="inactive" {{ old('status', $agency->status ?? '')        === 'inactive' ? 'selected' : '' }}>غير نشط</option>
                    <option value="draft"    {{ old('status', $agency->status ?? '')        === 'draft'    ? 'selected' : '' }}>مسودة</option>
                </select>
            </div>
            <div class="frm-group">
                <label class="frm-label">ترتيب العرض</label>
                <input class="frm-input" type="number" name="sort_order" value="{{ old('sort_order', $agency->sort_order ?? 0) }}" min="0">
            </div>
            <div class="frm-group">
                <label class="frm-label">الحد الأدنى للخبرة (سنوات)</label>
                <input class="frm-input" type="number" name="min_years_experience" value="{{ old('min_years_experience', $agency->min_years_experience ?? 0) }}" min="0">
            </div>
        </div>
        <div style="display:flex;gap:24px;flex-wrap:wrap;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:700;color:#374151;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $agency->is_featured ?? false) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#0d2448;">
                مميز (يظهر في الأعلى)
            </label>
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:700;color:#374151;">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $agency->is_verified ?? true) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#0d2448;">
                موثق (يُعرض شعار التوثيق)
            </label>
        </div>
    </div>

    {{-- ── INVESTMENT ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-coins"></i> التفاصيل الاستثمارية</h3>
        <div class="frm-grid-2">
            <div class="frm-group">
                <label class="frm-label">الحد الأدنى للاستثمار (ريال) *</label>
                <input class="frm-input" type="number" name="investment_min" value="{{ old('investment_min', $agency->investment_min ?? 0) }}" min="0" required>
            </div>
            <div class="frm-group">
                <label class="frm-label">الحد الأقصى للاستثمار (ريال) *</label>
                <input class="frm-input" type="number" name="investment_max" value="{{ old('investment_max', $agency->investment_max ?? 0) }}" min="0" required>
            </div>
        </div>
    </div>

    {{-- ── REGIONS ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-map-marker-alt"></i> المناطق المتاحة</h3>
        <div style="display:flex;flex-wrap:wrap;gap:10px;">
            @foreach(['الرياض','جدة','مكة المكرمة','المدينة المنورة','الدمام','الخبر','الأحساء','تبوك','أبها','جميع المناطق'] as $region)
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                <input type="checkbox" name="available_regions[]" value="{{ $region }}"
                       {{ in_array($region, old('available_regions', $agency->available_regions ?? [])) ? 'checked' : '' }}
                       style="width:16px;height:16px;accent-color:#0d2448;">
                {{ $region }}
            </label>
            @endforeach
        </div>
    </div>

    {{-- ── REQUIREMENTS & BENEFITS ─────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-list-check"></i> المتطلبات والمزايا</h3>
        <div class="frm-grid-2">
            <div class="frm-group">
                <label class="frm-label">متطلبات الوكالة (سطر لكل متطلب)</label>
                <textarea class="frm-input" name="requirements_text" rows="5" placeholder="سجل تجاري سعودي&#10;خبرة في القطاع&#10;رأس مال جاهز">{{ old('requirements_text', implode("\n", $agency->requirements ?? [])) }}</textarea>
                <p class="frm-hint">كل سطر يظهر كـ tag منفصل في الموقع</p>
            </div>
            <div class="frm-group">
                <label class="frm-label">مزايا الوكالة (سطر لكل ميزة)</label>
                <textarea class="frm-input" name="benefits_text" rows="5" placeholder="دعم تسويقي كامل&#10;تدريب مستمر&#10;وكيل حصري في المنطقة">{{ old('benefits_text', implode("\n", $agency->benefits ?? [])) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── SUBMIT ──────────────────────────────────────── --}}
    <div style="display:flex;gap:12px;">
        <button type="submit" style="background:linear-gradient(135deg,#0d2448,#1a4a8a);color:#fff;padding:12px 36px;border-radius:12px;font-size:.95rem;font-weight:800;border:none;cursor:pointer;font-family:'Cairo',sans-serif;">
            <i class="fas fa-save"></i> {{ $agency ? 'حفظ التعديلات' : 'إضافة الوكالة' }}
        </button>
        <a href="{{ route('supervisor.agencies.index') }}" style="background:#f1f5f9;color:#374151;padding:12px 24px;border-radius:12px;font-size:.95rem;font-weight:700;text-decoration:none;">
            إلغاء
        </a>
    </div>
</form>
@endsection
