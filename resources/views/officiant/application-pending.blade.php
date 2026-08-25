@extends('layouts.dashboard')

@section('title', 'طلبك قيد المراجعة')
@section('page-title', 'حالة الطلب')

@section('sidebar-nav')
    <a href="{{ route('officiant.application-pending') }}" class="nav-item active">
        <i class="fas fa-hourglass-half"></i> حالة الطلب
    </a>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
        @csrf
        <button type="submit" class="nav-item" style="width:100%;text-align:right;background:none;border:none;cursor:pointer;color:inherit;font-family:inherit;font-size:inherit;padding:inherit;">
            <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
        </button>
    </form>
@endsection

@section('content')
<div style="max-width:640px; margin:60px auto; text-align:center;">

    @if(session('success'))
    <div style="background:#e8f5ee;border:1.5px solid #52b788;border-radius:12px;padding:14px 20px;margin-bottom:28px;text-align:right;display:flex;align-items:center;gap:10px;">
        <i class="fas fa-check-circle" style="color:#1a5c38;font-size:1.2rem;"></i>
        <span style="color:#1a5c38;font-weight:700;font-size:.92rem;">{{ session('success') }}</span>
    </div>
    @endif

    <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#fffbeb,#fef3c7);
                border:3px solid #fcd34d;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;">
        <i class="fas fa-hourglass-half" style="font-size:2.8rem;color:#d97706;animation:spin 3s linear infinite;"></i>
    </div>
    <style>@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}</style>

    <h2 style="font-size:1.6rem;font-weight:800;color:#0f3d24;margin-bottom:12px;">طلبك قيد المراجعة</h2>
    <p style="color:#6c7a72;font-size:14px;line-height:1.8;max-width:480px;margin:0 auto;">
        تم استلام بيانات تسجيلك كمأذون شرعي وهي حالياً قيد المراجعة من قِبَل فريقنا.<br>
        ستصلك إشعار فور الموافقة أو الرفض.
    </p>

    @if($profile?->admin_note)
    <div style="margin-top:24px;background:#fef3c7;border:1px solid #fcd34d;border-radius:12px;padding:16px;text-align:right;">
        <strong style="color:#92400e;">ملاحظة الإدارة:</strong>
        <p style="color:#78350f;margin:6px 0 0;">{{ $profile->admin_note }}</p>
    </div>
    @endif
</div>
@endsection
