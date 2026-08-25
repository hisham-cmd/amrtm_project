@extends('layouts.dashboard')

@section('title', $opportunity ? 'تعديل الامتياز' : 'إضافة امتياز')
@section('page-title', 'فرص الامتياز')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item active"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
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
.step-row{display:grid;grid-template-columns:36px 1fr 180px 180px 36px;gap:10px;align-items:start;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:14px;margin-bottom:10px;}
.step-num{width:32px;height:32px;border-radius:50%;background:#0d2448;color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:900;flex-shrink:0;margin-top:4px;}
.req-chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:8px;}
.req-chip{display:inline-flex;align-items:center;gap:6px;background:#e0f2fe;color:#0369a1;padding:4px 12px;border-radius:8px;font-size:12px;font-weight:700;}
</style>

<div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
    <a href="{{ route('supervisor.franchise.index') }}" style="color:#64748b;text-decoration:none;font-size:.9rem;"><i class="fas fa-arrow-right"></i> الامتيازات</a>
    <span style="color:#cbd5e1;">/</span>
    <span style="font-weight:700;color:#0f2d5a;">{{ $opportunity ? 'تعديل: '.$opportunity->name : 'إضافة امتياز جديد' }}</span>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 18px;margin-bottom:20px;color:#991b1b;">
    <ul style="margin:0;padding-right:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form method="POST" enctype="multipart/form-data"
      action="{{ $opportunity ? route('supervisor.franchise.update',$opportunity) : route('supervisor.franchise.store') }}">
    @csrf
    @if($opportunity) @method('PUT') @endif

    {{-- ── BASIC INFO ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-info-circle"></i> المعلومات الأساسية</h3>
        <div class="frm-grid-2">
            <div class="frm-group">
                <label class="frm-label">اسم الامتياز (عربي) *</label>
                <input class="frm-input" type="text" name="name" value="{{ old('name', $opportunity->name ?? '') }}" required placeholder="بن زيد للقهوة العربية">
            </div>
            <div class="frm-group">
                <label class="frm-label">الاسم (إنجليزي)</label>
                <input class="frm-input" type="text" name="name_en" value="{{ old('name_en', $opportunity->name_en ?? '') }}" placeholder="Bin Zaid Arabic Coffee">
            </div>
        </div>
        <div class="frm-group">
            <label class="frm-label">الوصف</label>
            <textarea class="frm-input" name="description" rows="3" placeholder="وصف موجز عن الامتياز...">{{ old('description', $opportunity->description ?? '') }}</textarea>
        </div>
        <div class="frm-grid-3">
            <div class="frm-group">
                <label class="frm-label">الفئة *</label>
                <select class="frm-input" name="category" required>
                    @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ old('category', $opportunity->category ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="frm-group">
                <label class="frm-label">الحالة</label>
                <select class="frm-input" name="status">
                    <option value="active" {{ old('status', $opportunity->status ?? 'active') === 'active' ? 'selected' : '' }}>نشط</option>
                    <option value="inactive" {{ old('status', $opportunity->status ?? '') === 'inactive' ? 'selected' : '' }}>غير نشط</option>
                </select>
            </div>
            <div class="frm-group">
                <label class="frm-label">ترتيب العرض</label>
                <input class="frm-input" type="number" name="sort_order" value="{{ old('sort_order', $opportunity->sort_order ?? 0) }}" min="0">
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $opportunity->is_featured ?? false) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#0d2448;cursor:pointer;">
            <label for="is_featured" style="font-size:14px;font-weight:700;color:#374151;cursor:pointer;">مميز (يظهر في الأعلى)</label>
        </div>
    </div>

    {{-- ── LOGO IMAGE ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-image"></i> الصورة / الشعار</h3>
        @if($opportunity && $opportunity->logo_url)
        <div style="margin-bottom:16px;display:flex;align-items:center;gap:14px;">
            <img src="{{ $opportunity->logo_url }}" alt="الشعار الحالي" style="width:80px;height:80px;object-fit:contain;border-radius:12px;border:1.5px solid #e2e8f0;background:#f8fafc;padding:4px;">
            <span style="font-size:13px;color:#64748b;">الصورة الحالية</span>
        </div>
        @endif
        <div class="frm-group">
            <label class="frm-label">{{ $opportunity?->logo ? 'تغيير الصورة (اختياري)' : 'رفع صورة / شعار الامتياز' }}</label>
            <input class="frm-input" type="file" name="logo" accept="image/*" style="padding:8px;">
            <p class="frm-hint">PNG أو JPG — الحد الأقصى 4MB — يُعرض في كارد الامتياز على الموقع</p>
        </div>
    </div>

    {{-- ── APPEARANCE ─────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-palette"></i> المظهر والتصميم</h3>
        <div class="frm-grid-3">
            <div class="frm-group">
                <label class="frm-label">أيقونة FontAwesome *</label>
                <input class="frm-input" type="text" name="icon" value="{{ old('icon', $opportunity->icon ?? 'fa-store') }}" placeholder="fa-coffee" required>
                <p class="frm-hint">مثال: fa-coffee / fa-graduation-cap / fa-dumbbell</p>
            </div>
            <div class="frm-group">
                <label class="frm-label">لون التدرج (بداية)</label>
                <div style="display:flex;gap:8px;align-items:center;">
                    <input type="color" name="gradient_from" value="{{ old('gradient_from', $opportunity->gradient_from ?? '#0d2448') }}" style="width:44px;height:44px;border:none;border-radius:8px;cursor:pointer;">
                    <input class="frm-input" type="text" id="gFrom" value="{{ old('gradient_from', $opportunity->gradient_from ?? '#0d2448') }}" style="flex:1;" oninput="syncColor(this,'gradient_from')">
                </div>
            </div>
            <div class="frm-group">
                <label class="frm-label">لون التدرج (نهاية)</label>
                <div style="display:flex;gap:8px;align-items:center;">
                    <input type="color" name="gradient_to" value="{{ old('gradient_to', $opportunity->gradient_to ?? '#1a4a8a') }}" style="width:44px;height:44px;border:none;border-radius:8px;cursor:pointer;">
                    <input class="frm-input" type="text" id="gTo" value="{{ old('gradient_to', $opportunity->gradient_to ?? '#1a4a8a') }}" style="flex:1;" oninput="syncColor(this,'gradient_to')">
                </div>
            </div>
        </div>
        <div class="frm-grid-2">
            <div class="frm-group">
                <label class="frm-label">نص البادج (اختياري)</label>
                <input class="frm-input" type="text" name="badge_text" value="{{ old('badge_text', $opportunity->badge_text ?? '') }}" placeholder="الأكثر طلباً / جديد / مميز">
            </div>
            <div class="frm-group">
                <label class="frm-label">معاينة الكارد</label>
                <div id="cardPreview" style="height:52px;border-radius:14px;background:linear-gradient(135deg,{{ $opportunity->gradient_from ?? '#0d2448' }},{{ $opportunity->gradient_to ?? '#1a4a8a' }});display:flex;align-items:center;padding:0 16px;gap:12px;transition:all .3s;">
                    <i class="fas {{ old('icon',$opportunity->icon??'fa-store') }}" style="color:#fff;font-size:1.4rem;" id="iconPrev"></i>
                    <span style="color:#fff;font-weight:700;font-size:14px;" id="namePrev">{{ old('name',$opportunity->name??'اسم الامتياز') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── INVESTMENT & FINANCIALS ─────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-coins"></i> التفاصيل الاستثمارية</h3>
        <div class="frm-grid-2">
            <div class="frm-group">
                <label class="frm-label">الحد الأدنى للاستثمار (ريال) *</label>
                <input class="frm-input" type="number" name="investment_min" value="{{ old('investment_min', $opportunity->investment_min ?? 0) }}" min="0" required>
            </div>
            <div class="frm-group">
                <label class="frm-label">الحد الأقصى للاستثمار (ريال) *</label>
                <input class="frm-input" type="number" name="investment_max" value="{{ old('investment_max', $opportunity->investment_max ?? 0) }}" min="0" required>
            </div>
            <div class="frm-group">
                <label class="frm-label">أقل مدة عائد استثمار (شهر) *</label>
                <input class="frm-input" type="number" name="roi_months_min" value="{{ old('roi_months_min', $opportunity->roi_months_min ?? 12) }}" min="1" required>
            </div>
            <div class="frm-group">
                <label class="frm-label">أقصى مدة عائد استثمار (شهر) *</label>
                <input class="frm-input" type="number" name="roi_months_max" value="{{ old('roi_months_max', $opportunity->roi_months_max ?? 24) }}" min="1" required>
            </div>
        </div>
        <div class="frm-group" style="max-width:280px;">
            <label class="frm-label">نسبة رسوم الامتياز (%) *</label>
            <input class="frm-input" type="number" name="franchise_fee_percent" step="0.5" value="{{ old('franchise_fee_percent', $opportunity->franchise_fee_percent ?? 5) }}" min="0" max="100" required>
        </div>
    </div>

    {{-- ── REGIONS & REQUIREMENTS ──────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-map-marker-alt"></i> المناطق والمتطلبات</h3>
        <div class="frm-group">
            <label class="frm-label">المناطق المتاحة</label>
            <div style="display:flex;flex-wrap:wrap;gap:10px;">
                @foreach($allRegions as $region)
                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                    <input type="checkbox" name="available_regions[]" value="{{ $region }}"
                           {{ in_array($region, old('available_regions', $opportunity->available_regions ?? [])) ? 'checked' : '' }}
                           style="width:16px;height:16px;accent-color:#0d2448;">
                    {{ $region }}
                </label>
                @endforeach
            </div>
        </div>
        <div class="frm-group">
            <label class="frm-label">متطلبات الامتياز (سطر لكل متطلب)</label>
            <textarea class="frm-input" name="requirements_text" rows="4" placeholder="خبرة في الأغذية&#10;مساحة 40-80م²&#10;سجل تجاري&#10;رأس مال جاهز">{{ old('requirements_text', implode("\n", $opportunity->requirements ?? [])) }}</textarea>
            <p class="frm-hint">كل سطر سيظهر كـ tag منفصل على الكارد في الموقع</p>
        </div>
    </div>

    {{-- ── STEPS ───────────────────────────────────────── --}}
    <div class="frm-section">
        <h3><i class="fas fa-list-ol"></i> خطوات التقديم والحصول على الامتياز</h3>
        <p style="font-size:13px;color:#64748b;margin:-10px 0 20px;">هذه الخطوات تظهر للمستخدم عند التقديم على الامتياز. اضغط "إضافة خطوة" لإضافة المزيد.</p>

        <div id="stepsContainer">
            @php $steps = old('step_title') ? collect(old('step_title'))->map(fn($t,$i)=>(object)['title'=>$t,'description'=>old('step_description.'.$i,''),'icon'=>old('step_icon.'.$i,'fa-circle')]) : ($opportunity?->steps ?? collect()); @endphp
            @if($steps->isNotEmpty())
                @foreach($steps as $si => $step)
                <div class="step-row" id="step-{{ $si }}">
                    <div class="step-num">{{ $si+1 }}</div>
                    <div>
                        <label class="frm-label">عنوان الخطوة *</label>
                        <input class="frm-input" type="text" name="step_title[]" value="{{ $step->title }}" required placeholder="تقديم الطلب">
                    </div>
                    <div>
                        <label class="frm-label">وصف الخطوة</label>
                        <input class="frm-input" type="text" name="step_description[]" value="{{ $step->description ?? '' }}" placeholder="وصف موجز...">
                    </div>
                    <div>
                        <label class="frm-label">أيقونة FA</label>
                        <input class="frm-input" type="text" name="step_icon[]" value="{{ $step->icon ?? 'fa-circle' }}" placeholder="fa-paper-plane">
                    </div>
                    <button type="button" onclick="removeStep(this)" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;width:34px;height:34px;cursor:pointer;margin-top:22px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endforeach
            @else
                {{-- default empty step --}}
                <div class="step-row" id="step-0">
                    <div class="step-num">1</div>
                    <div>
                        <label class="frm-label">عنوان الخطوة *</label>
                        <input class="frm-input" type="text" name="step_title[]" required placeholder="تقديم الطلب">
                    </div>
                    <div>
                        <label class="frm-label">وصف الخطوة</label>
                        <input class="frm-input" type="text" name="step_description[]" placeholder="وصف موجز...">
                    </div>
                    <div>
                        <label class="frm-label">أيقونة FA</label>
                        <input class="frm-input" type="text" name="step_icon[]" value="fa-paper-plane" placeholder="fa-paper-plane">
                    </div>
                    <button type="button" onclick="removeStep(this)" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;width:34px;height:34px;cursor:pointer;margin-top:22px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>

        <button type="button" onclick="addStep()" style="display:inline-flex;align-items:center;gap:8px;background:#f0f9ff;color:#0369a1;border:1.5px dashed #7dd3fc;padding:10px 20px;border-radius:10px;font-size:.9rem;font-weight:700;cursor:pointer;font-family:'Cairo',sans-serif;margin-top:4px;">
            <i class="fas fa-plus"></i> إضافة خطوة
        </button>
    </div>

    {{-- ── SUBMIT ──────────────────────────────────────── --}}
    <div style="display:flex;gap:12px;">
        <button type="submit" style="background:linear-gradient(135deg,#0d2448,#1a4a8a);color:#fff;padding:12px 36px;border-radius:12px;font-size:.95rem;font-weight:800;border:none;cursor:pointer;font-family:'Cairo',sans-serif;">
            <i class="fas fa-save"></i> {{ $opportunity ? 'حفظ التعديلات' : 'إضافة الامتياز' }}
        </button>
        <a href="{{ route('supervisor.franchise.index') }}" style="background:#f1f5f9;color:#374151;padding:12px 24px;border-radius:12px;font-size:.95rem;font-weight:700;text-decoration:none;">
            إلغاء
        </a>
    </div>
</form>

<script>
let stepCount = {{ ($steps ?? collect())->count() ?: 1 }};

function addStep() {
    stepCount++;
    const container = document.getElementById('stepsContainer');
    const div = document.createElement('div');
    div.className = 'step-row';
    div.id = 'step-' + stepCount;
    div.innerHTML = `
        <div class="step-num">${stepCount}</div>
        <div>
            <label class="frm-label">عنوان الخطوة *</label>
            <input class="frm-input" type="text" name="step_title[]" required placeholder="عنوان الخطوة">
        </div>
        <div>
            <label class="frm-label">وصف الخطوة</label>
            <input class="frm-input" type="text" name="step_description[]" placeholder="وصف موجز...">
        </div>
        <div>
            <label class="frm-label">أيقونة FA</label>
            <input class="frm-input" type="text" name="step_icon[]" value="fa-circle" placeholder="fa-circle">
        </div>
        <button type="button" onclick="removeStep(this)" style="background:#fee2e2;color:#991b1b;border:none;border-radius:8px;width:34px;height:34px;cursor:pointer;margin-top:22px;display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-times"></i>
        </button>`;
    container.appendChild(div);
    renumberSteps();
}

function removeStep(btn) {
    if (document.querySelectorAll('#stepsContainer .step-row').length <= 1) return;
    btn.closest('.step-row').remove();
    renumberSteps();
}

function renumberSteps() {
    document.querySelectorAll('#stepsContainer .step-num').forEach((el,i) => el.textContent = i+1);
}

function syncColor(input, fieldName) {
    const colorInput = input.previousElementSibling;
    if (/^#[0-9A-Fa-f]{6}$/.test(input.value)) colorInput.value = input.value;
    updatePreview();
}

function updatePreview() {
    const from  = document.querySelector('input[name="gradient_from"]').value;
    const to    = document.querySelector('input[name="gradient_to"]').value;
    const icon  = document.querySelector('input[name="icon"]').value;
    const name  = document.querySelector('input[name="name"]').value || 'اسم الامتياز';
    document.getElementById('cardPreview').style.background = `linear-gradient(135deg,${from},${to})`;
    document.getElementById('iconPrev').className = 'fas ' + icon;
    document.getElementById('namePrev').textContent = name;
}

document.querySelectorAll('input[name="gradient_from"], input[name="gradient_to"], input[name="icon"], input[name="name"]')
    .forEach(el => el.addEventListener('input', updatePreview));
document.querySelectorAll('input[type="color"]').forEach(el => el.addEventListener('input', function() {
    this.nextElementSibling.value = this.value;
    updatePreview();
}));
</script>
@endsection
