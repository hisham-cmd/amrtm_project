@extends('layouts.dashboard')

@section('title', 'إدارة الشركاء')
@section('page-title', 'إدارة الشركاء')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item active"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

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

{{-- SECTION 1 — CATEGORIES --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-tags"></i> إدارة تصنيفات الخدمات</span>
        <span class="badge badge-navy">{{ $categories->count() }} تصنيف</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('supervisor.partner-categories.save') }}"
              style="display:flex; gap:12px; align-items:flex-end; margin-bottom:20px; flex-wrap:wrap;">
            @csrf
            <div style="flex:1; min-width:220px;">
                <label class="form-label">اسم التصنيف الجديد <span style="color:#e53e3e;">*</span></label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}" placeholder="مثال: مصممو جرافك" required>
                @error('name')<div style="font-size:.78rem;color:#e53e3e;margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="white-space:nowrap;">
                    <i class="fas fa-plus"></i> إضافة تصنيف
                </button>
            </div>
        </form>

        @if($categories->isNotEmpty())
        <div style="display:flex; flex-wrap:wrap; gap:10px;">
            @foreach($categories as $cat)
            <div style="display:inline-flex; align-items:center; gap:8px; background:var(--navy-pale);
                        border:1.5px solid rgba(13,36,72,.15); border-radius:30px; padding:6px 14px 6px 10px;
                        font-family:'Cairo',sans-serif;">
                <span style="font-size:.88rem; font-weight:700; color:var(--navy);">{{ $cat->name }}</span>
                <span class="badge badge-navy" style="font-size:.72rem;">{{ $cat->partners_count }}</span>
                <form method="POST" action="{{ route('supervisor.partner-categories.delete', $cat->id) }}"
                      onsubmit="return confirm('سيتم حذف هذا التصنيف وجميع شركائه. متأكد؟');" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;cursor:pointer;color:#e53e3e;font-size:.8rem;padding:0;" title="حذف">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center; padding:20px; color:#9ca3af; font-size:.88rem;">
            لا يوجد تصنيفات بعد — أضف تصنيفاً ثم أضف شركاء تحته.
        </div>
        @endif
    </div>
</div>

{{-- SECTION 2 — ADD PARTNER --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-plus-circle"></i> إضافة شريك / شركة</span>
    </div>
    <div class="card-body">
        @if($categories->isEmpty())
        <div style="background:#fffbeb; border:1.5px solid #fcd34d; border-radius:10px; padding:12px 16px; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-info-circle" style="color:#d97706;"></i>
            <span style="font-size:.84rem; color:#92400e;">يجب إضافة تصنيف أولاً قبل إضافة الشركاء.</span>
        </div>
        @else
        <form method="POST" action="{{ route('supervisor.partners.save') }}" enctype="multipart/form-data">
            @csrf
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:18px; align-items:end;">
                <div>
                    <label class="form-label">التصنيف <span style="color:#e53e3e;">*</span></label>
                    <select name="category_id" class="form-control" required style="font-family:'Cairo',sans-serif;">
                        <option value="" disabled selected>اختر التصنيف</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">اسم الشركة / الشريك <span style="color:#e53e3e;">*</span></label>
                    <input type="text" name="company_name" class="form-control"
                           value="{{ old('company_name') }}" placeholder="مثال: استوديو الإبداع" required>
                </div>
                <div>
                    <label class="form-label">وصف الخدمة (اختياري)</label>
                    <input type="text" name="description" class="form-control"
                           value="{{ old('description') }}" placeholder="مثال: تصوير وتوثيق المناسبات بأعلى جودة">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label class="form-label">رقم الهاتف (اختياري)</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone') }}" placeholder="05xxxxxxxx">
                    </div>
                    <div>
                        <label class="form-label">واتساب (اختياري)</label>
                        <input type="text" name="whatsapp" class="form-control"
                               value="{{ old('whatsapp') }}" placeholder="05xxxxxxxx">
                    </div>
                </div>
                <div>
                    <label class="form-label">الشعار (اختياري)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*" id="logoInput">
                    <div style="font-size:.76rem; color:#6c7a72; margin-top:4px;">PNG/JPG — بحد أقصى 2 ميجابايت</div>
                </div>
            </div>
            <div id="logoPreview" style="display:none; margin-top:14px;">
                <img id="previewImg" src="" alt="معاينة" style="height:60px; border-radius:8px; border:1px solid #e5e7eb; padding:4px;">
            </div>
            <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> إضافة الشريك</button>
            </div>
        </form>
        @endif
    </div>
</div>

{{-- SECTION 3 — PARTNERS LIST --}}
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-handshake"></i> الشركاء الحاليون</span>
        <span style="font-size:.82rem; color:#6c7a72;">{{ $partners->count() }} شريك</span>
    </div>
    <div class="card-body">
        <div style="background:#fffbeb; border:1.5px solid #fcd34d; border-radius:10px; padding:12px 16px; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
            <i class="fas fa-info-circle" style="color:#d97706;"></i>
            <div style="font-size:.82rem; color:#92400e;">
                <strong>ملاحظة:</strong> الشركاء المضافون هنا سيظهرون في صفحة قائمة القاعات للجميع
            </div>
        </div>

        @forelse($partners->groupBy(fn($p) => $p->category?->name ?? 'بدون تصنيف') as $catName => $catPartners)

        <div style="display:flex; align-items:center; gap:10px; margin:20px 0 10px; padding-bottom:8px; border-bottom:2px solid var(--navy-pale);">
            <span class="badge badge-navy" style="font-size:.78rem; border-radius:20px; padding:3px 12px;">{{ $catName }}</span>
            <span style="font-size:.8rem; color:var(--text-muted);">{{ $catPartners->count() }} شركة</span>
        </div>

        @foreach($catPartners as $partner)
        <div style="display:flex; align-items:center; gap:16px; padding:12px 0; border-bottom:1px solid #f0f4f2;">
            @if($partner->logo_path)
                <img src="{{ $partner->logo_url }}" alt="{{ $partner->company_name }}"
                     style="width:80px; height:50px; object-fit:contain; border-radius:8px; border:1px solid #e5e7eb; padding:4px; background:#fff;">
            @else
                <div style="width:80px; height:50px; display:flex; align-items:center; justify-content:center;
                            background:#f8faf9; border-radius:8px; border:1px solid #e5e7eb;
                            font-size:.7rem; color:#6c7a72; font-weight:700; text-align:center; padding:4px;">
                    {{ Str::limit($partner->company_name, 20) }}
                </div>
            @endif
            <div style="flex:1; font-weight:700; color:var(--text-dark); font-size:.95rem;">
                {{ $partner->company_name }}
                @if($partner->logo_path)
                    <span style="font-size:.75rem; color:#6c7a72; margin-right:6px;"><i class="fas fa-image"></i> يوجد شعار</span>
                @endif
            </div>
            <form method="POST" action="{{ route('supervisor.partners.delete', $partner->id) }}"
                  onsubmit="return confirm('هل أنت متأكد من حذف هذا الشريك؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn action-btn-danger" title="حذف">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
        @endforeach

        @empty
        <div style="text-align:center; padding:30px 0; color:#9ca3af;">
            <i class="fas fa-handshake" style="font-size:2rem; opacity:.3; display:block; margin-bottom:10px;"></i>
            لا يوجد شركاء مضافون بعد
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('logoInput')?.addEventListener('change', function () {
        const preview = document.getElementById('logoPreview');
        const img     = document.getElementById('previewImg');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
            reader.readAsDataURL(this.files[0]);
        } else { preview.style.display = 'none'; }
    });
</script>
@endpush

@endsection
