@extends('layouts.dashboard')

@section('title', 'إدارة المستخدمين')
@section('page-title', 'إدارة المستخدمين')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item active"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger" style="margin-bottom:16px;"><i class="fas fa-circle-xmark"></i> {{ session('error') }}</div>
@endif

{{-- Filter --}}
<div class="card">
    <div class="card-body" style="padding:16px 22px;">
        {{-- Search row --}}
        <form method="GET" id="filterForm" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center; margin-bottom:14px;">
            <input type="hidden" name="role" id="roleInput" value="{{ request('role') }}">
            <div style="flex:1; min-width:200px;">
                <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو البريد أو الهاتف..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            @if(request()->hasAny(['search','role']))
                <a href="{{ route('supervisor.users') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
            <a href="{{ route('supervisor.users.create') }}" class="btn btn-primary" style="background:#7c3aed;">
                <i class="fas fa-user-plus"></i> إنشاء حساب جديد
            </a>
        </form>

        {{-- Role filter buttons --}}
        @php
        $activeRole = request('role', '');
        $filterRoles = [
            ''           => ['label' => 'الكل',          'icon' => 'fa-users'],
            'owner'      => ['label' => 'مالك قاعة',     'icon' => 'fa-building'],
            'officiant'  => ['label' => 'مأذون شرعي',    'icon' => 'fa-scroll'],
            'partner'    => ['label' => 'مقدم خدمة',     'icon' => 'fa-briefcase'],
            'user'       => ['label' => 'مستخدم',        'icon' => 'fa-user'],
        ];
        @endphp
        <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content:center;">
            @foreach($filterRoles as $roleVal => $meta)
            @php $isActive = $activeRole === $roleVal; @endphp
            <button
                type="button"
                onclick="applyRoleFilter('{{ $roleVal }}')"
                style="
                    display:inline-flex; align-items:center; gap:6px;
                    padding:7px 16px; border-radius:30px; font-size:.84rem; font-weight:700;
                    cursor:pointer; border:2px solid {{ $isActive ? '#166534' : '#d1d5db' }};
                    background:{{ $isActive ? '#166534' : '#f9fafb' }};
                    color:{{ $isActive ? '#fff' : '#374151' }};
                    transition:all .2s; font-family:inherit;
                ">
                <i class="fas {{ $meta['icon'] }}" style="font-size:.8rem;"></i>
                {{ $meta['label'] }}
            </button>
            @endforeach
        </div>
    </div>
</div>

<script>
function applyRoleFilter(role) {
    document.getElementById('roleInput').value = role;
    document.getElementById('filterForm').submit();
}
</script>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-users"></i> المستخدمون</span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $users->total() }} مستخدم</span>
    </div>
    @if($users->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-users" style="font-size:3rem; opacity:.3; display:block; margin-bottom:12px;"></i>
            لا يوجد مستخدمون مطابقون
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>الدور</th>
                    <th>كود الإحالة</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                @php
                $rc = ['admin'=>'badge-danger','supervisor'=>'badge-danger','manager'=>'badge-info','agent'=>'badge-warning','owner'=>'badge-success','partner'=>'badge-info','officiant'=>'badge-warning','user'=>'badge-secondary'];
                @endphp
                <tr>
                    <td>{{ $u->id }}</td>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td style="font-size:.85rem;">{{ $u->email }}</td>
                    <td>{{ $u->phone }}</td>
                    <td><span class="badge {{ $rc[$u->role->value] ?? 'badge-secondary' }}">{{ $u->role->label() }}</span></td>
                    <td>
                        @if($u->role->value === 'agent' && $u->refCode)
                            <code style="background:var(--navy-pale); color:var(--navy); padding:3px 8px; border-radius:6px; font-size:.82rem; font-weight:700;">
                                {{ $u->refCode->code }}
                            </code>
                        @else
                            <span style="color:#d1d5db;">—</span>
                        @endif
                    </td>
                    <td>{{ $u->created_at->format('Y/m/d') }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('supervisor.users.edit', $u->id) }}" class="action-btn action-btn-edit">
                                <i class="fas fa-pen"></i> تعديل
                            </a>
                            @if($u->id !== auth()->id() && $u->role->value !== 'supervisor')
                            <button type="button"
                                onclick="openDeleteModal({{ $u->id }}, '{{ addslashes($u->name) }}')"
                                style="background:#fef2f2; color:#dc2626; border:1px solid #fca5a5; border-radius:7px; padding:5px 12px; font-size:.8rem; font-weight:700; cursor:pointer; white-space:nowrap;">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body" style="padding-top:0;">{{ $users->links() }}</div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:14px; padding:28px 30px; width:420px; max-width:95vw; direction:rtl; text-align:center;">
        <div style="width:60px; height:60px; background:#fef2f2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="fas fa-trash" style="font-size:1.5rem; color:#dc2626;"></i>
        </div>
        <h3 style="margin:0 0 8px; font-size:1.05rem; color:#111827;">تأكيد حذف المستخدم</h3>
        <p style="font-size:.88rem; color:#6c7a72; margin:0 0 22px; line-height:1.6;">
            هل أنت متأكد من حذف حساب <strong id="deleteUserName" style="color:#111827;"></strong>؟<br>
            <span style="color:#dc2626; font-size:.82rem;">هذا الإجراء لا يمكن التراجع عنه.</span>
        </p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div style="display:flex; gap:10px; justify-content:center;">
                <button type="button" onclick="closeDeleteModal()"
                    style="flex:1; background:#f9fafb; color:#374151; border:1px solid #e5e7eb; border-radius:8px; padding:10px; font-size:.9rem; font-weight:700; cursor:pointer; font-family:inherit;">
                    إلغاء
                </button>
                <button type="submit"
                    style="flex:1; background:#dc2626; color:#fff; border:none; border-radius:8px; padding:10px; font-size:.9rem; font-weight:700; cursor:pointer; font-family:inherit;">
                    <i class="fas fa-trash"></i> تأكيد الحذف
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteModal(id, name) {
    document.getElementById('deleteUserName').textContent = name;
    document.getElementById('deleteForm').action = '{{ url("supervisor/users") }}/' + id;
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>

@endsection
