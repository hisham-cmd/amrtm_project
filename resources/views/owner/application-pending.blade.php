@extends('layouts.dashboard')

@section('title', 'طلبك قيد المراجعة')
@section('page-title', 'حالة الطلب')

@section('sidebar-nav')
    <a href="{{ route('owner.application-pending') }}" class="nav-item active">
        <i class="fas fa-hourglass-half"></i> حالة الطلب
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

    @if(session('success'))
    <div style="background:#e8f5ee;border:1.5px solid #52b788;border-radius:12px;padding:14px 20px;margin-bottom:28px;text-align:right;display:flex;align-items:center;gap:10px;">
        <i class="fas fa-check-circle" style="color:#1a5c38;font-size:1.2rem;"></i>
        <span style="color:#1a5c38;font-weight:700;font-size:.92rem;">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Animated hourglass icon --}}
    <div style="width:100px; height:100px; border-radius:50%; background:linear-gradient(135deg,#fffbeb,#fef3c7);
                border:3px solid #fcd34d; display:flex; align-items:center; justify-content:center; margin:0 auto 28px;">
        <i class="fas fa-hourglass-half" style="font-size:2.8rem; color:#d97706;
           animation: spin 3s linear infinite;"></i>
    </div>

    <style>
        @keyframes spin {
            0%   { transform: rotate(0deg); }
            45%  { transform: rotate(0deg); }
            55%  { transform: rotate(180deg); }
            100% { transform: rotate(180deg); }
        }
    </style>

    <h1 style="font-size:1.6rem; font-weight:800; color:#0f3d24; margin:0 0 12px;">
        طلبك قيد المراجعة
    </h1>
    <p style="font-size:.98rem; color:#6c7a72; line-height:1.8; margin:0 0 32px;">
        شكراً لتسجيلك في منصة <strong>أمر تم</strong>. فريقنا المختص يراجع بيانات منشأتك حالياً.<br>
        سيتم إشعارك فور اتخاذ القرار عبر البريد الإلكتروني.
    </p>

    {{-- Hall info summary card --}}
    @if($hall)
    <div style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:16px; padding:24px 28px; text-align:right; margin-bottom:28px;">
        <div style="font-size:.78rem; font-weight:700; color:#6c7a72; text-transform:uppercase; letter-spacing:.05em; margin-bottom:14px;">
            بيانات طلبك
        </div>
        <div style="display:flex; flex-direction:column; gap:10px;">
            <div style="display:flex; justify-content:space-between; font-size:.9rem; padding:8px 0; border-bottom:1px solid #f0f4f2;">
                <span style="color:#6c7a72; font-weight:600;">اسم المنشأة</span>
                <span style="font-weight:700; color:#0f3d24;">{{ $hall->name }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; font-size:.9rem; padding:8px 0; border-bottom:1px solid #f0f4f2;">
                <span style="color:#6c7a72; font-weight:600;">المدينة</span>
                <span style="font-weight:700; color:#0f3d24;">{{ $hall->city }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; font-size:.9rem; padding:8px 0; border-bottom:1px solid #f0f4f2;">
                <span style="color:#6c7a72; font-weight:600;">تاريخ التقديم</span>
                <span style="font-weight:700; color:#0f3d24;">{{ $hall->created_at->format('Y/m/d') }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; font-size:.9rem; padding:8px 0;">
                <span style="color:#6c7a72; font-weight:600;">الحالة</span>
                <span style="background:#fffbeb; color:#b45309; border:1px solid #fcd34d; border-radius:20px; padding:3px 12px; font-size:.8rem; font-weight:700;">
                    <i class="fas fa-clock" style="margin-left:4px;"></i> قيد المراجعة
                </span>
            </div>
        </div>
    </div>
    @endif

    {{-- Steps indicator --}}
    <div style="background:#fff; border:1.5px solid #e2e8f0; border-radius:16px; padding:20px 28px; text-align:right; margin-bottom:28px;">
        <div style="font-size:.82rem; font-weight:700; color:#374151; margin-bottom:16px;">مراحل الطلب</div>
        <div style="display:flex; flex-direction:column; gap:12px;">
            @php
            $steps = [
                ['label' => 'تسجيل بيانات المنشأة',      'done' => true],
                ['label' => 'رفع الوثائق المطلوبة',       'done' => true],
                ['label' => 'مراجعة الطلب من قبل الفريق', 'active' => true],
                ['label' => 'تفعيل الحساب',               'done' => false],
            ];
            @endphp
            @foreach($steps as $step)
            <div style="display:flex; align-items:center; gap:12px;">
                <div style="width:28px; height:28px; border-radius:50%; flex-shrink:0; display:flex; align-items:center; justify-content:center;
                    background:{{ isset($step['active']) ? '#fffbeb' : (($step['done'] ?? false) ? '#f0fdf4' : '#f8fafc') }};
                    border:2px solid {{ isset($step['active']) ? '#fcd34d' : (($step['done'] ?? false) ? '#86efac' : '#e2e8f0') }};">
                    @if($step['done'] ?? false)
                        <i class="fas fa-check" style="font-size:.7rem; color:#16a34a;"></i>
                    @elseif(isset($step['active']))
                        <i class="fas fa-spinner fa-spin" style="font-size:.65rem; color:#d97706;"></i>
                    @else
                        <i class="fas fa-circle" style="font-size:.4rem; color:#d1d5db;"></i>
                    @endif
                </div>
                <span style="font-size:.88rem; color:{{ isset($step['active']) ? '#b45309' : (($step['done'] ?? false) ? '#166534' : '#9ca3af') }}; font-weight:{{ isset($step['active']) ? '700' : '500' }};">
                    {{ $step['label'] }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <p style="font-size:.82rem; color:#9ca3af;">
        في حال استفساراتك تواصل معنا عبر
        <a href="{{ route('contact') }}" style="color:#1a5c38; font-weight:700; text-decoration:none;">صفحة التواصل</a>
    </p>
</div>

@endsection
