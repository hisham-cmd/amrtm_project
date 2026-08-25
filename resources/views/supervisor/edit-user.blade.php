@extends('layouts.dashboard')

@section('title', 'تعديل حساب')
@section('page-title', 'تعديل بيانات المستخدم')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item active"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('supervisor.users') }}" style="color:var(--navy); font-weight:700; text-decoration:none; font-size:.9rem;">
        <i class="fas fa-arrow-right"></i> العودة إلى قائمة المستخدمين
    </a>
</div>

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger" style="margin-bottom:16px;">
    <strong><i class="fas fa-triangle-exclamation"></i> يرجى تصحيح الأخطاء:</strong>
    <ul style="margin-top:6px; padding-right:18px;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

<div style="max-width:620px;">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-pen"></i> تعديل: {{ $user->name }}</span>
            @if($user->role->value === 'agent' && $user->refCode)
                <span style="background:var(--navy-pale); color:var(--navy); border:1px solid rgba(13,36,72,.15); border-radius:8px; padding:4px 12px; font-size:.82rem; font-weight:700;">
                    كود الإحالة: {{ $user->refCode->code }}
                </span>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('supervisor.users.update', $user->id) }}" method="POST">
                @csrf @method('PUT')

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px 20px;">

                    <div style="grid-column:1/-1;">
                        <label class="form-label">الدور <span style="color:red">*</span></label>
                        <select name="role" class="form-control" required>
                            <option value="supervisor" {{ $user->role->value==='supervisor'?'selected':'' }}>مشرف النظام</option>
                            <option value="manager"    {{ $user->role->value==='manager'   ?'selected':'' }}>مدير المشروع</option>
                            <option value="agent"      {{ $user->role->value==='agent'     ?'selected':'' }}>مندوب</option>
                            <option value="owner"      {{ $user->role->value==='owner'     ?'selected':'' }}>مالك القاعة</option>
                            <option value="user"       {{ $user->role->value==='user'      ?'selected':'' }}>مستخدم</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">الاسم الكامل <span style="color:red">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div>
                        <label class="form-label">رقم الجوال <span style="color:red">*</span></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                    </div>

                    <div style="grid-column:1/-1;">
                        <label class="form-label">البريد الإلكتروني <span style="color:red">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div>
                        <label class="form-label">كلمة مرور جديدة <span style="color:#9ca3af; font-size:.78rem;">(اتركها فارغة للإبقاء على القديمة)</span></label>
                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور الجديدة">
                    </div>

                    <div>
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور">
                    </div>

                </div>

                <div style="margin-top:22px; display:flex; gap:10px;">
                    <button type="submit" class="btn btn-primary" style="padding:12px 28px;">
                        <i class="fas fa-save"></i> حفظ التعديلات
                    </button>
                    <a href="{{ route('supervisor.users') }}" class="btn btn-outline">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
