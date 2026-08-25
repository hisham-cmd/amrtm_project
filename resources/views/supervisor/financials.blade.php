@extends('layouts.dashboard')

@section('title', 'الحركة المالية')
@section('page-title', 'الحركة المالية والإيرادات')

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
    <a href="{{ route('supervisor.financials') }}" class="nav-item active"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

{{-- ── Summary cards ──────────────────────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-bottom:24px;">

    <div class="stat-card" style="border-right:4px solid #16a34a;">
        <div class="stat-icon" style="background:rgba(22,163,74,.1);color:#16a34a;"><i class="fas fa-coins"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totals['total_revenue'],0) }} ر.س</div>
            <div class="stat-label">إجمالي الإيرادات المؤكدة</div>
        </div>
    </div>

    <div class="stat-card" style="border-right:4px solid #7c3aed;">
        <div class="stat-icon" style="background:#f5f3ff;color:#7c3aed;"><i class="fas fa-hand-holding-dollar"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totals['total_commissions'],0) }} ر.س</div>
            <div class="stat-label">إجمالي العمولات</div>
        </div>
    </div>

    <div class="stat-card" style="border-right:4px solid #0ea5e9;">
        <div class="stat-icon" style="background:#f0f9ff;color:#0ea5e9;"><i class="fas fa-calendar-check"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totals['total_bookings']) }}</div>
            <div class="stat-label">إجمالي الحجوزات</div>
        </div>
    </div>

    <div class="stat-card" style="border-right:4px solid #22c55e;">
        <div class="stat-icon" style="background:rgba(34,197,94,.1);color:#22c55e;"><i class="fas fa-circle-check"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totals['confirmed_bookings']) }}</div>
            <div class="stat-label">حجوزات مؤكدة</div>
        </div>
    </div>

    <div class="stat-card" style="border-right:4px solid #f59e0b;">
        <div class="stat-icon" style="background:#fffbeb;color:#f59e0b;"><i class="fas fa-clock"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totals['pending_bookings']) }}</div>
            <div class="stat-label">حجوزات معلقة</div>
        </div>
    </div>

    <div class="stat-card" style="border-right:4px solid #ef4444;">
        <div class="stat-icon" style="background:#fef2f2;color:#ef4444;"><i class="fas fa-circle-xmark"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totals['cancelled_bookings']) }}</div>
            <div class="stat-label">حجوزات ملغاة</div>
        </div>
    </div>

</div>

{{-- ── Revenue chart ───────────────────────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:24px;">

    <div class="card">
        <div class="card-header"><span class="card-title"><i class="fas fa-chart-bar"></i> الإيرادات الشهرية (آخر 12 شهر)</span></div>
        <div class="card-body">
            <canvas id="revenueChart" height="100"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title"><i class="fas fa-chart-pie"></i> توزيع الحجوزات</span></div>
        <div class="card-body" style="display:flex;align-items:center;justify-content:center;">
            <canvas id="statusChart" height="180"></canvas>
        </div>
    </div>

</div>

{{-- ── Commissions chart ────────────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header"><span class="card-title"><i class="fas fa-chart-line"></i> العمولات الشهرية (آخر 12 شهر)</span></div>
    <div class="card-body">
        <canvas id="commissionChart" height="70"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
const months = @json($months);
const revenues = @json($revenues);
const bookingCounts = @json($bookingCounts);
const commissions = @json($commissions);
const statusDist = @json($statusDist);

// Revenue bar chart
new Chart(document.getElementById('revenueChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
            {
                label: 'الإيرادات (ر.س)',
                data: revenues,
                backgroundColor: 'rgba(22,163,74,.75)',
                borderColor: '#16a34a',
                borderWidth: 1,
                yAxisID: 'yRev',
            },
            {
                label: 'عدد الحجوزات',
                data: bookingCounts,
                type: 'line',
                borderColor: '#0ea5e9',
                backgroundColor: 'rgba(14,165,233,.12)',
                tension: .4,
                fill: true,
                yAxisID: 'yCount',
            }
        ]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index' },
        scales: {
            yRev:   { position: 'right', ticks: { callback: v => v.toLocaleString('ar-SA') + ' ر.س' } },
            yCount: { position: 'left', ticks: { precision: 0 } }
        }
    }
});

// Status pie chart
const statusLabels = { pending: 'معلق', confirmed: 'مؤكد', cancelled: 'ملغي' };
const statusColors = { pending: '#f59e0b', confirmed: '#22c55e', cancelled: '#ef4444' };
const distKeys = Object.keys(statusDist);
new Chart(document.getElementById('statusChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: distKeys.map(k => statusLabels[k] ?? k),
        datasets: [{
            data: distKeys.map(k => statusDist[k]),
            backgroundColor: distKeys.map(k => statusColors[k] ?? '#6b7280'),
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

// Commissions line chart
new Chart(document.getElementById('commissionChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [{
            label: 'العمولات (ر.س)',
            data: commissions,
            borderColor: '#7c3aed',
            backgroundColor: 'rgba(124,58,237,.12)',
            tension: .4,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { ticks: { callback: v => v.toLocaleString('ar-SA') + ' ر.س' } }
        }
    }
});
</script>

@endsection
