@extends('layouts.dashboard')

@section('title', 'تسجيل مالك قاعة')
@section('page-title', 'تسجيل مالك قاعة')

@section('sidebar-nav')
    <a href="{{ route('agent.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('agent.hall-owner-registration.create') }}" class="nav-item active"><i class="fas fa-user-plus"></i> تسجيل مالك قاعة</a>
    <a href="{{ route('agent.referrals') }}" class="nav-item"><i class="fas fa-link"></i> إحالاتي</a>
    <a href="{{ route('agent.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات المتاحة</a>
@endsection

@section('content')
<div style="max-width:980px;">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-user-plus"></i> تسجيل مالك قاعة</span>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:14px; font-size:.85rem;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger" style="margin-bottom:14px; font-size:.85rem;">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('agent.hall-owner-registration.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px 18px;">
                    <div style="grid-column:1/-1;">
                        <label class="form-label">مالك القاعة <span style="color:red">*</span></label>
                        <input type="text" name="owner_name" class="form-control" placeholder="اسم مالك القاعة" value="{{ old('owner_name') }}" required>
                    </div>

                    <div>
                        <label class="form-label">رقم جوال مالك القاعة <span style="color:red">*</span></label>
                        <input type="text" name="owner_phone" class="form-control" placeholder="05XXXXXXXX" value="{{ old('owner_phone') }}" required>
                    </div>

                    <div>
                        <label class="form-label">البريد الإلكتروني <span style="color:red">*</span></label>
                        <input type="email" name="owner_email" class="form-control" placeholder="owner@example.com" value="{{ old('owner_email') }}" required>
                    </div>

                    <div>
                        <label class="form-label">كلمة المرور <span style="color:red">*</span></label>
                        <input type="text" name="owner_password" class="form-control" placeholder="8 أحرف على الأقل" value="{{ old('owner_password') }}" required>
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
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">عدد الطاولات <span style="color:red">*</span></label>
                        <input type="number" name="max_tables" class="form-control" min="1" value="{{ old('max_tables') }}" required>
                    </div>

                    <div>
                        <label class="form-label">السعة (أشخاص) <span style="color:red">*</span></label>
                        <input type="number" name="capacity" class="form-control" min="1" value="{{ old('capacity') }}" required>
                    </div>

                    <div>
                        <label class="form-label">واتساب للتواصل</label>
                        <input type="text" name="whatsapp_number" class="form-control" placeholder="05XXXXXXXX" value="{{ old('whatsapp_number') }}">
                    </div>

                    <div>
                        <label class="form-label">السعر / يوم (ر.س) <span style="color:red">*</span></label>
                        <input type="number" name="price_per_day" class="form-control" min="0" step="0.01" value="{{ old('price_per_day') }}" required>
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

                <button type="submit" class="btn btn-primary" style="width:100%;margin-top:16px;">
                    <i class="fas fa-save"></i> تسجيل مالك القاعة
                </button>
            </form>

            <div style="margin-top:14px; background:#f0f9ff; border-radius:10px; padding:12px; font-size:.78rem; color:#0369a1; line-height:1.6;">
                <i class="fas fa-circle-info"></i>
                سيتم إنشاء حساب مالك القاعة وتسجيل القاعة باسم المندوب الحالي، ثم تُرسل للمراجعة قبل التفعيل.
            </div>
        </div>
    </div>
</div>
@endsection
