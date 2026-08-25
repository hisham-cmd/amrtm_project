@extends('layouts.dashboard')

@section('title', 'شركاء القاعة')
@section('page-title', 'شركاء القاعة')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}"      class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}"       class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}"           class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}"        class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.busy-dates') }}"      class="nav-item"><i class="fas fa-calendar-times"></i> الأيام المشغولة</a>
    <a href="{{ route('owner.bookings') }}"        class="nav-item"><i class="fas fa-calendar-check"></i> الحجوزات</a>
    <a href="{{ route('owner.documents') }}"       class="nav-item"><i class="fas fa-file-alt"></i> وثائق التوثيق</a>
    <a href="{{ route('owner.partners') }}"        class="nav-item active"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@unless($hall)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        يجب إنشاء القاعة أولاً. <a href="{{ route('owner.hall-info') }}" style="font-weight:700;">أنشئ القاعة ←</a>
    </div>
@else

{{-- ── Success / Error alerts ───────────────────────────────────────────── --}}
@if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" style="margin-bottom:20px;">
        <i class="fas fa-exclamation-circle"></i>
        {{ $errors->first() }}
    </div>
@endif

{{-- ── Add partner form ─────────────────────────────────────────────────── --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-plus-circle"></i> إضافة شريك جديد</span>
    </div>
    <div class="card-body">
        <form method="POST"
              action="{{ route('owner.partners.save') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group" style="margin-bottom:18px;">
                <label class="form-label">اسم الشركة / الشريك <span style="color:#e53e3e;">*</span></label>
                <input type="text"
                       name="company_name"
                       class="form-control"
                       value="{{ old('company_name') }}"
                       placeholder="مثال: Queen for Dresses"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">الشعار (اختياري)</label>
                <input type="file"
                       name="logo"
                       class="form-control"
                       accept="image/*"
                       id="logoInput">
                <div style="font-size:.78rem; color:#6c7a72; margin-top:6px;">
                    PNG أو JPG — بحد أقصى 2 ميجابايت. إذا لم يُرفع شعار سيظهر الاسم فقط.
                </div>
            </div>

            {{-- Logo preview --}}
            <div id="logoPreview" style="display:none; margin-top:14px; padding:12px; background:#f8faf9; border-radius:8px; border:1px solid #e5e7eb;">
                <div style="font-size:.82rem; color:#6c7a72; margin-bottom:8px; font-weight:600;">
                    <i class="fas fa-eye"></i> معاينة الشعار:
                </div>
                <img id="previewImg" src="" alt="معاينة"
                     style="height:70px; border-radius:8px; border:1px solid #d1e8d8; padding:6px; background:#fff;">
            </div>

            <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> إضافة الشريك
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ── Partners list ───────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-handshake"></i> الشركاء الحاليون</span>
        <span style="font-size:.82rem; color:#6c7a72;">{{ $partners->count() }} شريك</span>
    </div>
    <div class="card-body">

        @forelse($partners as $partner)
        <div style="display:flex; align-items:center; gap:16px; padding:14px 0;
                    border-bottom:1px solid #f0f4f2;">

            {{-- Logo or placeholder --}}
            @if($partner->logo_path)
                <img src="{{ $partner->logo_url }}"
                     alt="{{ $partner->company_name }}"
                     style="width:80px; height:50px; object-fit:contain;
                            border-radius:8px; border:1px solid #e5e7eb; padding:4px; background:#fff;">
            @else
                <div style="width:80px; height:50px; display:flex; align-items:center; justify-content:center;
                            background:#f8faf9; border-radius:8px; border:1px solid #e5e7eb;
                            font-size:.7rem; color:#6c7a72; font-weight:700; text-align:center; padding:4px;">
                    {{ Str::limit($partner->company_name, 20) }}
                </div>
            @endif

            {{-- Name --}}
            <div style="flex:1; font-weight:700; color:#0f3d24; font-size:.95rem;">
                {{ $partner->company_name }}
                @if($partner->logo_path)
                    <span style="font-size:.75rem; color:#6c7a72; font-weight:500; margin-right:6px;">
                        <i class="fas fa-image"></i> يوجد شعار
                    </span>
                @else
                    <span style="font-size:.75rem; color:#9ca3af; font-weight:500; margin-right:6px;">
                        اسم فقط
                    </span>
                @endif
            </div>

            {{-- Delete --}}
            <form method="POST"
                  action="{{ route('owner.partners.delete', $partner->id) }}"
                  onsubmit="return confirm('هل أنت متأكد من حذف هذا الشريك؟')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        style="background:#fff0f0; color:#e53e3e; border:1px solid #fecaca;
                               border-radius:8px; padding:7px 14px; cursor:pointer; font-size:.82rem; font-weight:700;">
                    <i class="fas fa-trash"></i> حذف
                </button>
            </form>

        </div>
        @empty
        <div style="text-align:center; padding:30px 0; color:#9ca3af;">
            <i class="fas fa-handshake" style="font-size:2rem; opacity:.3; display:block; margin-bottom:10px;"></i>
            لا يوجد شركاء مضافون بعد
        </div>
        @endforelse

    </div>
</div>

@endunless

@push('scripts')
<script>
    document.getElementById('logoInput')?.addEventListener('change', function () {
        const preview = document.getElementById('logoPreview');
        const img     = document.getElementById('previewImg');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endpush

@endsection
