@extends('layouts.dashboard')

@section('title', 'تسجيل قاعة جديدة')
@section('page-title', 'تسجيل قاعة جديدة')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item active"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

<div style="max-width:660px;">

@if($errors->any())
<div class="alert alert-danger" style="margin-bottom:16px;">
    <strong><i class="fas fa-triangle-exclamation"></i> يرجى تصحيح الأخطاء:</strong>
    <ul style="margin-top:6px;padding-right:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-building"></i> بيانات القاعة الجديدة</span>
    </div>
    <div class="card-body">

        <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.84rem;color:#166534;">
            <i class="fas fa-circle-info"></i>
            القاعات التي تسجّلها مباشرة تُفعَّل فوراً في المنصة. نسبة عمولتك تُحسب من حجوزات هذه القاعة.
        </div>

        <form action="{{ route('manager.halls.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px 20px;">

                <div style="grid-column:1/-1;">
                    <label class="form-label">مالك القاعة <span style="color:red">*</span></label>
                    <select name="owner_id" class="form-control" required>
                        <option value="">— اختر مالك القاعة —</option>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ old('owner_id')==$owner->id?'selected':'' }}>
                                {{ $owner->name }} — {{ $owner->phone }}
                            </option>
                        @endforeach
                    </select>
                    <div style="font-size:.76rem;color:#6c7a72;margin-top:4px;">إذا لم يكن مسجلاً، سجّله أولاً كـ "مالك قاعة" من <a href="{{ route('supervisor.users.create') }}" style="color:#1a5c38;">لوحة المشرف</a>.</div>
                </div>

                <div>
                    <label class="form-label">اسم القاعة <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div>
                    <label class="form-label">المدينة <span style="color:red">*</span></label>
                    <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                </div>

                <div style="grid-column:1/-1;">
                    <label class="form-label">الموقع / العنوان <span style="color:red">*</span></label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                </div>

                <div style="grid-column:1/-1;">
                    <label class="form-label">وصف القاعة</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="form-label">السعة (أشخاص) <span style="color:red">*</span></label>
                    <input type="number" name="capacity" class="form-control" min="1" value="{{ old('capacity') }}" required>
                </div>

                <div>
                    <label class="form-label">عدد الطاولات <span style="color:red">*</span></label>
                    <input type="number" name="max_tables" class="form-control" min="1" value="{{ old('max_tables') }}" required>
                </div>

                <div>
                    <label class="form-label">السعر / يوم (ر.س) <span style="color:red">*</span></label>
                    <input type="number" name="price_per_day" class="form-control" min="0" step="0.01" value="{{ old('price_per_day') }}" required>
                </div>

                <div>
                    <label class="form-label">واتساب للتواصل</label>
                    <input type="text" name="whatsapp_number" class="form-control" placeholder="05XXXXXXXX" value="{{ old('whatsapp_number') }}">
                </div>

                <div style="grid-column:1/-1;">
                    <label class="form-label">نسبة عمولة التسجيل % <span style="color:#9ca3af;font-size:.78rem;">(العمولة التي تحصل عليها من كل حجز في هذه القاعة)</span></label>
                    <input type="number" name="registration_commission_rate" class="form-control" min="0" max="100" step="0.5" value="{{ old('registration_commission_rate', 5) }}">
                </div>

                <div>
                    <label class="form-label">صورة البروفايل</label>
                    <input type="file" name="profile_photo" class="form-control" accept="image/*">
                </div>

                <div>
                    <label class="form-label">صورة الغلاف</label>
                    <input type="file" name="cover_photo" class="form-control" accept="image/*">
                </div>

            </div>

            <div style="margin-top:22px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary" style="padding:12px 28px;">
                    <i class="fas fa-save"></i> تسجيل القاعة وتفعيلها
                </button>
                <a href="{{ route('manager.halls') }}" class="btn btn-outline">إلغاء</a>
            </div>
        </form>
    </div>
</div>
</div>

@endsection
