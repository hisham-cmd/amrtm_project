@extends('layouts.dashboard')

@section('title', 'إدارة العلامات التجارية')
@section('page-title', 'العلامات التجارية والامتيازات')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item active"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
@endsection

@section('content')

<div class="section-header">
    <div class="section-title">
        <div class="section-title-bar"></div>
        <i class="fas fa-trademark"></i> العلامات التجارية
        <span class="badge badge-navy" style="font-size:.75rem;">{{ $brands->count() }}</span>
    </div>
    <a href="{{ route('supervisor.brands.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> إضافة علامة جديدة
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>العلامة</th>
                    <th>الفئة</th>
                    <th>الاستثمار (ريال)</th>
                    <th>الحالة</th>
                    <th>المزاد</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            @if($brand->logo_url)
                                <img src="{{ $brand->logo_url }}" style="width:42px;height:42px;border-radius:10px;object-fit:cover;border:1px solid var(--navy-pale);">
                            @else
                                <div style="width:42px;height:42px;border-radius:10px;background:var(--navy-pale);display:flex;align-items:center;justify-content:center;color:var(--navy);font-size:1.1rem;flex-shrink:0;">
                                    <i class="fas fa-trademark"></i>
                                </div>
                            @endif
                            <div>
                                <div style="font-weight:700;color:var(--text-dark);">{{ $brand->name }}</div>
                                <div style="font-size:.77rem;color:var(--text-muted);">{{ $brand->name_en }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-info">{{ $brand->category }}</span></td>
                    <td style="font-weight:600;">{{ number_format($brand->investment_min/1000) }}K — {{ number_format($brand->investment_max/1000) }}K</td>
                    <td>
                        @php $statusMap = ['active'=>['badge-success','نشط'],'inactive'=>['badge-danger','غير نشط'],'draft'=>['badge-warning','مسودة']]; $sm = $statusMap[$brand->status] ?? ['badge-secondary',$brand->status]; @endphp
                        <span class="badge {{ $sm[0] }}">{{ $sm[1] }}</span>
                    </td>
                    <td>
                        @php $auction = $brand->activeAuction(); @endphp
                        @if($auction)
                            <span class="badge badge-gold"><i class="fas fa-gavel"></i> {{ number_format($auction->current_bid/1000) }}K ر.س</span>
                        @elseif($brand->is_auction_eligible)
                            <span class="badge badge-info">مؤهل للمزاد</span>
                        @else
                            <span style="color:#cbd5e1;">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('supervisor.brands.edit', $brand) }}" class="action-btn action-btn-edit">
                                <i class="fas fa-edit"></i> تعديل
                            </a>
                            <form method="POST" action="{{ route('supervisor.brands.destroy', $brand) }}" style="display:contents;"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه العلامة؟')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-danger">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fas fa-trademark"></i>
                            <h3>لا توجد علامات تجارية حتى الآن</h3>
                            <p><a href="{{ route('supervisor.brands.create') }}" style="color:var(--navy);font-weight:700;">أضف أول علامة</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
