@extends('layouts.dashboard')

@section('title', 'تم رفض الطلب')
@section('page-title', 'حالة الطلب')

@section('sidebar-nav')
    <a href="{{ route('owner.application-rejected') }}" class="nav-item active">
        <i class="fas fa-times-circle"></i> حالة الطلب
    </a>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
        @csrf
        <button type="submit" class="nav-item" style="width:100%; text-align:right; background:none; border:none; cursor:pointer; color:inherit; font-family:inherit; font-size:inherit; padding:inherit;">
            <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
        </button>
    </form>
@endsection

@section('content')

<div style="max-width:640px; margin:60px auto; text-align:center;">

    {{-- Rejection icon --}}
    <div style="width:100px; height:100px; border-radius:50%; background:linear-gradient(135deg,#fef2f2,#fee2e2);
                border:3px solid #fca5a5; display:flex; align-items:center; justify-content:center; margin:0 auto 28px;">
        <i class="fas fa-times-circle" style="font-size:2.8rem; color:#dc2626;"></i>
    </div>

    <h1 style="font-size:1.6rem; font-weight:800; color:#0f3d24; margin:0 0 12px;">
        لم يتم قبول طلبك
    </h1>
    <p style="font-size:.98rem; color:#6c7a72; line-height:1.8; margin:0 0 32px;">
        نأسف لإبلاغك بأن فريقنا لم يتمكن من قبول طلب تسجيل منشأتك في الوقت الحالي.<br>
        يمكنك الاطلاع على السبب أدناه والتواصل معنا لمزيد من التوضيح.
    </p>

    {{-- Rejection reason --}}
    @if($hall?->admin_note)
    <div style="background:#fef2f2; border:2px solid #fca5a5; border-radius:16px; padding:22px 28px; text-align:right; margin-bottom:24px;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">
            <i class="fas fa-comment-alt-exclamation" style="color:#dc2626;"></i>
            <span style="font-weight:800; color:#991b1b; font-size:.92rem;">سبب الرفض</span>
        </div>
        <p style="color:#7f1d1d; font-size:.92rem; line-height:1.7; margin:0;">{{ $hall->admin_note }}</p>
    </div>
    @else
    <div style="background:#fef2f2; border:2px solid #fca5a5; border-radius:16px; padding:22px 28px; text-align:right; margin-bottom:24px;">
        <p style="color:#7f1d1d; font-size:.9rem; margin:0;">لم يتم ذكر سبب محدد. يُرجى التواصل مع فريق الدعم للاستفسار.</p>
    </div>
    @endif

    {{-- Hall summary --}}
    @if($hall)
    <div style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:16px; padding:20px 28px; text-align:right; margin-bottom:28px;">
        <div style="font-size:.78rem; font-weight:700; color:#6c7a72; margin-bottom:12px;">بيانات الطلب المرفوض</div>
        <div style="display:flex; justify-content:space-between; font-size:.88rem; padding:7px 0; border-bottom:1px solid #f0f4f2;">
            <span style="color:#6c7a72;">اسم المنشأة</span>
            <span style="font-weight:700; color:#0f3d24;">{{ $hall->name }}</span>
        </div>
        <div style="display:flex; justify-content:space-between; font-size:.88rem; padding:7px 0; border-bottom:1px solid #f0f4f2;">
            <span style="color:#6c7a72;">تاريخ التقديم</span>
            <span style="font-weight:700; color:#0f3d24;">{{ $hall->created_at->format('Y/m/d') }}</span>
        </div>
        <div style="display:flex; justify-content:space-between; font-size:.88rem; padding:7px 0;">
            <span style="color:#6c7a72;">الحالة</span>
            <span style="background:#fef2f2; color:#dc2626; border:1px solid #fca5a5; border-radius:20px; padding:3px 12px; font-size:.8rem; font-weight:700;">
                <i class="fas fa-times" style="margin-left:4px;"></i> مرفوض
            </span>
        </div>
    </div>
    @endif

    {{-- Actions --}}
    <div style="display:flex; flex-direction:column; gap:12px; align-items:center;">
        <a href="{{ route('contact') }}"
           style="display:inline-flex; align-items:center; gap:8px; background:#1a5c38; color:#fff;
                  text-decoration:none; padding:13px 32px; border-radius:10px; font-size:.95rem; font-weight:700;">
            <i class="fas fa-envelope"></i> التواصل مع الدعم
        </a>
        <p style="font-size:.82rem; color:#9ca3af; margin:4px 0 0;">
            يمكنك التواصل معنا لتوضيح المشكلة وإعادة تقديم الطلب بعد التصحيح.
        </p>
    </div>

</div>

@endsection
