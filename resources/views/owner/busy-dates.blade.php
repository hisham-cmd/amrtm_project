@extends('layouts.dashboard')

@section('title', 'الأيام المشغولة')
@section('page-title', 'الأيام المشغولة')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item active"><i class="fas fa-calendar-times"></i> الأيام المشغولة</a>
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

<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

    <!-- Add Busy Date -->
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-calendar-plus"></i> إضافة يوم مشغول</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('owner.busy-dates.add') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">التاريخ *</label>
                    <input type="date" name="busy_date" class="form-control @error('busy_date') is-invalid @enderror"
                           value="{{ old('busy_date') }}" min="{{ date('Y-m-d') }}" required>
                    @error('busy_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">السبب (اختياري)</label>
                    <input type="text" name="reason" class="form-control @error('reason') is-invalid @enderror"
                           value="{{ old('reason') }}" placeholder="حفل خاص، صيانة...">
                    @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> إضافة اليوم
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Busy Dates List -->
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-list"></i> الأيام المشغولة</span>
            <span style="color:#6c7a72; font-size:.88rem;">{{ $dates->count() }} يوم</span>
        </div>
        <div style="max-height:400px; overflow-y:auto;">
            @if($dates->isEmpty())
                <div style="text-align:center; color:#6c7a72; padding:40px 0;">
                    <i class="fas fa-calendar-check" style="font-size:2.5rem; opacity:.4; display:block; margin-bottom:10px;"></i>
                    لا توجد أيام مشغولة
                </div>
            @else
                <table style="width:100%; border-collapse:collapse; font-size:.88rem;">
                    <thead>
                        <tr>
                            <th style="background:#e8f5ee; color:#1a5c38; padding:10px 16px; text-align:right;">التاريخ</th>
                            <th style="background:#e8f5ee; color:#1a5c38; padding:10px 16px; text-align:right;">السبب</th>
                            <th style="background:#e8f5ee; color:#1a5c38; padding:10px 16px; text-align:center;">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dates as $date)
                            <tr style="border-bottom:1px solid #f0f4f2;">
                                <td style="padding:10px 16px;">
                                    <strong>{{ $date->busy_date->format('Y/m/d') }}</strong>
                                    <div style="font-size:.78rem; color:#6c7a72;">
                                        {{ ['Saturday'=>'السبت','Sunday'=>'الأحد','Monday'=>'الاثنين','Tuesday'=>'الثلاثاء',
                                            'Wednesday'=>'الأربعاء','Thursday'=>'الخميس','Friday'=>'الجمعة'][$date->busy_date->format('l')] }}
                                    </div>
                                </td>
                                <td style="padding:10px 16px; color:#6c7a72;">{{ $date->reason ?? '—' }}</td>
                                <td style="padding:10px 16px; text-align:center;">
                                    <form method="POST" action="{{ route('owner.busy-dates.remove', $date->id) }}"
                                          onsubmit="return confirm('إزالة هذا اليوم؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>

@endunless

@endsection
