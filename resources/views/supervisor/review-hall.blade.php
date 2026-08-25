@extends('layouts.dashboard')

@section('title', 'مراجعة طلب القاعة')
@section('page-title', 'مراجعة طلب إضافة قاعة')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item active"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

<!-- Back link -->
<div style="margin-bottom:18px;">
    <a href="{{ route('supervisor.halls') }}" style="color:var(--navy); font-weight:700; text-decoration:none; font-size:.9rem;">
        <i class="fas fa-arrow-right"></i> العودة إلى قائمة القاعات
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success" style="margin-bottom:16px;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div style="display:grid; grid-template-columns:1.4fr 1fr; gap:24px; align-items:start;">

    <!-- ===== Hall Details ===== -->
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-building"></i> تفاصيل القاعة</span>
            <span style="
                padding:4px 12px; border-radius:20px; font-size:.78rem; font-weight:700;
                background:{{ $hall->status->value === 'pending' ? '#fffbeb' : ($hall->status->value === 'active' ? 'var(--navy-pale)' : '#fef2f2') }};
                color:{{ $hall->status->value === 'pending' ? '#b45309' : ($hall->status->value === 'active' ? 'var(--navy)' : '#dc2626') }};
                border:1px solid {{ $hall->status->value === 'pending' ? '#fcd34d' : ($hall->status->value === 'active' ? 'rgba(13,36,72,.2)' : '#fca5a5') }};
            ">
                {{ $hall->status->value === 'pending' ? 'قيد المراجعة' : ($hall->status->value === 'active' ? 'نشط' : 'مرفوض') }}
            </span>
        </div>
        <div class="card-body">

            @if($hall->cover_photo)
                <img src="{{ asset('storage/' . $hall->cover_photo) }}"
                     style="width:100%; height:180px; object-fit:cover; border-radius:10px; margin-bottom:16px;" alt="غلاف">
            @endif

            <table style="width:100%; font-size:.9rem; border-collapse:collapse;">
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72; width:160px; white-space:nowrap;">اسم القاعة</td>
                    <td style="padding:10px 4px; font-weight:700;">{{ $hall->name }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">مقدِّم الطلب</td>
                    <td style="padding:10px 4px; font-weight:700;">{{ $hall->owner?->name ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">البريد الإلكتروني</td>
                    <td style="padding:10px 4px;">{{ $hall->owner?->email ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">المدينة</td>
                    <td style="padding:10px 4px;">{{ $hall->city }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">العنوان</td>
                    <td style="padding:10px 4px;">{{ $hall->location }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">الطاقة الاستيعابية</td>
                    <td style="padding:10px 4px;">{{ number_format($hall->capacity) }} شخص</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">عدد الطاولات</td>
                    <td style="padding:10px 4px;">{{ number_format($hall->max_tables) }} طاولة</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">السعر لليوم</td>
                    <td style="padding:10px 4px; font-weight:700; color:var(--navy);">{{ number_format($hall->price_per_day, 0) }} ريال</td>
                </tr>
                @if($hall->whatsapp_number)
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">واتساب</td>
                    <td style="padding:10px 4px;">{{ $hall->whatsapp_number }}</td>
                </tr>
                @endif
                @if($hall->description)
                <tr>
                    <td style="padding:10px 4px; color:#6c7a72; vertical-align:top;">الوصف</td>
                    <td style="padding:10px 4px; line-height:1.6; color:#374151;">{{ $hall->description }}</td>
                </tr>
                @endif
            </table>

            @if($hall->profile_photo)
                <div style="margin-top:14px;">
                    <div style="font-size:.8rem; color:#6c7a72; font-weight:700; margin-bottom:6px;">صورة الملف الشخصي</div>
                    <img src="{{ asset('storage/' . $hall->profile_photo) }}"
                         style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid #d1e8d8;" alt="profile">
                </div>
            @endif
        </div>
    </div>

    <!-- ===== Decision Card ===== -->
    <div style="display:flex; flex-direction:column; gap:18px;">

        @if($hall->status->value === 'pending')
        <div class="card" style="margin-bottom:0; border:2px solid #fcd34d;">
            <div class="card-header" style="background:#fffbeb;">
                <span class="card-title" style="color:#b45309;"><i class="fas fa-clock"></i> في انتظار القرار</span>
            </div>
            <div class="card-body">
                <p style="font-size:.88rem; color:#6c7a72; margin-bottom:18px; line-height:1.6;">
                    راجع تفاصيل القاعة جيداً ثم اتخذ قرارك بالقبول أو الرفض. في حالة القبول ستظهر القاعة فوراً في قائمة القاعات المتاحة للحجز.
                </p>

                <form action="{{ route('supervisor.halls.decide', $hall->id) }}" method="POST">
                    @csrf

                    <div style="margin-bottom:14px;">
                        <label style="display:block; font-size:.85rem; font-weight:700; color:#374151; margin-bottom:6px;">
                            ملاحظة (اختيارية)
                        </label>
                        <textarea name="note" rows="3"
                                  style="width:100%; border:1.5px solid #d1e8d8; border-radius:10px; padding:10px 12px; font-family:inherit; font-size:.85rem; resize:vertical; outline:none;"
                                  placeholder="سبب القبول أو الرفض..."></textarea>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <button type="submit" name="decision" value="active"
                                style="display:flex; align-items:center; justify-content:center; gap:8px;
                                       background:#16a34a; color:#fff; border:none; border-radius:10px;
                                       padding:13px; font-size:14px; font-weight:800; font-family:inherit; cursor:pointer;">
                            <i class="fas fa-check-circle"></i>
                            قبول الطلب وتفعيل القاعة
                        </button>
                        <button type="submit" name="decision" value="rejected"
                                onclick="return confirm('هل أنت متأكد من رفض هذا الطلب؟')"
                                style="display:flex; align-items:center; justify-content:center; gap:8px;
                                       background:#dc2626; color:#fff; border:none; border-radius:10px;
                                       padding:13px; font-size:14px; font-weight:800; font-family:inherit; cursor:pointer;">
                            <i class="fas fa-times-circle"></i>
                            رفض الطلب
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @elseif($hall->status->value === 'active')
        <div class="card" style="margin-bottom:0; border:2px solid rgba(13,36,72,.2);">
            <div class="card-body" style="text-align:center; padding:28px 20px;">
                <i class="fas fa-check-circle" style="font-size:2.5rem; color:var(--navy); display:block; margin-bottom:10px;"></i>
                <div style="font-weight:800; font-size:1rem; color:var(--navy);">تمت الموافقة على هذه القاعة</div>
                <div style="font-size:.85rem; color:#6c7a72; margin-top:6px;">القاعة نشطة وتظهر في قائمة القاعات</div>
            </div>
        </div>

        @else
        <div class="card" style="margin-bottom:0; border:2px solid #fca5a5;">
            <div class="card-body" style="text-align:center; padding:28px 20px;">
                <i class="fas fa-times-circle" style="font-size:2.5rem; color:#dc2626; display:block; margin-bottom:10px;"></i>
                <div style="font-weight:800; font-size:1rem; color:#991b1b;">تم رفض هذا الطلب</div>
                <div style="font-size:.85rem; color:#6c7a72; margin-top:6px;">لن تظهر القاعة في قائمة القاعات</div>
                <!-- Reactivate -->
                <form action="{{ route('supervisor.halls.status', $hall->id) }}" method="POST" style="margin-top:16px;">
                    @csrf
                    <input type="hidden" name="status" value="active">
                    <button type="submit"
                            style="background:var(--navy); color:#fff; border:none; border-radius:8px; padding:10px 22px;
                                   font-size:.85rem; font-weight:700; font-family:inherit; cursor:pointer;">
                        <i class="fas fa-undo"></i> إعادة التفعيل
                    </button>
                </form>
            </div>
        </div>
        @endif

    </div><!-- /.right col -->
</div><!-- /.grid -->

<!-- ===== Verification Documents ===== -->
@if($hall->verificationDocuments->isNotEmpty())
<div class="card" style="margin-top:24px;">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-file-shield" style="color:var(--navy);"></i> وثائق التحقق المرفوعة</span>
        <span style="font-size:.82rem; color:#6c7a72;">{{ $hall->verificationDocuments->count() }} وثيقة</span>
    </div>
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px,1fr)); gap:16px; padding:20px;">
        @php
        $typeLabels = [
            'commercial_register' => ['label' => 'السجل التجاري',       'icon' => 'fa-file-certificate', 'color' => '#0284c7'],
            'municipal_license'   => ['label' => 'الرخصة البلدية',       'icon' => 'fa-building-columns', 'color' => '#7c3aed'],
            'operating_license'   => ['label' => 'رخصة التشغيل',         'icon' => 'fa-gears',            'color' => '#d97706'],
            'civil_defense'       => ['label' => 'شهادة الدفاع المدني',  'icon' => 'fa-shield-halved',    'color' => '#dc2626'],
        ];
        @endphp
        @foreach($hall->verificationDocuments as $doc)
        @php
            $meta  = $typeLabels[$doc->document_type] ?? ['label' => $doc->document_type, 'icon' => 'fa-file', 'color' => '#6c7a72'];
            $ext   = strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION));
            $isImg = in_array($ext, ['jpg','jpeg','png','webp','gif']);
        @endphp
        <div style="border:1.5px solid #e2e8f0; border-radius:12px; overflow:hidden; background:#fff;">
            <!-- Preview -->
            @if($isImg)
            <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank">
                <img src="{{ route('public.storage', ['path' => $doc->file_path]) }}"
                     style="width:100%; height:140px; object-fit:cover; display:block;" alt="{{ $meta['label'] }}">
            </a>
            @else
            <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank"
               style="display:flex; align-items:center; justify-content:center; height:140px; background:#f8fafc; text-decoration:none;">
                <i class="fas {{ $meta['icon'] }}" style="font-size:3rem; color:{{ $meta['color'] }};"></i>
            </a>
            @endif
            <!-- Info -->
            <div style="padding:12px 14px;">
                <div style="font-weight:800; font-size:.88rem; color:var(--text-dark); margin-bottom:4px;">
                    <i class="fas {{ $meta['icon'] }}" style="color:{{ $meta['color'] }}; margin-left:4px;"></i>
                    {{ $meta['label'] }}
                </div>
                @if($doc->expiry_date)
                <div style="font-size:.78rem; color:#6c7a72;">
                    <i class="fas fa-calendar-alt" style="margin-left:3px;"></i>
                    تنتهي: <strong style="color:{{ \Carbon\Carbon::parse($doc->expiry_date)->isPast() ? '#dc2626' : 'var(--navy)' }};">
                        {{ \Carbon\Carbon::parse($doc->expiry_date)->format('Y/m/d') }}
                    </strong>
                    @if(\Carbon\Carbon::parse($doc->expiry_date)->isPast())
                        <span style="color:#dc2626; font-weight:700;"> (منتهية)</span>
                    @endif
                </div>
                @endif
                <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank"
                   style="display:inline-flex; align-items:center; gap:4px; margin-top:8px; font-size:.78rem;
                          color:var(--navy); font-weight:700; text-decoration:none; background:var(--navy-pale);
                          padding:4px 10px; border-radius:6px; border:1px solid #d1e8d8;">
                    <i class="fas fa-download"></i> عرض / تحميل
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection
