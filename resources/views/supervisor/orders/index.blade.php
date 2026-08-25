@extends('layouts.dashboard')

@section('title', 'إدارة الطلبات')
@section('page-title', 'إدارة الطلبات')

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
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
    <a href="{{ route('supervisor.orders.index') }}" class="nav-item active"><i class="fas fa-shopping-cart"></i> الطلبات</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="section-card">
    <div class="section-header">
        <h2><i class="fas fa-shopping-cart text-green-600 ml-2"></i> طلبات العملاء</h2>
        <div>
            <form method="GET" style="display:inline-flex;gap:8px;align-items:center;">
                <select name="status" onchange="this.form.submit()"
                        style="border:1.5px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:.85rem;font-family:'Cairo',sans-serif;">
                    <option value="">كل الحالات</option>
                    <option value="pending_payment"  {{ $status === 'pending_payment'  ? 'selected' : '' }}>في انتظار الدفع</option>
                    <option value="receipt_uploaded" {{ $status === 'receipt_uploaded' ? 'selected' : '' }}>تم رفع الإيصال</option>
                    <option value="confirmed"        {{ $status === 'confirmed'        ? 'selected' : '' }}>مؤكد</option>
                    <option value="rejected"         {{ $status === 'rejected'         ? 'selected' : '' }}>مرفوض</option>
                </select>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>العميل</th>
                    <th>العناصر</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>الإيصال</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td style="font-weight:700;color:#0f3d24;">{{ $order->order_number }}</td>
                    <td>
                        <div style="font-weight:700;">{{ $order->user?->name ?? '—' }}</div>
                        <div style="font-size:11px;color:#6c7a72;">{{ $order->user?->email }}</div>
                    </td>
                    <td>
                        <div style="font-size:12px;">
                            @foreach($order->items as $item)
                            <span style="display:inline-block;background:#e8f5e9;color:#1a5c38;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:700;margin:1px;">
                                {{ $item->label }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td style="font-weight:800;color:#1a5c38;">{{ number_format((float)$order->total_amount, 2) }} ريال</td>
                    <td>
                        <span style="background:{{ $order->status_color }}22;color:{{ $order->status_color }};padding:4px 12px;border-radius:20px;font-size:12px;font-weight:800;">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td>
                        @if($order->receipt_path)
                        <a href="{{ asset('storage/' . $order->receipt_path) }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:5px;font-size:12px;color:#1a5c38;font-weight:700;text-decoration:none;">
                            <i class="fas fa-file-image"></i> عرض
                        </a>
                        @else
                        <span style="font-size:12px;color:#9ca3af;">لا يوجد</span>
                        @endif
                    </td>
                    <td style="font-size:12px;color:#6c7a72;">{{ $order->created_at->format('Y/m/d') }}</td>
                    <td>
                        @if(in_array($order->status, ['receipt_uploaded', 'pending_payment']))
                        <div style="display:flex;flex-direction:column;gap:6px;">
                            <form method="POST" action="{{ route('supervisor.orders.approve', $order) }}">
                                @csrf
                                <button type="submit"
                                        style="background:#1a5c38;color:#fff;border:none;border-radius:8px;padding:6px 12px;font-family:'Cairo';font-size:12px;font-weight:800;cursor:pointer;width:100%;">
                                    <i class="fas fa-check"></i> قبول
                                </button>
                            </form>
                            <form method="POST" action="{{ route('supervisor.orders.reject', $order )}}"
                                  onsubmit="return confirm('هل أنت متأكد من رفض هذا الطلب؟')">
                                @csrf
                                <button type="submit"
                                        style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:6px 12px;font-family:'Cairo';font-size:12px;font-weight:800;cursor:pointer;width:100%;">
                                    <i class="fas fa-times"></i> رفض
                                </button>
                            </form>
                        </div>
                        @else
                        <span style="font-size:12px;color:#9ca3af;">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:40px;color:#9ca3af;">
                        <i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                        لا توجد طلبات حتى الآن
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div style="padding:16px 0;">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
