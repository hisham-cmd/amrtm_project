@extends('layouts.dashboard')

@section('title', 'إنشاء حساب جديد')
@section('page-title', 'إنشاء حساب جديد')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item active"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
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

<div style="max-width:620px;">

    @if($errors->any())
    <div class="alert alert-danger" style="margin-bottom:16px;">
        <strong><i class="fas fa-triangle-exclamation"></i> يرجى تصحيح الأخطاء:</strong>
        <ul style="margin-top:6px; padding-right:18px;">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-user-plus"></i> بيانات الحساب الجديد</span>
        </div>
        <div class="card-body">

            <div style="background:var(--navy-pale);border:1px solid rgba(13,36,72,.15);border-right:4px solid var(--gold);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.85rem;color:var(--navy);line-height:1.6;">
                <strong><i class="fas fa-circle-info" style="color:var(--gold);"></i> ملاحظة:</strong>
                الحسابات التي يمكنك إنشاؤها: <strong>مشرف نظام — مدير مشروع — مندوب — مالك قاعة</strong>.
                سيحصل المندوب تلقائياً على كود إحالة خاص به.
                المستخدمون العاديون يسجلون بأنفسهم عبر صفحة التسجيل.
            </div>

            <form action="{{ route('supervisor.users.store') }}" method="POST">
                @csrf

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px 20px;">

                    <div style="grid-column:1/-1;">
                        <label class="form-label">الدور <span style="color:red">*</span></label>
                        <select name="role" class="form-control {{ $errors->has('role')?'is-invalid':'' }}" required id="roleSelect">
                            <option value="">— اختر الدور —</option>
                            <option value="supervisor" {{ old('role')==='supervisor'?'selected':'' }}>مشرف النظام</option>
                            <option value="manager"    {{ old('role')==='manager'   ?'selected':'' }}>مدير المشروع</option>
                            <option value="agent"      {{ old('role')==='agent'     ?'selected':'' }}>مندوب</option>
                            <option value="owner"      {{ old('role')==='owner'     ?'selected':'' }}>مالك القاعة</option>
                        </select>
                        @error('role')<span class="field-error" style="color:red;font-size:.8rem;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="form-label">الاسم الكامل <span style="color:red">*</span></label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}"
                               value="{{ old('name') }}" placeholder="مثال: أحمد المطيري" required>
                        @error('name')<span style="color:red;font-size:.8rem;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="form-label">رقم الجوال <span style="color:red">*</span></label>
                        <input type="text" name="phone" class="form-control {{ $errors->has('phone')?'is-invalid':'' }}"
                               value="{{ old('phone') }}" placeholder="05XXXXXXXX" required>
                        @error('phone')<span style="color:red;font-size:.8rem;">{{ $message }}</span>@enderror
                    </div>

                    <div style="grid-column:1/-1;">
                        <label class="form-label">البريد الإلكتروني <span style="color:red">*</span></label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}"
                               value="{{ old('email') }}" placeholder="example@domain.com" required>
                        @error('email')<span style="color:red;font-size:.8rem;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="form-label">كلمة المرور <span style="color:red">*</span></label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}"
                               placeholder="8 أحرف على الأقل" required>
                        @error('password')<span style="color:red;font-size:.8rem;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="form-label">تأكيد كلمة المرور <span style="color:red">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="أعد كتابة كلمة المرور" required>
                    </div>

                </div>

                <div id="agentNote" style="display:none;margin-top:14px;background:rgba(245,158,11,.07);border:1px solid rgba(245,158,11,.25);border-radius:10px;padding:12px 16px;font-size:.84rem;color:var(--navy);">
                    <i class="fas fa-link" style="color:var(--gold);"></i>
                    سيتم إنشاء <strong>كود إحالة فريد</strong> للمندوب تلقائياً بعد حفظ الحساب.
                </div>

                <div style="margin-top:22px; display:flex; gap:10px;">
                    <button type="submit" class="btn btn-primary" style="padding:12px 28px;">
                        <i class="fas fa-save"></i> حفظ وإنشاء الحساب
                    </button>
                    <a href="{{ route('supervisor.users') }}" class="btn btn-light">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('roleSelect').addEventListener('change', function() {
        document.getElementById('agentNote').style.display = this.value === 'agent' ? 'block' : 'none';
    });
</script>

@endsection
