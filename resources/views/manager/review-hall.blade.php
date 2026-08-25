@extends('layouts.dashboard')

@section('title', 'مراجعة طلب القاعة')
@section('page-title', 'مراجعة طلب إضافة قاعة')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item active"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

<!-- Back link -->
<div style="margin-bottom:18px;">
    <a href="{{ route('manager.hall-requests') }}" style="color:#1a5c38; font-weight:700; text-decoration:none; font-size:.9rem;">
        <i class="fas fa-arrow-right"></i> العودة إلى قائمة الطلبات
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
                background:{{ $hall->status->value === 'pending' ? '#fffbeb' : ($hall->status->value === 'active' ? '#f0fdf4' : '#fef2f2') }};
                color:{{ $hall->status->value === 'pending' ? '#b45309' : ($hall->status->value === 'active' ? '#166534' : '#dc2626') }};
                border:1px solid {{ $hall->status->value === 'pending' ? '#fcd34d' : ($hall->status->value === 'active' ? '#86efac' : '#fca5a5') }};
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
                @if($hall->venue_type)
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">نوع المنشأة</td>
                    <td style="padding:10px 4px;">{{ ['hall' => 'قاعة أفراح', 'rest' => 'استراحة', 'chalet' => 'شاليه'][$hall->venue_type] ?? $hall->venue_type }}</td>
                </tr>
                @endif
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">مقدِّم الطلب</td>
                    <td style="padding:10px 4px; font-weight:700;">{{ $hall->owner?->name ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">البريد الإلكتروني</td>
                    <td style="padding:10px 4px;">{{ $hall->owner?->email ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 4px; color:#6c7a72;">الجوال</td>
                    <td style="padding:10px 4px;">{{ $hall->owner?->phone ?? '—' }}</td>
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
                    <td style="padding:10px 4px; font-weight:700; color:#1a5c38;">{{ number_format($hall->price_per_day, 0) }} ريال</td>
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
                    راجع تفاصيل القاعة والوثائق المرفوعة جيداً ثم اتخذ قرارك. عند القبول يُرسَل بريد إلكتروني تلقائي للمالك.
                </p>

                <form action="{{ route('manager.halls.decide', $hall->id) }}" method="POST">
                    @csrf

                    <div style="margin-bottom:14px;">
                        <label style="display:block; font-size:.85rem; font-weight:700; color:#374151; margin-bottom:6px;">
                            ملاحظة (اختيارية — تُرسَل في بريد الرفض)
                        </label>
                        <textarea name="note" rows="3"
                                  style="width:100%; border:1.5px solid #d1e8d8; border-radius:10px; padding:10px 12px; font-family:inherit; font-size:.85rem; resize:vertical; outline:none;"
                                  placeholder="سبب الرفض أو ملاحظات للمالك..."></textarea>
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
        <div class="card" style="margin-bottom:0; border:2px solid #86efac;">
            <div class="card-body" style="text-align:center; padding:28px 20px;">
                <i class="fas fa-check-circle" style="font-size:2.5rem; color:#16a34a; display:block; margin-bottom:10px;"></i>
                <div style="font-weight:800; font-size:1rem; color:#166534;">تمت الموافقة على هذه القاعة</div>
                <div style="font-size:.85rem; color:#6c7a72; margin-top:6px;">القاعة نشطة وتظهر في قائمة القاعات</div>
            </div>
        </div>

        @else
        <div class="card" style="margin-bottom:0; border:2px solid #fca5a5;">
            <div class="card-body" style="text-align:center; padding:28px 20px;">
                <i class="fas fa-times-circle" style="font-size:2.5rem; color:#dc2626; display:block; margin-bottom:10px;"></i>
                <div style="font-weight:800; font-size:1rem; color:#991b1b;">تم رفض هذا الطلب</div>
                <div style="font-size:.85rem; color:#6c7a72; margin-top:6px;">لن تظهر القاعة في قائمة القاعات</div>
            </div>
        </div>
        @endif

    </div><!-- /.right col -->
</div><!-- /.grid -->

<!-- ===== Verification Documents ===== -->
@if($hall->verificationDocuments->isNotEmpty())
<div class="card" style="margin-top:24px;">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-file-shield" style="color:#1a5c38;"></i> وثائق التحقق المرفوعة</span>
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
            <div style="padding:12px 14px;">
                <div style="font-weight:800; font-size:.88rem; color:#0f3d24; margin-bottom:4px;">
                    <i class="fas {{ $meta['icon'] }}" style="color:{{ $meta['color'] }}; margin-left:4px;"></i>
                    {{ $meta['label'] }}
                </div>
                @if($doc->expiry_date)
                <div style="font-size:.78rem; color:#6c7a72;">
                    <i class="fas fa-calendar-alt" style="margin-left:3px;"></i>
                    تنتهي: <strong style="color:{{ \Carbon\Carbon::parse($doc->expiry_date)->isPast() ? '#dc2626' : '#0f3d24' }};">
                        {{ \Carbon\Carbon::parse($doc->expiry_date)->format('Y/m/d') }}
                    </strong>
                    @if(\Carbon\Carbon::parse($doc->expiry_date)->isPast())
                        <span style="color:#dc2626; font-weight:700;"> (منتهية)</span>
                    @endif
                </div>
                @endif
                <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank"
                   style="display:inline-flex; align-items:center; gap:4px; margin-top:8px; font-size:.78rem;
                          color:#1a5c38; font-weight:700; text-decoration:none; background:#f0fdf4;
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
