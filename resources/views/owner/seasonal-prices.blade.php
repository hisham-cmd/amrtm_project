@extends('layouts.dashboard')

@section('title', 'الأسعار الموسمية')
@section('page-title', 'الأسعار الموسمية')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item active"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
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

<!-- Add Price Form -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-plus-circle"></i> إضافة سعر موسمي</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('owner.seasonal-prices.save') }}">
            @csrf
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">اسم الموسم *</label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
                           value="{{ old('label') }}" placeholder="موسم رمضان" required>
                    @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">السعر اليومي (ريال) *</label>
                    <input type="number" name="price_per_day" class="form-control @error('price_per_day') is-invalid @enderror"
                           value="{{ old('price_per_day') }}" min="0" step="0.01" required>
                    @error('price_per_day') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">تاريخ البداية *</label>
                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date') }}" required>
                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ النهاية *</label>
                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                           value="{{ old('end_date') }}" required>
                    @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة السعر
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Existing Prices -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-list"></i> الأسعار الموسمية الحالية</span>
    </div>
    @if($prices->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-tags" style="font-size:2.5rem; opacity:.4; display:block; margin-bottom:10px;"></i>
            لا توجد أسعار موسمية مضافة بعد
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>اسم الموسم</th>
                        <th>من</th>
                        <th>إلى</th>
                        <th>السعر اليومي</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prices as $price)
                        <tr>
                            <td><strong>{{ $price->label }}</strong></td>
                            <td>{{ $price->start_date->format('Y/m/d') }}</td>
                            <td>{{ $price->end_date->format('Y/m/d') }}</td>
                            <td>{{ number_format($price->price_per_day) }} ريال</td>
                            <td style="white-space:nowrap;">
                                <button type="button" class="btn btn-sm"
                                        style="background:#2e7d32;color:#fff;"
                                        onclick="openEditModal({{ $price->id }}, '{{ addslashes($price->label) }}', '{{ $price->start_date->format('Y-m-d') }}', '{{ $price->end_date->format('Y-m-d') }}', '{{ $price->price_per_day }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('owner.seasonal-prices.delete', $price->id) }}"
                                      onsubmit="return confirm('هل تريد حذف هذا السعر الموسمي؟')"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endunless

<!-- Edit Modal -->
<div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:12px; padding:32px; width:100%; max-width:500px; margin:auto; direction:rtl;">
        <h3 style="margin:0 0 20px; font-size:1.1rem;"><i class="fas fa-edit" style="color:#2e7d32;"></i> تعديل السعر الموسمي</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">اسم الموسم *</label>
                    <input type="text" name="label" id="edit_label" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">السعر اليومي (ريال) *</label>
                    <input type="number" name="price_per_day" id="edit_price_per_day" class="form-control" min="0" step="0.01" required>
                </div>
            </div>
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">تاريخ البداية *</label>
                    <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ النهاية *</label>
                    <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:10px;">
                <button type="button" class="btn" style="background:#e0e0e0;color:#333;" onclick="closeEditModal()">إلغاء</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> حفظ التعديل</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEditModal(id, label, startDate, endDate, price) {
    var updateUrl = '{{ url('owner/seasonal-prices') }}/' + id;
    document.getElementById('editForm').action = updateUrl;
    document.getElementById('edit_label').value         = label;
    document.getElementById('edit_start_date').value    = startDate;
    document.getElementById('edit_end_date').value      = endDate;
    document.getElementById('edit_price_per_day').value = price;
    var modal = document.getElementById('editModal');
    modal.style.display = 'flex';
}
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>
@endpush
