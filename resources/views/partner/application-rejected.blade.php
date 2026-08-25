@extends('layouts.dashboard')

@section('title', 'طلبك مرفوض')
@section('page-title', 'حالة الطلب')

@section('sidebar-nav')
    <a href="{{ route('partner.application-rejected') }}" class="nav-item active">
        <i class="fas fa-times-circle"></i> حالة الطلب
    </a>
    <a href="{{ route('partner.profile-setup') }}" class="nav-item">
        <i class="fas fa-edit"></i> تعديل البروفايل
    </a>
@endsection

@section('content')
<div style="max-width:640px; margin:60px auto; text-align:center;">
    <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#fef2f2,#fee2e2);
                border:3px solid #fca5a5;display:flex;align-items:center;justify-content:center;margin:0 auto 28px;">
        <i class="fas fa-times-circle" style="font-size:2.8rem;color:#dc2626;"></i>
    </div>
    <h2 style="font-size:1.6rem;font-weight:800;color:#0f3d24;margin-bottom:12px;">تم رفض طلبك</h2>
    <p style="color:#6c7a72;font-size:14px;line-height:1.8;max-width:480px;margin:0 auto;">
        للأسف لم يتم قبول بروفايلك في الوقت الحالي.
        يمكنك تعديل بياناتك وإعادة التقديم.
    </p>
    @if($profile?->admin_note)
    <div style="margin-top:24px;background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:16px;text-align:right;">
        <strong style="color:#991b1b;">سبب الرفض:</strong>
        <p style="color:#7f1d1d;margin:6px 0 0;">{{ $profile->admin_note }}</p>
    </div>
    @endif
    <a href="{{ route('partner.profile-setup') }}"
       style="display:inline-flex;align-items:center;gap:8px;margin-top:28px;background:#1a5c38;color:#fff;
              padding:12px 28px;border-radius:12px;font-weight:700;font-size:14px;text-decoration:none;
              font-family:'Cairo',sans-serif;">
        <i class="fas fa-edit"></i> تعديل وإعادة التقديم
    </a>
</div>
@endsection
