@extends('layouts.dashboard')

@section('title', 'تسجيل مندوب جديد')
@section('page-title', 'تسجيل مندوب جديد')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item active"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

<div style="max-width:540px;">

@if($errors->any())
<div class="alert alert-danger" style="margin-bottom:16px;">
    <ul style="margin:0;padding-right:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-user-plus"></i> بيانات المندوب الجديد</span>
    </div>
    <div class="card-body">

        <div style="background:#f5f3ff;border:1px solid #c4b5fd;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.84rem;color:#5b21b6;">
            <i class="fas fa-link"></i>
            سيتم إنشاء <strong>كود إحالة فريد</strong> للمندوب تلقائياً بعد حفظ الحساب.
        </div>

        <form action="{{ route('manager.agents.store') }}" method="POST">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px 20px;">

                <div>
                    <label class="form-label">الاسم الكامل <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="مثال: محمد العتيبي" required>
                </div>

                <div>
                    <label class="form-label">رقم الجوال <span style="color:red">*</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="05XXXXXXXX" required>
                </div>

                <div style="grid-column:1/-1;">
                    <label class="form-label">البريد الإلكتروني <span style="color:red">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="example@domain.com" required>
                </div>

                <div>
                    <label class="form-label">كلمة المرور <span style="color:red">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="8 أحرف على الأقل" required>
                </div>

                <div>
                    <label class="form-label">تأكيد كلمة المرور <span style="color:red">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

            </div>

            <div style="margin-top:22px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary" style="padding:12px 28px;">
                    <i class="fas fa-save"></i> حفظ وإنشاء الحساب
                </button>
                <a href="{{ route('manager.agents') }}" class="btn btn-outline">إلغاء</a>
            </div>
        </form>
    </div>
</div>
</div>

@endsection
