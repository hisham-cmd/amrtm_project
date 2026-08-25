@extends('layouts.dashboard')

@section('title', isset($slider) ? 'تعديل صورة السلايدر' : 'إضافة صورة سلايدر')
@section('page-title', 'السلايدر')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item active"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger" style="margin-bottom:20px;">
    <strong><i class="fas fa-triangle-exclamation"></i> يرجى تصحيح الأخطاء التالية:</strong>
    <ul style="margin-top:6px;padding-right:18px;margin-bottom:0;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:20px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

{{-- Breadcrumb --}}
<div style="display:flex;align-items:center;gap:10px;margin-bottom:22px;font-size:.88rem;">
    <a href="{{ route('supervisor.sliders.index') }}" style="color:var(--text-muted);text-decoration:none;display:flex;align-items:center;gap:5px;">
        <i class="fas fa-arrow-right"></i> السلايدر
    </a>
    <i class="fas fa-chevron-left" style="font-size:.65rem;color:#cbd5e1;"></i>
    <span style="font-weight:700;color:var(--text-dark);">{{ isset($slider) ? 'تعديل الصورة' : 'إضافة صورة جديدة' }}</span>
</div>

<div style="max-width:700px;">
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-images"></i> {{ isset($slider) ? 'تعديل صورة السلايدر' : 'إضافة صورة جديدة' }}</span>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data"
              action="{{ isset($slider) ? route('supervisor.sliders.update',$slider) : route('supervisor.sliders.store') }}">
            @csrf
            @if(isset($slider)) @method('PUT') @endif

            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">العنوان</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title ?? '') }}" placeholder="عنوان الصورة">
                </div>
                <div class="form-group">
                    <label class="form-label">العنوان الفرعي</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slider->subtitle ?? '') }}" placeholder="نص تحت العنوان">
                </div>
            </div>

            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">رابط الزر</label>
                    <input type="text" name="link_url" class="form-control" value="{{ old('link_url', $slider->link_url ?? '') }}" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label class="form-label">نص الزر</label>
                    <input type="text" name="link_text" class="form-control" value="{{ old('link_text', $slider->link_text ?? 'اكتشف المزيد') }}" placeholder="اكتشف المزيد">
                </div>
            </div>

            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">ترتيب العرض</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slider->sort_order ?? 0) }}" min="0">
                    <div class="form-hint">الرقم الأصغر يظهر أولاً في السلايدر</div>
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:12px;padding-top:28px;">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}
                           style="width:18px;height:18px;accent-color:var(--navy);cursor:pointer;flex-shrink:0;">
                    <label for="is_active" class="form-label" style="margin:0;cursor:pointer;">نشطة (تظهر على الموقع)</label>
                </div>
            </div>

            {{-- Image upload --}}
            <div class="form-group">
                <label class="form-label">
                    صورة السلايدر {{ isset($slider) ? '— اتركها فارغة للإبقاء على الحالية' : '<span style="color:var(--danger)">*</span>' }}
                </label>

                @if(isset($slider) && $slider->image_url)
                <div style="margin-bottom:14px;border-radius:14px;overflow:hidden;border:2px solid var(--navy-pale);max-height:220px;">
                    <img src="{{ $slider->image_url }}" id="imgPreview" style="width:100%;max-height:220px;object-fit:cover;display:block;">
                </div>
                @else
                <div style="margin-bottom:10px;">
                    <img id="imgPreview" style="width:100%;max-height:220px;object-fit:cover;border-radius:14px;border:2px solid var(--navy-pale);display:none;">
                </div>
                @endif

                <div style="border:2px dashed #dde4ef;border-radius:12px;padding:20px;text-align:center;cursor:pointer;transition:border-color .2s;"
                     onclick="document.getElementById('imgInput').click()"
                     onmouseover="this.style.borderColor='var(--navy)'"
                     onmouseout="this.style.borderColor='#dde4ef'">
                    <i class="fas fa-cloud-upload-alt" style="font-size:1.8rem;color:var(--navy);margin-bottom:8px;display:block;"></i>
                    <div style="font-weight:700;color:var(--text-dark);font-size:.9rem;">اضغط لاختيار صورة</div>
                    <div class="form-hint" style="margin-top:4px;">الحجم الموصى به: 1440×500 بكسل — بحد أقصى 4 ميجابايت</div>
                    <input type="file" name="image" accept="image/*" id="imgInput" style="display:none;" onchange="previewImg(this)">
                </div>
            </div>

            <div style="display:flex;gap:12px;margin-top:8px;">
                <button type="submit" class="btn btn-primary" style="padding:12px 32px;">
                    <i class="fas fa-save"></i> {{ isset($slider) ? 'حفظ التعديلات' : 'إضافة الصورة' }}
                </button>
                <a href="{{ route('supervisor.sliders.index') }}" class="btn btn-light">إلغاء</a>
            </div>
        </form>
    </div>
</div>
</div>

<script>
function previewImg(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('imgPreview');
        img.src = e.target.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}
</script>

@endsection
