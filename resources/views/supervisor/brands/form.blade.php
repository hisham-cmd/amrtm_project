@extends('layouts.dashboard')

@section('title', isset($brand) ? 'تعديل: '.$brand->name : 'إضافة علامة تجارية')
@section('page-title', isset($brand) ? 'تعديل علامة تجارية' : 'إضافة علامة تجارية جديدة')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item active"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
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
@php
    $isEdit  = isset($brand) && $brand;
    $action  = $isEdit ? route('supervisor.brands.update', $brand) : route('supervisor.brands.store');
    $method  = $isEdit ? 'PUT' : 'POST';
    $regions = ['الرياض','جدة','مكة المكرمة','المدينة المنورة','الدمام','الأحساء','أبها','القصيم','حائل','جميع المناطق'];
    $categories = ['food'=>'مطاعم وأغذية','edu'=>'تعليم وتدريب','fitness'=>'لياقة وصحة','tech'=>'تقنية','home'=>'خدمات منزلية','retail'=>'تجزئة','beauty'=>'جمال وعناية','real_estate'=>'عقارات','other'=>'أخرى'];
@endphp

<div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
    <a href="{{ route('supervisor.brands.index') }}" style="color:#64748b;text-decoration:none;font-size:.9rem;">
        <i class="fas fa-arrow-right"></i> العلامات التجارية
    </a>
    <span style="color:#cbd5e1;">/</span>
    <span style="color:#0f172a;font-weight:700;">{{ $isEdit ? $brand->name : 'إضافة جديدة' }}</span>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:14px 18px;margin-bottom:16px;">
    <ul style="margin:0;padding-right:18px;color:#991b1b;font-size:.88rem;">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf @method($method)

    <div style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start;">

        {{-- MAIN COLUMN --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- Basic Info --}}
            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 20px;font-size:1rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
                    <i class="fas fa-info-circle" style="color:#0369a1;margin-left:6px;"></i> المعلومات الأساسية
                </h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">اسم العلامة (عربي) *</label>
                        <input name="name" value="{{ old('name', $brand?->name) }}" required
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">اسم العلامة (English)</label>
                        <input name="name_en" value="{{ old('name_en', $brand?->name_en) }}"
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الفئة *</label>
                        <select name="category" required style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;">
                            @foreach($categories as $val => $lbl)
                                <option value="{{ $val }}" {{ old('category', $brand?->category) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الترتيب</label>
                        <input name="sort_order" type="number" value="{{ old('sort_order', $brand?->sort_order ?? 0) }}" min="0"
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;">
                    </div>
                </div>
                <div style="margin-top:14px;">
                    <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الوصف (عربي)</label>
                    <textarea name="description" rows="3" style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;resize:vertical;">{{ old('description', $brand?->description) }}</textarea>
                </div>
            </div>

            {{-- Investment --}}
            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 20px;font-size:1rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
                    <i class="fas fa-coins" style="color:#d97706;margin-left:6px;"></i> تفاصيل الاستثمار
                </h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الحد الأدنى للاستثمار (ريال) *</label>
                        <input name="investment_min" type="number" min="0" value="{{ old('investment_min', $brand?->investment_min) }}" required
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الحد الأقصى للاستثمار (ريال) *</label>
                        <input name="investment_max" type="number" min="0" value="{{ old('investment_max', $brand?->investment_max) }}" required
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الحد الأدنى للعائد (شهور) *</label>
                        <input name="roi_months_min" type="number" min="1" value="{{ old('roi_months_min', $brand?->roi_months_min ?? 12) }}" required
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الحد الأقصى للعائد (شهور) *</label>
                        <input name="roi_months_max" type="number" min="1" value="{{ old('roi_months_max', $brand?->roi_months_max ?? 24) }}" required
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                    </div>
                    <div>
                        <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">رسوم الامتياز (%) *</label>
                        <input name="franchise_fee_percent" type="number" step="0.01" min="0" max="100" value="{{ old('franchise_fee_percent', $brand?->franchise_fee_percent ?? 5) }}" required
                               style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                    </div>
                </div>
            </div>

            {{-- Regions --}}
            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 16px;font-size:1rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
                    <i class="fas fa-map-marker-alt" style="color:#10b981;margin-left:6px;"></i> المناطق المتاحة
                </h3>
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    @foreach($regions as $region)
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:.88rem;color:#374151;">
                        <input type="checkbox" name="available_regions[]" value="{{ $region }}"
                               {{ in_array($region, old('available_regions', $brand?->available_regions ?? [])) ? 'checked' : '' }}>
                        {{ $region }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Requirements --}}
            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 16px;font-size:1rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
                    <i class="fas fa-list-check" style="color:#7c3aed;margin-left:6px;"></i> المتطلبات (سطر لكل متطلب)
                </h3>
                <textarea name="requirements" rows="4" placeholder="مثال:&#10;مساحة 50-100م²&#10;سجل تجاري&#10;خبرة في الأغذية"
                          style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;resize:vertical;">{{ old('requirements', $brand ? implode("\n", $brand->requirements ?? []) : '') }}</textarea>
            </div>

            {{-- Gallery --}}
            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 16px;font-size:1rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
                    <i class="fas fa-images" style="color:#f59e0b;margin-left:6px;"></i> معرض الصور
                </h3>

                @if($isEdit && $brand->images->isNotEmpty())
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:16px;">
                    @foreach($brand->images as $img)
                    <div style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:1;">
                        <img src="{{ $img->url }}" style="width:100%;height:100%;object-fit:cover;">
                        <form method="POST" action="{{ route('supervisor.brands.images.delete', $img) }}"
                              style="position:absolute;top:6px;left:6px;" onsubmit="return confirm('حذف هذه الصورة؟')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:rgba(220,38,38,.85);color:#fff;border:none;border-radius:6px;width:28px;height:28px;cursor:pointer;font-size:.8rem;">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @endif

                <div style="border:2px dashed #e2e8f0;border-radius:12px;padding:24px;text-align:center;cursor:pointer;"
                     onclick="document.getElementById('gallery-input').click()">
                    <i class="fas fa-cloud-upload-alt" style="font-size:2rem;color:#94a3b8;margin-bottom:8px;display:block;"></i>
                    <div style="color:#64748b;font-size:.88rem;">اسحب الصور هنا أو اضغط للاختيار</div>
                    <div style="color:#94a3b8;font-size:.78rem;margin-top:4px;">PNG, JPG — حتى 5MB لكل صورة</div>
                </div>
                <input id="gallery-input" type="file" name="images[]" multiple accept="image/*" style="display:none;"
                       onchange="previewImages(this)">
                <div id="preview-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:12px;"></div>
            </div>

            {{-- Auction --}}
            @if(!$isEdit || !$brand->activeAuction())
            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 16px;font-size:1rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">
                    <i class="fas fa-gavel" style="color:#f59e0b;margin-left:6px;"></i> إنشاء مزاد (اختياري)
                </h3>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;margin-bottom:16px;font-weight:700;color:#374151;">
                    <input type="checkbox" name="create_auction" id="createAuction" value="1" {{ old('create_auction') ? 'checked' : '' }}>
                    إنشاء مزاد لهذه العلامة
                </label>
                <div id="auctionFields" style="{{ old('create_auction') ? '' : 'display:none;' }}">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div>
                            <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">سعر البداية (ريال)</label>
                            <input name="auction_starting_bid" type="number" min="1000" value="{{ old('auction_starting_bid') }}"
                                   style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                        </div>
                        <div>
                            <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الوديعة (ريال)</label>
                            <input name="auction_deposit" type="number" min="500" value="{{ old('auction_deposit', 5000) }}"
                                   style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                        </div>
                        <div>
                            <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الحد الأدنى للزيادة (ريال)</label>
                            <input name="auction_increment" type="number" min="500" value="{{ old('auction_increment', 2500) }}"
                                   style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                        </div>
                        <div>
                            <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">تاريخ انتهاء المزاد</label>
                            <input name="auction_ends_at" type="datetime-local" value="{{ old('auction_ends_at') }}"
                                   style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;box-sizing:border-box;" dir="ltr">
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        {{-- SIDE COLUMN --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- Logo --}}
            <div style="background:#fff;border-radius:16px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 14px;font-size:.95rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:10px;">
                    <i class="fas fa-image" style="color:#0369a1;margin-left:6px;"></i> شعار العلامة
                </h3>
                <div style="text-align:center;">
                    <div id="logo-preview" style="width:120px;height:120px;border-radius:18px;margin:0 auto 14px;border:2px dashed #e2e8f0;display:flex;align-items:center;justify-content:center;overflow:hidden;background:#f8fafc;">
                        @if($isEdit && $brand->logo_url)
                            <img src="{{ $brand->logo_url }}" style="width:100%;height:100%;object-fit:contain;" id="logo-img">
                        @else
                            <i class="fas fa-trademark" style="font-size:2rem;color:#cbd5e1;" id="logo-icon"></i>
                        @endif
                    </div>
                    <label for="logo-input" style="display:inline-flex;align-items:center;gap:6px;background:#f0f9ff;color:#0369a1;padding:8px 16px;border-radius:10px;font-size:.85rem;font-weight:700;cursor:pointer;border:1px solid #bae6fd;">
                        <i class="fas fa-upload"></i> {{ $isEdit && $brand->logo_url ? 'تغيير الشعار' : 'رفع الشعار' }}
                    </label>
                    <input id="logo-input" type="file" name="logo" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                    <div style="font-size:.75rem;color:#94a3b8;margin-top:6px;">PNG أو SVG — شفاف يُفضَّل</div>
                </div>
            </div>

            {{-- Status & Flags --}}
            <div style="background:#fff;border-radius:16px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <h3 style="margin:0 0 14px;font-size:.95rem;color:#0f2d5a;border-bottom:1px solid #f1f5f9;padding-bottom:10px;">
                    <i class="fas fa-toggle-on" style="color:#10b981;margin-left:6px;"></i> الحالة والإعدادات
                </h3>
                <div style="margin-bottom:14px;">
                    <label style="font-size:.82rem;font-weight:700;color:#374151;display:block;margin-bottom:6px;">الحالة</label>
                    <select name="status" style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:.9rem;">
                        <option value="active"   {{ old('status', $brand?->status) === 'active'   ? 'selected' : '' }}>نشط</option>
                        <option value="inactive" {{ old('status', $brand?->status) === 'inactive' ? 'selected' : '' }}>غير نشط</option>
                        <option value="draft"    {{ old('status', $brand?->status) === 'draft'    ? 'selected' : '' }}>مسودة</option>
                    </select>
                </div>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;margin-bottom:12px;font-size:.88rem;color:#374151;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $brand?->is_featured) ? 'checked' : '' }}>
                    علامة مميزة (تظهر أولاً)
                </label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:.88rem;color:#374151;">
                    <input type="checkbox" name="is_auction_eligible" value="1" {{ old('is_auction_eligible', $brand?->is_auction_eligible) ? 'checked' : '' }}>
                    مؤهلة للمزاد
                </label>
            </div>

            {{-- Save --}}
            <div style="background:#fff;border-radius:16px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
                <button type="submit" style="width:100%;padding:13px;background:linear-gradient(135deg,#0d2448,#1a4a8a);color:#fff;border:none;border-radius:12px;font-family:inherit;font-size:1rem;font-weight:800;cursor:pointer;">
                    <i class="fas fa-save"></i> {{ $isEdit ? 'حفظ التعديلات' : 'إضافة العلامة' }}
                </button>
                <a href="{{ route('supervisor.brands.index') }}" style="display:block;text-align:center;margin-top:10px;color:#64748b;font-size:.88rem;text-decoration:none;">إلغاء</a>
            </div>

        </div>
    </div>
</form>

<script>
function previewLogo(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('logo-preview');
        preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:contain;">`;
    };
    reader.readAsDataURL(input.files[0]);
}

function previewImages(input) {
    const grid = document.getElementById('preview-grid');
    grid.innerHTML = '';
    [...input.files].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.style.cssText = 'border-radius:10px;overflow:hidden;aspect-ratio:1;background:#f1f5f9;';
            div.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

const auctionCheck = document.getElementById('createAuction');
if (auctionCheck) {
    auctionCheck.addEventListener('change', function() {
        document.getElementById('auctionFields').style.display = this.checked ? '' : 'none';
    });
}
</script>
@endsection
