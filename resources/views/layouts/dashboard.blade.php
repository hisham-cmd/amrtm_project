<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'أمر تم') — لوحة التحكم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest     = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
        $appCss       = $manifest['resources/css/app.css']['file'] ?? null;
        $useDevVite   = app()->environment(['local','development']) && file_exists(public_path('hot'));
    @endphp
    @if($useDevVite)
        @vite(['resources/css/app.css'])
    @elseif($appCss && file_exists(public_path('build/'.$appCss)))
        <link rel="stylesheet" href="{{ asset('build/'.$appCss) }}">
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:        #163d28;
            --navy-mid:    #1e5233;
            --navy-light:  #227042;
            --navy-pale:   #eef7f1;
            --gold:        #f59e0b;
            --gold-dark:   #d97706;
            --text-dark:   #0f172a;
            --text-mid:    #334155;
            --text-muted:  #64748b;
            --bg:          #f1f5fb;
            --white:       #ffffff;
            --danger:      #dc2626;
            --warning:     #f59e0b;
            --success:     #16a34a;
            --info:        #0284c7;
            --sidebar-w:   268px;
            --radius:      12px;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* ══════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════ */
        .sidebar {
            position: fixed;
            top: 0; right: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(180deg, #0e2d1c 0%, #163d28 40%, #1a4a30 100%);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
            transition: transform .3s ease;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.1) transparent;
            border-left: 1px solid rgba(255,255,255,.06);
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

        .sidebar-logo {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #1a1100;
            flex-shrink: 0;
        }

        .sidebar-logo h2 {
            color: var(--white);
            font-size: 1.25rem;
            font-weight: 900;
            line-height: 1;
        }

        .sidebar-logo span { color: var(--gold); }

        .sidebar-logo .tagline {
            font-size: .65rem;
            color: rgba(255,255,255,.35);
            font-weight: 400;
            margin-top: 2px;
            letter-spacing: .5px;
        }

        .sidebar-role {
            margin: 14px 16px 10px;
            border-radius: 10px;
            padding: 12px 14px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-role-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #1a1100;
            font-size: .9rem;
            flex-shrink: 0;
        }

        .sidebar-role-name {
            font-weight: 700;
            color: #fff;
            font-size: .85rem;
            line-height: 1.2;
        }

        .sidebar-role-label {
            font-size: .72rem;
            color: rgba(255,255,255,.4);
            margin-top: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 8px 0 12px;
        }

        .nav-section-title {
            color: rgba(255,255,255,.3);
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 18px 20px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 20px 10px 16px;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            border-right: 3px solid transparent;
            transition: all .18s;
            font-size: .875rem;
            font-weight: 600;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255,255,255,.07);
            color: #fff;
            border-right-color: rgba(245,158,11,.5);
        }

        .nav-item.active {
            background: rgba(245,158,11,.1);
            color: var(--gold);
            border-right-color: var(--gold);
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            font-size: .9rem;
            opacity: .8;
        }

        .nav-item.active i { opacity: 1; }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,.07);
            margin: 8px 16px;
        }

        .sidebar-footer {
            padding: 14px 16px 16px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,.5);
            background: none;
            border: none;
            font-family: 'Cairo', sans-serif;
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            padding: 9px 12px;
            width: 100%;
            border-radius: 8px;
            transition: all .18s;
            text-decoration: none;
        }

        .btn-logout:hover {
            color: #fff;
            background: rgba(255,255,255,.07);
        }

        /* ══════════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════════ */
        .main {
            margin-right: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--white);
            padding: 0 28px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 4px rgba(13,36,72,.06);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-breadcrumb .page-icon {
            width: 32px; height: 32px;
            background: var(--navy-pale);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            font-size: .85rem;
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-user-info {
            text-align: left;
        }

        .topbar-user-name {
            font-size: .85rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .topbar-user-role {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .topbar-user .avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 800;
            font-size: .9rem;
            border: 2px solid var(--navy-pale);
        }

        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* ══════════════════════════════════════
           ALERTS
        ══════════════════════════════════════ */
        .alert {
            padding: 13px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: .88rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-weight: 600;
        }

        .alert i { margin-top: 2px; flex-shrink: 0; }

        .alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-danger  { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .alert-warning { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
        .alert-info    { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }

        /* ══════════════════════════════════════
           STAT CARDS
        ══════════════════════════════════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 14px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 4px rgba(13,36,72,.06);
            border: 1px solid #e8edf5;
            transition: box-shadow .2s, transform .2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(13,36,72,.1);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .stat-icon.navy  { background: #dcf5e8; color: var(--navy); }
        .stat-icon.gold  { background: #fef3c7; color: #d97706; }
        .stat-icon.blue  { background: #dbeafe; color: #1d4ed8; }
        .stat-icon.red   { background: #fee2e2; color: #dc2626; }
        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-icon.purple{ background: #ede9fe; color: #7c3aed; }
        .stat-icon.teal  { background: #ccfbf1; color: #0d9488; }

        /* keep old class names for backward compat */
        .stat-icon.green-c { background: var(--navy-pale); color: var(--navy); }

        .stat-info h3, .stat-value { font-size: 1.65rem; font-weight: 900; color: var(--text-dark); line-height: 1; }
        .stat-info p, .stat-label  { font-size: .8rem; color: var(--text-muted); margin-top: 4px; font-weight: 600; }

        /* ══════════════════════════════════════
           CARD
        ══════════════════════════════════════ */
        .card {
            background: var(--white);
            border-radius: 14px;
            box-shadow: 0 1px 4px rgba(13,36,72,.06);
            border: 1px solid #e8edf5;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fafbfd;
        }

        .card-title {
            font-size: .95rem;
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .card-title i { color: var(--navy); }

        .card-body { padding: 22px; }

        /* ══════════════════════════════════════
           TABLE
        ══════════════════════════════════════ */
        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: .875rem;
        }

        thead th {
            background: var(--navy-pale);
            color: var(--navy);
            font-weight: 800;
            padding: 12px 16px;
            text-align: right;
            white-space: nowrap;
            font-size: .82rem;
            letter-spacing: .02em;
        }

        thead th:first-child { border-radius: 0 6px 6px 0; }
        thead th:last-child  { border-radius: 6px 0 0 6px; }

        tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            color: var(--text-mid);
        }

        tbody tr:last-child td { border-bottom: none; }

        tbody tr:hover td { background: var(--navy-pale); }

        /* ══════════════════════════════════════
           BADGES
        ══════════════════════════════════════ */
        .badge {
            padding: 4px 11px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 700;
            white-space: nowrap;
            display: inline-block;
        }

        .badge-success  { background: #dcfce7; color: #15803d; }
        .badge-warning  { background: #fef3c7; color: #92400e; }
        .badge-danger   { background: #fee2e2; color: #be123c; }
        .badge-info     { background: #dbeafe; color: #1d4ed8; }
        .badge-secondary{ background: #f1f5f9; color: #475569; }
        .badge-navy     { background: var(--navy-pale); color: var(--navy); }
        .badge-gold     { background: #fef3c7; color: #92400e; }

        /* ══════════════════════════════════════
           FORM ELEMENTS
        ══════════════════════════════════════ */
        .form-group { margin-bottom: 18px; }

        .form-label {
            display: block;
            font-size: .85rem;
            font-weight: 700;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #dde4ef;
            border-radius: 9px;
            font-family: 'Cairo', sans-serif;
            font-size: .9rem;
            color: var(--text-dark);
            background: var(--white);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(13,36,72,.08);
        }

        .form-control::placeholder { color: #a0aec0; }

        textarea.form-control { resize: vertical; min-height: 100px; }

        .form-row {
            display: grid;
            gap: 16px;
        }

        .form-row-2 { grid-template-columns: 1fr 1fr; }
        .form-row-3 { grid-template-columns: 1fr 1fr 1fr; }

        .form-hint {
            font-size: .76rem;
            color: var(--text-muted);
            margin-top: 5px;
        }

        /* ══════════════════════════════════════
           BUTTONS
        ══════════════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 9px;
            font-family: 'Cairo', sans-serif;
            font-size: .88rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .18s;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--navy);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(13,36,72,.25);
        }
        .btn-primary:hover {
            background: var(--navy-mid);
            box-shadow: 0 4px 14px rgba(13,36,72,.3);
            transform: translateY(-1px);
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #1a1100;
            font-weight: 800;
            box-shadow: 0 2px 8px rgba(245,158,11,.3);
        }
        .btn-gold:hover { opacity: .92; transform: translateY(-1px); }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(220,38,38,.25);
        }
        .btn-danger:hover { opacity: .9; transform: translateY(-1px); }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }
        .btn-success:hover { opacity: .9; }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--navy);
            color: var(--navy);
        }
        .btn-outline:hover {
            background: var(--navy);
            color: var(--white);
        }

        .btn-outline-gold {
            background: transparent;
            border: 1.5px solid var(--gold);
            color: var(--gold-dark);
        }
        .btn-outline-gold:hover {
            background: var(--gold);
            color: #1a1100;
        }

        .btn-light {
            background: var(--navy-pale);
            color: var(--navy);
            border: 1px solid #dde4ef;
        }
        .btn-light:hover { background: #dde4ef; }

        .btn-sm { padding: 6px 14px; font-size: .8rem; }
        .btn-xs { padding: 4px 10px; font-size: .75rem; }

        /* ══════════════════════════════════════
           ACTION BUTTONS IN TABLE
        ══════════════════════════════════════ */
        .action-btns { display: flex; gap: 6px; align-items: center; }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 7px;
            font-size: .78rem;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            transition: all .18s;
            font-family: 'Cairo', sans-serif;
        }

        .action-btn-edit   { background: var(--navy-pale); color: var(--navy); border-color: #dde4ef; }
        .action-btn-edit:hover { background: var(--navy); color: #fff; }

        .action-btn-danger { background: #fee2e2; color: #dc2626; border-color: #fecaca; }
        .action-btn-danger:hover { background: #dc2626; color: #fff; }

        .action-btn-success { background: #dcfce7; color: #16a34a; border-color: #bbf7d0; }
        .action-btn-success:hover { background: #16a34a; color: #fff; }

        .action-btn-warning { background: #fef3c7; color: #d97706; border-color: #fde68a; }
        .action-btn-warning:hover { background: #f59e0b; color: #fff; }

        /* ══════════════════════════════════════
           PAGINATION
        ══════════════════════════════════════ */
        .pagination { display: flex; gap: 5px; justify-content: center; margin-top: 20px; flex-wrap: wrap; }
        .pagination .page-item { list-style: none; }
        .pagination .page-link {
            padding: 7px 13px;
            border-radius: 7px;
            color: var(--navy);
            border: 1.5px solid #dde4ef;
            text-decoration: none;
            font-size: .83rem;
            font-weight: 600;
            transition: all .18s;
        }
        .pagination .page-link:hover { background: var(--navy-pale); }
        .pagination .page-item.active .page-link {
            background: var(--navy);
            color: var(--white);
            border-color: var(--navy);
        }

        /* ══════════════════════════════════════
           SECTION TITLE
        ══════════════════════════════════════ */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title-bar {
            width: 4px; height: 22px;
            background: linear-gradient(180deg, var(--gold), var(--gold-dark));
            border-radius: 3px;
        }

        /* ══════════════════════════════════════
           EMPTY STATE
        ══════════════════════════════════════ */
        .empty-state {
            text-align: center;
            padding: 56px 32px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: #cbd5e1;
            display: block;
            margin-bottom: 14px;
        }

        .empty-state h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .empty-state p { font-size: .85rem; }

        /* ══════════════════════════════════════
           MOBILE TOGGLE
        ══════════════════════════════════════ */
        .sidebar-toggle {
            display: none;
            background: var(--navy);
            color: var(--white);
            border: none;
            padding: 8px 12px;
            border-radius: 7px;
            font-size: 1rem;
            cursor: pointer;
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 99;
        }

        @media (max-width: 900px) {
            .topbar-user-info { display: none; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-right: 0; }
            .overlay.show { display: block; }
            .sidebar-toggle { display: block; }
            .form-row-2, .form-row-3 { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-content { padding: 16px; }
            .topbar { padding: 0 16px; }
        }

        /* ===== SECTION CARDS (alias for card pattern) ===== */
        .section-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 1px 6px rgba(0,0,0,.06);
            overflow: hidden;
        }
        .section-header {
            padding: 16px 22px;
            border-bottom: 1px solid #eef2ef;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-header h2 {
            font-size: .95rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }
        .p-5 { padding: 20px; }

        /* ===== FORM GRID ===== */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 640px) { .form-grid { grid-template-columns: 1fr; } }
        .col-span-2 { grid-column: span 2; }
        @media (max-width: 640px) { .col-span-2 { grid-column: span 1; } }

        /* ===== FORM INPUT ALIAS ===== */
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #d5ddd8;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: .9rem;
            color: var(--text-dark);
            background: var(--white);
            transition: border-color .2s;
            outline: none;
        }
        .form-input:focus { border-color: var(--green); }
        .form-error { color: var(--danger); font-size: .8rem; margin-top: 4px; }

        /* ===== BUTTON ALIASES ===== */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            background: var(--green);
            color: var(--white);
            transition: all .2s;
        }
        .btn-primary:hover { background: var(--green-light); }
        .mt-3 { margin-top: 12px; }
        .mb-5 { margin-bottom: 20px; }
    </style>
    @stack('styles')
</head>
<body>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon"><i class="fas fa-layer-group"></i></div>
        <div>
            <h2>أمر <span>تم</span></h2>
            <div class="tagline">لوحة التحكم</div>
        </div>
    </div>

    <div class="sidebar-role">
        <div class="sidebar-role-avatar">{{ mb_substr(Auth::user()->name, 0, 1) }}</div>
        <div>
            <div class="sidebar-role-name">{{ Auth::user()->name }}</div>
            <div class="sidebar-role-label">
                @php
                    $rv = Auth::user()->role->value;
                    echo match($rv) {
                        'admin','supervisor' => 'مشرف النظام',
                        'owner'   => 'مالك قاعة',
                        'agent'   => 'مندوب',
                        'manager' => 'مدير مشروع',
                        default   => 'عميل',
                    };
                @endphp
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        @yield('sidebar-nav')
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('halls.list') }}" class="btn-logout" style="margin-bottom:4px;">
            <i class="fas fa-building"></i>
            قائمة القاعات
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i>
                تسجيل الخروج
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-breadcrumb">
                <div class="page-icon"><i class="fas fa-circle-dot"></i></div>
                <span class="topbar-title">@yield('page-title', 'لوحة التحكم')</span>
            </div>
        </div>
        <div class="topbar-user">
            <div class="topbar-user-info">
                <div class="topbar-user-name">{{ Auth::user()->name }}</div>
                <div class="topbar-user-role">@yield('page-title', 'لوحة التحكم')</div>
            </div>
            <div class="avatar">{{ mb_substr(Auth::user()->name, 0, 1) }}</div>
        </div>
    </header>

    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('show');
    }

    // Mark active nav item based on current URL
    const currentUrl = window.location.href.split('?')[0];
    document.querySelectorAll('.nav-item').forEach(function(item) {
        if (item.href && item.href.split('?')[0] === currentUrl) {
            item.classList.add('active');
        }
    });
</script>

@stack('scripts')
</body>
</html>
