@extends('layouts.dashboard')

@section('title', 'تم رفض الطلب')
@section('page-title', 'حالة الطلب')

@section('sidebar-nav')
    <a href="{{ route('officiant.application-rejected') }}" class="nav-item active">
        <i class="fas fa-times-circle"></i> حالة الطلب
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

    <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#fdf0f0,#fee2e2);
                border:3px solid #fca5a5;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;">
        <i class="fas fa-times-circle" style="font-size:2.8rem;color:#dc2626;"></i>
    </div>

    <h2 style="font-size:1.6rem;font-weight:800;color:#7f1d1d;margin-bottom:12px;">تم رفض الطلب</h2>
    <p style="color:#6c7a72;font-size:14px;line-height:1.8;max-width:480px;margin:0 auto;">
        نأسف، لم تتم الموافقة على طلب تسجيلك كمأذون شرعي في الوقت الحالي.
    </p>

    @if($profile?->admin_note)
    <div style="margin-top:24px;background:#fee2e2;border:1px solid #fca5a5;border-radius:12px;padding:16px;text-align:right;">
        <strong style="color:#991b1b;">سبب الرفض:</strong>
        <p style="color:#7f1d1d;margin:6px 0 0;">{{ $profile->admin_note }}</p>
    </div>
    @endif

    <div style="margin-top:32px;">
        <a href="{{ route('login') }}" style="display:inline-block;padding:12px 28px;background:#1a5c38;color:#fff;border-radius:10px;text-decoration:none;font-weight:700;font-size:.9rem;">
            العودة لتسجيل الدخول
        </a>
    </div>
</div>
@endsection
