@extends('layouts.dashboard')

@section('title', 'طلبات التوثيق')
@section('page-title', 'طلبات التوثيق')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item active"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-file-signature"></i> وثائق قيد المراجعة</span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $documents->total() }} وثيقة</span>
    </div>
    @if($documents->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-check-circle" style="font-size:3rem; color:#28a745; opacity:.6; display:block; margin-bottom:12px;"></i>
            لا توجد وثائق بانتظار المراجعة
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th><th>المنشأة / الخدمة</th><th>النوع</th><th>المالك</th><th>نوع الوثيقة</th><th>تاريخ الرفع</th><th>الملف</th><th>إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $doc)
                        @php
                            $entityName = $doc->officiant
                                ? ($doc->owner?->name ?? 'مأذون شرعي')
                                : ($doc->partner?->company_name ?? $doc->hall?->name ?? '—');
                            $entityType = $doc->officiant ? 'مأذون شرعي' : ($doc->hall ? 'قاعة' : 'شريك');
                            $badgeColor = $doc->officiant ? '#6f42c1' : ($doc->hall ? '#1a5c38' : '#0d6efd');
                        @endphp
                        <tr>
                            <td>{{ $doc->id }}</td>
                            <td><strong>{{ $entityName }}</strong></td>
                            <td>
                                <span style="background:{{ $badgeColor }};color:#fff;padding:2px 8px;border-radius:20px;font-size:.75rem;">
                                    {{ $entityType }}
                                </span>
                            </td>
                            <td>
                                {{ $doc->owner?->name ?? '—' }}<br>
                                <small style="color:#6c7a72;">{{ $doc->owner?->phone }}</small>
                            </td>
                            <td>{{ $doc->document_type }}</td>
                            <td>{{ $doc->created_at->format('Y/m/d') }}</td>
                            <td>
                                <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank" class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('supervisor.approvals.review', $doc->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-gavel"></i> مراجعة
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body" style="padding-top:0;">{{ $documents->links() }}</div>
    @endif
</div>

@endsection
