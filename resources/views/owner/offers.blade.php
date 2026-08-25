@extends('layouts.dashboard')

@section('title', 'العروض الخاصة')
@section('page-title', 'العروض الخاصة')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item active"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item"><i class="fas fa-calendar-times"></i> الأيام المشغولة</a>
    <a href="{{ route('owner.bookings') }}" class="nav-item"><i class="fas fa-calendar-check"></i> الحجوزات</a>
    <a href="{{ route('owner.documents') }}" class="nav-item"><i class="fas fa-file-alt"></i> وثائق التوثيق</a>
    <a href="{{ route('owner.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@unless($hall)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        يجب إنشاء القاعة أولاً. <a href="{{ route('owner.hall-info') }}" style="font-weight:700;">أنشئ القاعة ←</a>
    </div>
@else

@php $services = \App\Models\HallOffer::availableServices(); @endphp

<!-- Add Offer Form -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-plus-circle"></i> إضافة عرض جديد</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('owner.offers.save') }}">
            @csrf

            {{-- اسم العرض --}}
            <div class="form-group">
                <label class="form-label">اسم العرض *</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}" placeholder="عرض موسم الأعراس" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- الخصم --}}
            <div class="form-row form-row-3" style="align-items:flex-end;">
                <div class="form-group">
                    <label class="form-label">نوع الخصم</label>
                    <select name="discount_type" id="discountType" class="form-control" onchange="toggleDiscountValue()">
                        <option value="none" {{ old('discount_type','none') === 'none' ? 'selected' : '' }}>بدون خصم</option>
                        <option value="percentage" {{ old('discount_type') === 'percentage' ? 'selected' : '' }}>نسبة مئوية %</option>
                        <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>مبلغ ثابت (ريال)</option>
                    </select>
                </div>
                <div class="form-group" id="discountValueWrap" style="{{ old('discount_type','none') === 'none' ? 'display:none' : '' }}">
                    <label class="form-label">قيمة الخصم *</label>
                    <input type="number" name="discount_value" class="form-control @error('discount_value') is-invalid @enderror"
                           value="{{ old('discount_value') }}" min="0" step="0.01">
                    @error('discount_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">حالة العرض</label>
                    <div style="display:flex;align-items:center;gap:10px;padding-top:6px;">
                        <input type="checkbox" name="is_active" value="1" id="isActive"
                               {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                               style="width:18px;height:18px;cursor:pointer;">
                        <label for="isActive" style="font-size:14px;font-weight:600;cursor:pointer;">نشط</label>
                    </div>
                </div>
            </div>

            {{-- التواريخ --}}
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">تاريخ بداية العرض *</label>
                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date') }}" required>
                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ نهاية العرض *</label>
                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                           value="{{ old('end_date') }}" required>
                    @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- ── الطريقة الأولى: قائمة خدمات جاهزة ── --}}
            <div class="form-group">
                <label class="form-label" style="margin-bottom:10px;">
                    <i class="fas fa-list-check" style="color:#2e7d32;margin-left:5px;"></i>
                    الطريقة الأولى — اختر الخدمات المضمّنة في العرض
                    <small style="display:block;font-weight:400;color:#64748b;margin-top:3px;">اختر من القائمة الجاهزة</small>
                </label>
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    @foreach($services as $service)
                        <label style="display:flex;align-items:center;gap:6px;background:#f1f5f9;border-radius:8px;padding:8px 14px;cursor:pointer;font-size:13px;font-weight:600;border:2px solid transparent;transition:all .2s;"
                               onmouseover="this.style.borderColor='#2e7d32'" onmouseout="this.style.borderColor=this.querySelector('input').checked?'#2e7d32':'transparent'">
                            <input type="checkbox" name="included_services[]" value="{{ $service }}"
                                   {{ in_array($service, old('included_services', [])) ? 'checked' : '' }}
                                   onchange="this.closest('label').style.borderColor=this.checked?'#2e7d32':'transparent'"
                                   style="width:16px;height:16px;cursor:pointer;accent-color:#2e7d32;">
                            {{ $service }}
                        </label>
                    @endforeach
                </div>
                @error('included_services') <div style="color:red;font-size:12px;margin-top:4px;">{{ $message }}</div> @enderror
            </div>

            {{-- ── الطريقة الثانية: وصف نصي حر ── --}}
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-pen-to-square" style="color:#2e7d32;margin-left:5px;"></i>
                    الطريقة الثانية — وصف العرض بنص حر
                    <small style="display:block;font-weight:400;color:#64748b;margin-top:3px;">اكتب تفاصيل العرض بكلماتك</small>
                </label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          rows="3" placeholder="مثال: خصم 10% مع كوشة مجانية وخدمة التصوير بنسبة 50%...">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة العرض
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Existing Offers -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-gift"></i> العروض الحالية</span>
    </div>

    @if($offers->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:40px 0;">
            <i class="fas fa-gift" style="font-size:2.5rem;opacity:.4;display:block;margin-bottom:10px;"></i>
            لا توجد عروض مضافة بعد
        </div>
    @else
        <div class="card-body" style="display:flex;flex-direction:column;gap:8px;padding-top:14px;padding-bottom:14px;">
            @foreach($offers as $offer)
            @php
                $isNow = $offer->isActiveNow();
                $expired = $offer->end_date->isPast();
            @endphp
            <div style="background:#f8fafc;border-radius:12px;border:2px solid {{ $isNow ? '#16a34a' : ($expired ? '#e5e7eb' : '#fbbf24') }};padding:10px 14px;position:relative;">

                {{-- شارة الحالة --}}
                <span style="position:absolute;top:12px;left:14px;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;
                    background:{{ $isNow ? '#dcfce7' : ($expired ? '#f1f5f9' : '#fef9c3') }};
                    color:{{ $isNow ? '#15803d' : ($expired ? '#94a3b8' : '#92400e') }};">
                    {{ $isNow ? '● نشط الآن' : ($expired ? 'منتهي' : 'قادم') }}
                </span>
                <br>

                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                    <div style="flex:1;min-width:200px;">
                        <div style="font-size:16px;font-weight:800;color:#0f3d24;margin-bottom:6px;">{{ $offer->title }}</div>

                        {{-- الخصم --}}
                        @if($offer->discount_type !== 'none' && $offer->discount_value)
                            <div style="display:inline-flex;align-items:center;gap:6px;background:#0f3d24;color:#fff;border-radius:8px;padding:4px 12px;font-size:13px;font-weight:700;margin-bottom:8px;">
                                <i class="fas fa-percent"></i>
                                خصم
                                {{ $offer->discount_type === 'percentage'
                                    ? number_format($offer->discount_value, 0) . '%'
                                    : number_format($offer->discount_value, 0) . ' ريال' }}
                            </div>
                        @endif

                        {{-- التواريخ --}}
                        <div style="font-size:12px;color:#475569;margin-bottom:8px;">
                            <i class="fas fa-calendar-range" style="margin-left:4px;color:#2e7d32;"></i>
                            {{ $offer->start_date->format('Y/m/d') }} — {{ $offer->end_date->format('Y/m/d') }}
                        </div>

                        {{-- خدمات القائمة --}}
                        @if(!empty($offer->included_services))
                            <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px;">
                                @foreach($offer->included_services as $svc)
                                    <span style="background:#dcfce7;color:#15803d;border-radius:6px;padding:3px 10px;font-size:12px;font-weight:600;">
                                        <i class="fas fa-check" style="margin-left:3px;font-size:10px;"></i>{{ $svc }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- الوصف الحر --}}
                        @if($offer->description)
                            <div style="font-size:13px;color:#475569;background:#fff;border-radius:8px;padding:8px 12px;border-right:3px solid #2e7d32;">
                                {{ $offer->description }}
                            </div>
                        @endif
                    </div>

                    {{-- أزرار --}}
                    <div style="display:flex;flex-direction:column;gap:6px;align-items:flex-start;">
                        <form method="POST" action="{{ route('owner.offers.toggle', $offer->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm"
                                    style="background:{{ $offer->is_active ? '#fef3c7' : '#dcfce7' }};color:{{ $offer->is_active ? '#92400e' : '#15803d' }};border:none;min-width:90px;">
                                <i class="fas fa-{{ $offer->is_active ? 'pause' : 'play' }}"></i>
                                {{ $offer->is_active ? 'إيقاف' : 'تفعيل' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('owner.offers.delete', $offer->id) }}"
                              onsubmit="return confirm('هل تريد حذف هذا العرض؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="min-width:90px;">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@endunless

@endsection

@push('scripts')
<script>
function toggleDiscountValue() {
    var type = document.getElementById('discountType').value;
    document.getElementById('discountValueWrap').style.display = type === 'none' ? 'none' : '';
}
</script>
@endpush
