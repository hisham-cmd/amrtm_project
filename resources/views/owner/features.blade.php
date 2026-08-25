@extends('layouts.dashboard')

@section('title', 'مميزات القاعة')
@section('page-title', 'مميزات القاعة')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item active"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
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

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-star"></i> مميزات القاعة</span>
        <button type="button" class="btn btn-outline btn-sm" onclick="addFeatureRow()">
            <i class="fas fa-plus"></i> إضافة ميزة
        </button>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('owner.features.save') }}" id="featuresForm">
            @csrf

            <div id="features-list">
                @forelse($features as $i => $feature)
                    <div class="feature-row" style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
                        <div class="input-wrap" style="flex:1; position:relative;">
                            <input type="text" name="features[{{ $i }}][name]" class="form-control"
                                   value="{{ $feature->name }}" placeholder="اسم الميزة (مثال: مكيف، موقف سيارات)" required>
                        </div>
                        <div style="width:160px;">
                            <input type="text" name="features[{{ $i }}][icon]" class="form-control"
                                   value="{{ $feature->icon }}" placeholder="أيقونة (fa-snowflake)">
                        </div>
                        <button type="button" onclick="this.closest('.feature-row').remove()"
                                style="background:#f8d7da; color:#721c24; border:none; border-radius:8px;
                                       width:38px; height:38px; cursor:pointer; font-size:.9rem; flex-shrink:0;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @empty
                    <!-- empty — user can add rows -->
                @endforelse
            </div>

            <div style="margin-top:8px; color:#6c7a72; font-size:.82rem; margin-bottom:20px;">
                الأيقونات من FontAwesome مثل: fa-snowflake، fa-parking، fa-wifi، fa-utensils
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn btn-outline" onclick="addFeatureRow()">
                    <i class="fas fa-plus"></i> إضافة ميزة
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ المميزات
                </button>
            </div>
        </form>
    </div>
</div>

@endunless

@push('scripts')
<script>
    var rowIndex = {{ $features->count() }};

    function addFeatureRow() {
        var container = document.getElementById('features-list');
        var row = document.createElement('div');
        row.className = 'feature-row';
        row.style.cssText = 'display:flex; gap:12px; align-items:center; margin-bottom:12px;';
        row.innerHTML =
            '<div style="flex:1;">' +
                '<input type="text" name="features[' + rowIndex + '][name]" class="form-control" placeholder="اسم الميزة" required>' +
            '</div>' +
            '<div style="width:160px;">' +
                '<input type="text" name="features[' + rowIndex + '][icon]" class="form-control" placeholder="fa-star">' +
            '</div>' +
            '<button type="button" onclick="this.closest(\'.feature-row\').remove()"' +
                ' style="background:#f8d7da; color:#721c24; border:none; border-radius:8px; width:38px; height:38px; cursor:pointer; flex-shrink:0;">' +
                '<i class="fas fa-times"></i>' +
            '</button>';
        container.appendChild(row);
        rowIndex++;
    }

    // Add one empty row if no features exist
    if (document.querySelectorAll('.feature-row').length === 0) {
        addFeatureRow();
    }
</script>
@endpush

@endsection
