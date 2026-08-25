@extends('layouts.dashboard')

@section('title', 'تفاصيل الشريك')
@section('page-title', 'تفاصيل الشريك')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item active"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="section-card mb-5">
    <div class="section-header">
        <h2><i class="fas fa-id-card text-green-600 ml-2"></i> {{ $partner->company_name }}</h2>
        <div class="flex gap-2">
            <a href="{{ route('partners.profile', $partner->id) }}" target="_blank" class="btn-secondary btn-sm">
                <i class="fas fa-eye"></i> البروفايل العام
            </a>
            <a href="{{ route($routePrefix . '.index') }}" class="btn-secondary btn-sm">
                <i class="fas fa-arrow-right"></i> رجوع
            </a>
        </div>
    </div>

    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Profile info --}}
        <div class="flex gap-4 items-start md:col-span-2">
            @if($partner->logo_url)
            <img src="{{ $partner->logo_url }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 shrink-0">
            @endif
            <div>
                <div class="text-lg font-extrabold text-[#0f3d24]">{{ $partner->company_name }}</div>
                <div class="text-sm text-gray-500">{{ $partner->category?->name }} — {{ $partner->city }}</div>
                @if($partner->address)<div class="text-xs text-gray-400 mt-1">{{ $partner->address }}</div>@endif
                @if($partner->description)<p class="text-sm text-gray-600 mt-2">{{ $partner->description }}</p>@endif
            </div>
        </div>

        <div>
            <div class="text-xs text-gray-400 uppercase font-bold mb-2">بيانات التواصل</div>
            @if($partner->phone)<div class="flex items-center gap-2 text-sm py-1"><i class="fas fa-phone text-green-600 w-4"></i> {{ $partner->phone }}</div>@endif
            @if($partner->whatsapp)<div class="flex items-center gap-2 text-sm py-1"><i class="fab fa-whatsapp text-green-600 w-4"></i> {{ $partner->whatsapp }}</div>@endif
            @if($partner->website)<div class="flex items-center gap-2 text-sm py-1"><i class="fas fa-globe text-green-600 w-4"></i> <a href="{{ $partner->website }}" target="_blank" class="text-blue-600 underline">{{ $partner->website }}</a></div>@endif
        </div>

        <div>
            <div class="text-xs text-gray-400 uppercase font-bold mb-2">الحساب</div>
            <div class="text-sm">{{ $partner->user?->name }}</div>
            <div class="text-xs text-gray-400">{{ $partner->user?->email }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $partner->user?->phone }}</div>
        </div>
    </div>

    {{-- Status update --}}
    <div class="border-t border-gray-100 p-5">
        <div class="text-xs text-gray-400 uppercase font-bold mb-3">تغيير الحالة</div>
        <form method="POST" action="{{ route($routePrefix . '.status', $partner) }}" class="flex gap-3 flex-wrap items-end">
            @csrf @method('PATCH')
            <div class="flex-1 min-w-[200px]">
                <select name="status" class="form-input">
                    <option value="active"   {{ $partner->status === 'active'   ? 'selected' : '' }}>نشط</option>
                    <option value="pending"  {{ $partner->status === 'pending'  ? 'selected' : '' }}>قيد المراجعة</option>
                    <option value="rejected" {{ $partner->status === 'rejected' ? 'selected' : '' }}>مرفوض</option>
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="admin_note" value="{{ $partner->admin_note }}" class="form-input" placeholder="ملاحظة الإدارة (اختياري)">
            </div>
            <button type="submit" class="btn-primary">تحديث الحالة</button>
        </form>
    </div>
</div>

{{-- Services --}}
@if($partner->services->isNotEmpty())
<div class="section-card mb-5">
    <div class="section-header">
        <h2><i class="fas fa-list-check text-green-600 ml-2"></i> الخدمات ({{ $partner->services->count() }})</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>الخدمة</th><th>الوصف</th><th>السعر</th></tr></thead>
            <tbody>
                @foreach($partner->services as $svc)
                <tr>
                    <td class="font-bold">{{ $svc->title }}</td>
                    <td class="text-gray-500 text-sm">{{ $svc->description ?? '—' }}</td>
                    <td>{{ $svc->price ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Verification Documents --}}
@if($partner->verificationDocuments->isNotEmpty())
<div class="section-card mb-5">
    <div class="section-header">
        <h2><i class="fas fa-file-signature text-green-600 ml-2"></i> وثائق التوثيق ({{ $partner->verificationDocuments->count() }})</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr><th>نوع الوثيقة</th><th>تاريخ الانتهاء</th><th>الحالة</th><th>الملف</th><th>إجراء</th></tr>
            </thead>
            <tbody>
                @foreach($partner->verificationDocuments as $doc)
                @php
                    $docLabels = [
                        'commercial_register' => 'السجل التجاري',
                        'municipal_license'   => 'الرخصة البلدية',
                        'operating_license'   => 'رخصة التشغيل',
                        'civil_defense'       => 'موافقة الدفاع المدني',
                        'work_license'        => 'رخصة العمل',
                    ];
                    $statusColors = ['pending' => '#d97706', 'approved' => '#16a34a', 'rejected' => '#dc2626'];
                    $statusLabels = ['pending' => 'قيد المراجعة', 'approved' => 'مقبول', 'rejected' => 'مرفوض'];
                    $st = $doc->status instanceof \App\Enums\DocumentStatus ? $doc->status->value : $doc->status;
                @endphp
                <tr>
                    <td class="font-bold">{{ $docLabels[$doc->document_type] ?? $doc->document_type }}</td>
                    <td>{{ $doc->expiry_date ? \Carbon\Carbon::parse($doc->expiry_date)->format('Y/m/d') : '—' }}</td>
                    <td><span style="color:{{ $statusColors[$st] ?? '#6c7a72' }};font-weight:700;">{{ $statusLabels[$st] ?? $st }}</span></td>
                    <td>
                        <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank"
                           style="background:#f1f5f9;color:#374151;border-radius:7px;padding:5px 12px;font-size:.8rem;font-weight:700;text-decoration:none;border:1px solid #e2e8f0;">
                            <i class="fas fa-eye"></i> عرض
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('supervisor.approvals.review', $doc->id) }}"
                           style="background:#1a5c38;color:#fff;border-radius:7px;padding:5px 12px;font-size:.8rem;font-weight:700;text-decoration:none;">
                            <i class="fas fa-gavel"></i> مراجعة
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Gallery --}}
@if($partner->media->isNotEmpty())
<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-images text-green-600 ml-2"></i> معرض الصور</h2>
    </div>
    <div class="p-5 grid gap-3" style="grid-template-columns: repeat(auto-fill, minmax(140px, 1fr))">
        @foreach($partner->media as $img)
        <img src="{{ $img->url }}" class="w-full h-28 object-cover rounded-xl border">
        @endforeach
    </div>
</div>
@endif

@endsection
