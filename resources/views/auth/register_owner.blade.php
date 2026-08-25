{{-- resources/views/auth/register_owner.blade.php --}}
<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل منشأة جديدة — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        /* ════════════════════════════════════════════════════════
           RESET & VARIABLES
        ════════════════════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:        #1a5c38;
            --green-mid:    #2a7a4e;
            --green-light:  #52b788;
            --green-pale:   #e8f5ee;
            --green-border: #b8dbc8;
            --gold:         #c8a951;
            --gold-light:   #fdf4dc;
            --red:          #dc3545;
            --red-pale:     #fdf0f0;
            --orange:       #e67e22;
            --orange-pale:  #fef4e8;
            --text-dark:    #1e2d27;
            --text-mid:     #3d5246;
            --text-muted:   #6c7a72;
            --border:       #d5ddd8;
            --bg:           #f4f7f5;
            --white:        #ffffff;
            --shadow-sm:    0 2px 8px rgba(0,0,0,.07);
            --shadow-md:    0 6px 24px rgba(0,0,0,.10);
            --shadow-lg:    0 16px 48px rgba(0,0,0,.14);
            --radius:       12px;
            --radius-lg:    18px;
            --transition:   .22s ease;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* ════════════════════════════════════════════════════════
           TOP HEADER BAR
        ════════════════════════════════════════════════════════ */
        .top-header {
            background: var(--green);
            padding: 0 24px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(0,0,0,.2);
        }

        .header-logo {
            font-size: 1.5rem;
            font-weight: 900;
            color: #fff;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .header-logo span { color: var(--gold); }

        .header-login-link {
            font-size: .84rem;
            color: rgba(255,255,255,.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color var(--transition);
        }

        .header-login-link:hover { color: #fff; }

        /* ════════════════════════════════════════════════════════
           HERO SECTION
        ════════════════════════════════════════════════════════ */
        .hero {
            background: linear-gradient(135deg, #0e3a23 0%, #1a5c38 55%, #2d6a4f 100%);
            padding: 44px 24px 56px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 340px; height: 340px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            top: -120px; left: -100px;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(200,169,81,.12);
            bottom: -60px; right: -50px;
        }

        .hero-icon-wrap {
            width: 76px; height: 76px;
            background: rgba(255,255,255,.12);
            border: 2px solid rgba(255,255,255,.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: var(--gold);
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .hero p {
            color: rgba(255,255,255,.75);
            font-size: .93rem;
            position: relative;
            z-index: 1;
        }

        /* ════════════════════════════════════════════════════════
           PROGRESS BAR & STEPS
        ════════════════════════════════════════════════════════ */
        .progress-wrapper {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 20px 24px;
            position: sticky;
            top: 60px;
            z-index: 900;
            box-shadow: var(--shadow-sm);
        }

        .steps-track {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            max-width: 780px;
            margin: 0 auto;
            position: relative;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 19px;
            left: -50%;
            width: 100%;
            height: 3px;
            background: var(--border);
            z-index: -1;
            transition: background var(--transition);
        }

        .step-item.completed::after { background: var(--green); }
        .step-item.active::after    { background: linear-gradient(90deg, var(--green) 0%, var(--border) 100%); }

        .step-bubble {
            width: 40px; height: 40px;
            border-radius: 50%;
            border: 3px solid var(--border);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            font-weight: 700;
            color: var(--text-muted);
            transition: all var(--transition);
            position: relative;
        }

        .step-item.active   .step-bubble { border-color: var(--green); background: var(--green); color: #fff; }
        .step-item.completed .step-bubble { border-color: var(--green); background: var(--green); color: #fff; }

        .step-label {
            font-size: .72rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-top: 6px;
            text-align: center;
            white-space: nowrap;
        }

        .step-item.active    .step-label  { color: var(--green); }
        .step-item.completed .step-label  { color: var(--green-mid); }

        .progress-bar-line {
            height: 4px;
            background: var(--border);
            border-radius: 4px;
            margin-top: 14px;
            max-width: 780px;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green) 0%, var(--green-light) 100%);
            border-radius: 4px;
            transition: width .4s ease;
        }

        /* ════════════════════════════════════════════════════════
           MAIN LAYOUT
        ════════════════════════════════════════════════════════ */
        .page-body {
            max-width: 820px;
            margin: 32px auto 60px;
            padding: 0 16px;
        }

        /* ════════════════════════════════════════════════════════
           STEP PANELS
        ════════════════════════════════════════════════════════ */
        .step-panel {
            display: none;
            animation: fadeSlideIn .3s ease forwards;
        }

        .step-panel.visible { display: block; }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ════════════════════════════════════════════════════════
           CARDS
        ════════════════════════════════════════════════════════ */
        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 24px 16px;
            border-bottom: 1px solid #f0f4f2;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--green);
            flex-shrink: 0;
        }

        .card-icon.gold  { background: var(--gold-light); color: var(--gold); }
        .card-icon.red   { background: var(--red-pale); color: var(--red); }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .card-subtitle {
            font-size: .78rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .card-body { padding: 24px; }

        /* ════════════════════════════════════════════════════════
           FORM ELEMENTS
        ════════════════════════════════════════════════════════ */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group { margin-bottom: 18px; }
        .form-group:last-child { margin-bottom: 0; }

        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .87rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 7px;
        }

        .form-label .required-star { color: var(--red); }
        .map-autofill-note { display:flex; align-items:center; gap:10px; background:rgba(82,183,136,.08); border:1.5px solid var(--green-light); border-radius:10px; padding:10px 16px; font-size:.82rem; color:var(--green-mid); margin-top:14px; }
        .map-autofill-note i { font-size:1rem; color:var(--green); flex-shrink:0; }
        .form-control.map-filled { background:rgba(82,183,136,.06); border-color:var(--green-light); }
        .form-label .optional-tag { font-size:.7rem; font-weight:600; color:var(--text-muted); background:var(--bg); border:1px solid var(--border); border-radius:6px; padding:1px 7px; margin-right:4px; }

        .form-label-icon {
            width: 22px; height: 22px;
            background: var(--green-pale);
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            color: var(--green);
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: .85rem;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 12px 42px 12px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Cairo', sans-serif;
            font-size: .92rem;
            color: var(--text-dark);
            background: var(--white);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(26,92,56,.1);
        }

        .form-control.is-invalid {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(220,53,69,.1);
        }

        .form-control.is-valid {
            border-color: var(--green-light);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            padding-top: 12px;
        }

        select.form-control { cursor: pointer; appearance: none; }

        .select-wrap { position: relative; }

        .select-wrap::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            font-size: .85rem;
        }

        .invalid-msg {
            color: var(--red);
            font-size: .78rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .hint-msg {
            color: var(--text-muted);
            font-size: .77rem;
            margin-top: 5px;
        }

        /* Phone with flag */
        .phone-input-wrap {
            display: flex;
        }

        .phone-prefix {
            background: var(--green-pale);
            border: 1.5px solid var(--border);
            border-left: none;
            border-radius: var(--radius) 0 0 var(--radius);
            padding: 12px 14px;
            font-family: 'Cairo', sans-serif;
            font-size: .87rem;
            color: var(--text-mid);
            font-weight: 700;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .phone-input-wrap .form-control {
            border-radius: 0 var(--radius) var(--radius) 0;
            border-left: none;
        }

        /* Password strength */
        .password-strength { margin-top: 8px; }

        .strength-bar {
            height: 4px;
            border-radius: 4px;
            background: var(--border);
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-fill {
            height: 100%;
            border-radius: 4px;
            transition: width .3s, background .3s;
            width: 0%;
        }

        .strength-text { font-size: .75rem; color: var(--text-muted); }

        /* Toggle password visibility */
        .toggle-pass {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            cursor: pointer;
            font-size: .85rem;
            background: none;
            border: none;
            padding: 0;
        }

        .toggle-pass:hover { color: var(--green); }

        /* ════════════════════════════════════════════════════════
           VENUE TYPE SELECTOR
        ════════════════════════════════════════════════════════ */
        .venue-types {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        #account-type-card .venue-types {
            grid-template-columns: repeat(2, 1fr);
        }

        .venue-type-btn {
            border: 2px solid var(--border);
            border-radius: var(--radius);
            padding: 16px 10px;
            text-align: center;
            cursor: pointer;
            transition: all var(--transition);
            background: var(--white);
            position: relative;
        }

        .venue-type-btn:hover {
            border-color: var(--green-light);
            background: var(--green-pale);
        }

        .venue-type-btn.selected {
            border-color: var(--green);
            background: var(--green-pale);
        }

        .venue-type-btn .check-mark {
            position: absolute;
            top: 8px;
            left: 8px;
            width: 14px; height: 14px;
            background: var(--green);
            border-radius: 50%;
            display: none;
            font-size: 0;
        }

        .venue-type-btn.selected .check-mark { display: block; }
        .venue-type-btn .check-mark i,
        .entity-type-btn .check-mark i { display: none; }

        .venue-type-btn i {
            font-size: 26px;
            color: var(--text-muted);
            margin-bottom: 8px;
            display: block;
        }

        .venue-type-btn.selected i { color: var(--green); }

        .venue-type-btn span {
            font-size: .83rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .venue-type-btn.selected span { color: var(--green); }

        .venue-type-btn.coming-soon {
            opacity: .55;
            cursor: not-allowed;
            pointer-events: none;
        }
        .venue-type-btn.coming-soon::after {
            content: 'قريباً';
            position: absolute;
            top: 6px;
            right: 6px;
            font-size: .6rem;
            font-weight: 800;
            background: var(--gold);
            color: #fff;
            padding: 2px 7px;
            border-radius: 6px;
            letter-spacing: .3px;
        }

        /* Hidden radio */
        .venue-type-radio { display: none; }

        /* ══ ENTITY TYPE ══ */
        .entity-type-row {
            display: flex;
            gap: 10px;
            margin-bottom: 14px;
        }

        .entity-type-btn {
            flex: 1;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            transition: all var(--transition);
            background: var(--white);
            position: relative;
        }

        .entity-type-btn:hover {
            border-color: var(--green-light);
            background: var(--green-pale);
        }

        .entity-type-btn.selected {
            border-color: var(--green);
            background: var(--green-pale);
        }

        .entity-type-btn .check-mark {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 12px; height: 12px;
            background: var(--green);
            border-radius: 50%;
            display: none;
            font-size: 0;
        }

        .entity-type-btn.selected .check-mark { display: block; }

        .entity-type-btn i {
            font-size: 22px;
            color: var(--text-muted);
            margin-bottom: 6px;
            display: block;
        }

        .entity-type-btn.selected i { color: var(--green); }

        .entity-type-btn span {
            font-size: .8rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .entity-type-btn.selected span { color: var(--green); }

        .entity-type-radio { display: none; }

        /* ══ SECTION DIVIDER ══ */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0 16px;
            padding: 10px 14px;
            background: var(--green-pale);
            border-right: 4px solid var(--green);
            border-radius: 8px;
            font-size: .9rem;
            font-weight: 800;
            color: var(--green);
        }

        .section-divider:first-child { margin-top: 0; }

        .section-divider i {
            font-size: 1rem;
            color: var(--green);
        }

        /* ════════════════════════════════════════════════════════
           MAP
        ════════════════════════════════════════════════════════ */
        #map {
            height: 280px;
            border-radius: var(--radius);
            border: 1.5px solid var(--border);
            margin-bottom: 14px;
            overflow: hidden;
        }

        .map-search-wrap {
            position: relative;
            margin-bottom: 10px;
        }

        .map-coords {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 10px;
        }

        /* ════════════════════════════════════════════════════════
           CHECKBOXES GRID (services, amenities)
        ════════════════════════════════════════════════════════ */
        .check-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 10px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            cursor: pointer;
            transition: all var(--transition);
            background: var(--white);
        }

        .check-item:hover { border-color: var(--green-light); background: var(--green-pale); }

        .check-item.checked { border-color: var(--green); background: var(--green-pale); }

        .check-item input[type="checkbox"] { display: none; }

        .check-box {
            width: 20px; height: 20px;
            border: 2px solid var(--border);
            border-radius: 6px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
        }

        .check-item.checked .check-box {
            background: var(--green);
            border-color: var(--green);
            color: #fff;
        }

        .check-box::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: .65rem;
            opacity: 0;
            transition: opacity var(--transition);
        }

        .check-item.checked .check-box::after { opacity: 1; }

        .check-label {
            font-size: .83rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .check-item.checked .check-label { color: var(--green); }

        .check-label-icon { margin-left: 4px; font-size: .8rem; }

        /* ════════════════════════════════════════════════════════
           DOCUMENT UPLOAD CARDS
        ════════════════════════════════════════════════════════ */
        .doc-card {
            border: 2px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 16px;
            transition: border-color var(--transition);
            background: var(--white);
            position: relative;
        }

        .doc-card.uploaded { border-color: var(--green); }
        .doc-card.warning  { border-color: var(--orange); }
        .doc-card.error    { border-color: var(--red); }

        .doc-card-header {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 16px;
        }

        .doc-badge {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .doc-badge.required { background: rgba(220,53,69,.1); color: var(--red); }
        .doc-badge.optional { background: var(--gold-light); color: var(--gold); }
        .doc-badge.uploaded { background: var(--green-pale); color: var(--green); }

        .doc-info { flex: 1; }

        .doc-title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2px;
        }

        .doc-hint {
            font-size: .77rem;
            color: var(--text-muted);
        }

        .required-badge {
            background: rgba(220,53,69,.1);
            color: var(--red);
            font-size: .7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .optional-badge {
            background: var(--gold-light);
            color: var(--gold);
            font-size: .7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .doc-body { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* Upload zone */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 18px 14px;
            text-align: center;
            cursor: pointer;
            transition: all var(--transition);
            background: #fafbfa;
            position: relative;
        }

        .upload-zone:hover, .upload-zone.drag-over {
            border-color: var(--green);
            background: var(--green-pale);
        }

        .upload-zone.has-file {
            border-color: var(--green);
            border-style: solid;
            background: var(--green-pale);
        }

        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon { font-size: 22px; color: var(--text-muted); margin-bottom: 6px; }
        .upload-zone.has-file .upload-icon { color: var(--green); }

        .upload-text { font-size: .78rem; color: var(--text-muted); font-weight: 600; }
        .upload-subtext { font-size: .72rem; color: var(--text-muted); margin-top: 2px; }

        .file-status {
            margin-top: 8px;
            font-size: .76rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .file-status.success { color: var(--green); }
        .file-status.error   { color: var(--red); }
        .file-status.warning { color: var(--orange); }

        /* Expiry date section */
        .expiry-wrap { display: flex; flex-direction: column; gap: 6px; }

        .expiry-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .expiry-tag {
            font-size: .7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .expiry-tag.valid   { background: var(--green-pale); color: var(--green); }
        .expiry-tag.expired { background: var(--red-pale); color: var(--red); }
        .expiry-tag.soon    { background: var(--orange-pale); color: var(--orange); }

        /* ════════════════════════════════════════════════════════
           TERMS CARD
        ════════════════════════════════════════════════════════ */
        .terms-card {
            background: #fffcf0;
            border: 2px solid #f0dfa0;
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 20px;
        }

        .terms-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .terms-header i { font-size: 20px; color: var(--gold); }

        .terms-header h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .terms-list {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .terms-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f0e8b8;
            font-size: .86rem;
            color: var(--text-mid);
        }

        .terms-list li:last-child { border-bottom: none; }

        .terms-list li i { color: var(--green); margin-top: 2px; flex-shrink: 0; }

        .terms-agree {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 14px 18px;
            background: var(--white);
            border: 2px solid var(--border);
            border-radius: var(--radius);
            transition: all var(--transition);
        }

        .terms-agree:hover { border-color: var(--green); }

        .terms-agree.checked { border-color: var(--green); background: var(--green-pale); }

        .terms-agree input { display: none; }

        .terms-checkbox {
            width: 24px; height: 24px;
            border: 2px solid var(--border);
            border-radius: 7px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
        }

        .terms-agree.checked .terms-checkbox {
            background: var(--green);
            border-color: var(--green);
            color: #fff;
        }

        .terms-checkbox::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: .8rem;
            opacity: 0;
            transition: opacity var(--transition);
        }

        .terms-agree.checked .terms-checkbox::after { opacity: 1; }

        .terms-agree-text {
            font-size: .88rem;
            font-weight: 700;
            color: var(--text-mid);
        }

        .terms-agree.checked .terms-agree-text { color: var(--green); }

        .declaration-body {
            font-size: .88rem;
            color: var(--text-mid);
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .decl-opening {
            margin-bottom: 14px;
            font-size: .88rem;
            color: var(--text-dark);
            line-height: 1.9;
        }

        .decl-name-inline {
            color: var(--green);
            font-weight: 800;
            font-size: .92rem;
            border-bottom: 2px dashed var(--green-light);
            padding-bottom: 1px;
        }

        .decl-sub-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
            font-size: .88rem;
        }

        .decl-list {
            padding-right: 22px;
            margin-bottom: 14px;
        }

        .decl-list li {
            padding: 5px 0;
            font-size: .86rem;
            color: var(--text-mid);
            line-height: 1.7;
        }

        .decl-footer-note {
            font-size: .85rem;
            color: var(--text-mid);
            background: rgba(200,169,81,.08);
            border-right: 3px solid var(--gold);
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 14px;
            line-height: 1.8;
        }

        .decl-closing {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
            font-size: .88rem;
        }

        .decl-signature {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px 18px;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sig-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
            font-size: .88rem;
        }

        .sig-label {
            font-weight: 700;
            color: var(--text-dark);
            min-width: 95px;
            flex-shrink: 0;
        }

        .sig-value {
            color: var(--green);
            font-weight: 600;
            border-bottom: 1px solid var(--green-border);
            flex: 1;
            padding-bottom: 2px;
        }

        /* ════════════════════════════════════════════════════════
           SAVE STATUS BANNER
        ════════════════════════════════════════════════════════ */
        .save-banner {
            position: fixed;
            bottom: 90px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: var(--text-dark);
            color: #fff;
            padding: 10px 20px;
            border-radius: 24px;
            font-size: .82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            pointer-events: none;
            transition: all .3s;
            z-index: 2000;
        }

        .save-banner.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ════════════════════════════════════════════════════════
           NAVIGATION BUTTONS
        ════════════════════════════════════════════════════════ */
        .nav-btns {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 20px 24px;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            margin-top: 24px;
            position: sticky;
            bottom: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border: none;
            border-radius: var(--radius);
            font-family: 'Cairo', sans-serif;
            font-size: .92rem;
            font-weight: 700;
            cursor: pointer;
            transition: all var(--transition);
            text-decoration: none;
        }

        .btn-outline {
            background: var(--white);
            border: 2px solid var(--border);
            color: var(--text-mid);
        }

        .btn-outline:hover { border-color: var(--green); color: var(--green); }

        .btn-primary {
            background: var(--green);
            color: #fff;
        }

        .btn-primary:hover { background: var(--green-mid); }

        .btn-primary:disabled {
            background: #a0b8a8;
            cursor: not-allowed;
        }

        .btn-gold {
            background: var(--gold);
            color: #fff;
        }

        .btn-gold:hover { background: #b8991e; }

        .btn-gold:disabled {
            background: #d4c080;
            cursor: not-allowed;
        }

        .btn i { font-size: .88rem; }

        /* Step indicator inside nav */
        .step-counter {
            font-size: .82rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .step-counter strong { color: var(--green); }

        /* ════════════════════════════════════════════════════════
           ADD DOCUMENT BUTTON
        ════════════════════════════════════════════════════════ */
        .btn-add-doc {
            width: 100%;
            padding: 14px;
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            background: transparent;
            font-family: 'Cairo', sans-serif;
            font-size: .88rem;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            transition: all var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-add-doc:hover {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-pale);
        }

        .btn-remove-doc {
            position: absolute;
            top: 14px;
            left: 14px;
            width: 28px; height: 28px;
            background: var(--red-pale);
            border: none;
            border-radius: 50%;
            color: var(--red);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            transition: all var(--transition);
        }

        .btn-remove-doc:hover { background: var(--red); color: #fff; }

        /* ════════════════════════════════════════════════════════
           REVIEW / SUMMARY (Step 4)
        ════════════════════════════════════════════════════════ */
        .review-section { margin-bottom: 20px; }

        .review-section-title {
            font-size: .8rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid var(--border);
        }

        .review-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .review-item { font-size: .85rem; }

        .review-item-label {
            color: var(--text-muted);
            margin-bottom: 2px;
            font-size: .78rem;
        }

        .review-item-value { color: var(--text-dark); font-weight: 600; }

        .review-doc-list { display: flex; flex-direction: column; gap: 8px; }

        .review-doc-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: var(--radius);
            background: var(--green-pale);
            font-size: .83rem;
        }

        .review-doc-item i { color: var(--green); }

        .review-doc-item.missing {
            background: var(--red-pale);
        }

        .review-doc-item.missing i { color: var(--red); }

        /* ════════════════════════════════════════════════════════
           MANDATORY NOTICE BANNER
        ════════════════════════════════════════════════════════ */
        .mandatory-notice {
            background: linear-gradient(135deg, #fff5f5 0%, #fdf0f0 100%);
            border: 2px solid #f5c6cb;
            border-radius: var(--radius-lg);
            padding: 18px 22px;
            margin-bottom: 20px;
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .mandatory-notice i {
            font-size: 22px;
            color: var(--red);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .mandatory-notice h4 {
            font-size: .92rem;
            font-weight: 700;
            color: #721c24;
            margin-bottom: 4px;
        }

        .mandatory-notice p {
            font-size: .82rem;
            color: #856464;
        }

        /* ════════════════════════════════════════════════════════
           SUCCESS STATE
        ════════════════════════════════════════════════════════ */
        .success-panel {
            text-align: center;
            padding: 60px 24px;
        }

        .success-icon {
            width: 90px; height: 90px;
            background: var(--green-pale);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: var(--green);
            margin-bottom: 20px;
        }

        .success-panel h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .success-panel p {
            font-size: .92rem;
            color: var(--text-muted);
            max-width: 420px;
            margin: 0 auto 24px;
        }

        /* ════════════════════════════════════════════════════════
           PRICE INPUT
        ════════════════════════════════════════════════════════ */
        .price-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .price-input-wrap .form-control {
            padding-left: 52px;
            border-radius: var(--radius);
        }

        .price-suffix {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 14px;
            background: var(--green-pale);
            border: 1px solid var(--green-border);
            border-right: none;
            border-radius: 0 var(--radius) var(--radius) 0;
            font-size: .82rem;
            font-weight: 700;
            color: var(--green);
            white-space: nowrap;
        }

        .price-note {
            font-size: .78rem;
            color: var(--text-muted);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .price-note i { color: var(--gold); }

        /* ════════════════════════════════════════════════════════
           RESPONSIVE
        ════════════════════════════════════════════════════════ */
        @media (max-width: 680px) {
            .form-grid-2 { grid-template-columns: 1fr; }
            .venue-types { grid-template-columns: 1fr 1fr; }
            .doc-body { grid-template-columns: 1fr; }
            .map-coords { grid-template-columns: 1fr; }
            .review-grid { grid-template-columns: 1fr; }
            .check-grid { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
            .hero h1 { font-size: 1.4rem; }
            .card-body { padding: 16px; }
            .nav-btns { padding: 14px 16px; }
            .btn { padding: 11px 18px; font-size: .85rem; }
            .steps-track { gap: 0; }
            .step-label { font-size: .65rem; }
        }

        @media (max-width: 440px) {
            .venue-types { grid-template-columns: 1fr; }
            .steps-track { overflow-x: auto; padding-bottom: 4px; }
        }

        /* ════════════════════════════════════════════════════════
           AVAILABILITY CALENDAR
        ════════════════════════════════════════════════════════ */
        .avail-cal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        .avail-cal-month-label {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -.3px;
        }

        .avail-cal-nav-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            background: var(--white);
            color: var(--text-mid);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .82rem;
            transition: all var(--transition);
        }

        .avail-cal-nav-btn:hover {
            background: var(--green-pale);
            border-color: var(--green-light);
            color: var(--green);
        }

        .avail-cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }

        .avail-day-name {
            text-align: center;
            font-size: .7rem;
            font-weight: 700;
            color: var(--text-muted);
            padding: 6px 0 10px;
        }

        .avail-day {
            text-align: center;
            border-radius: 9px;
            cursor: pointer;
            font-size: .83rem;
            font-weight: 500;
            transition: all var(--transition);
            border: 1.5px solid transparent;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            user-select: none;
        }

        .avail-day.empty { pointer-events: none; }

        .avail-day.past {
            color: var(--border);
            cursor: not-allowed;
        }

        .avail-day.past::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                -45deg,
                transparent, transparent 4px,
                rgba(0,0,0,.04) 4px, rgba(0,0,0,.04) 5px
            );
            border-radius: 9px;
        }

        .avail-day.avail { color: var(--text-dark); }

        .avail-day.avail:hover {
            background: var(--green-pale);
            border-color: var(--green-light);
            color: var(--green);
        }

        .avail-day.selected {
            background: var(--green);
            color: #fff !important;
            font-weight: 800;
            box-shadow: 0 3px 14px rgba(26,92,56,.35);
            border-color: var(--green);
        }

        .avail-day.before-sel {
            color: #ccc;
            cursor: not-allowed;
        }

        .avail-day.before-sel::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 18%;
            right: 18%;
            height: 1.5px;
            background: #ddd;
            border-radius: 2px;
        }

        .avail-day.after-sel {
            background: rgba(82,183,136,.13);
            color: var(--green-mid);
        }

        .avail-day.today { border-color: var(--gold); }

        .avail-day.today.avail {
            background: var(--gold-light);
            font-weight: 700;
        }

        .avail-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 18px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid var(--border);
        }

        .avail-legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .75rem;
            color: var(--text-muted);
        }

        .avail-legend-dot {
            width: 14px;
            height: 14px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .avail-result {
            display: none;
            align-items: center;
            gap: 14px;
            background: var(--green-pale);
            border: 1.5px solid var(--green-light);
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 18px;
        }

        .avail-result.show { display: flex; }

        .avail-result-icon {
            width: 42px;
            height: 42px;
            background: var(--green);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .avail-result-label {
            font-size: .76rem;
            color: var(--text-muted);
            margin-bottom: 3px;
        }

        .avail-result-date {
            font-size: 1rem;
            font-weight: 800;
            color: var(--green);
        }

        .avail-blocked-note {
            display: none;
            align-items: flex-start;
            gap: 10px;
            background: rgba(220,53,69,.04);
            border: 1px solid rgba(220,53,69,.18);
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 10px;
            font-size: .82rem;
            color: #c0392b;
            line-height: 1.7;
        }

        .avail-blocked-note.show { display: flex; }
        .avail-blocked-note i { margin-top: 2px; flex-shrink: 0; }
    </style>
</head>
<body>

@include('partials.sidebar_nav')

    <!-- TOP HEADER -->
    <header class="top-header">
        <a href="{{ url('/') }}" class="header-logo">أمر <span>تم</span></a>
        <a href="{{ route('login') }}" class="header-login-link">
            <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
        </a>
    </header>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-icon-wrap"><i class="fas fa-building-circle-check"></i></div>
        <h1>تسجيل منشأة جديدة</h1>
        <p>أضف قاعتك أو استراحتك أو شاليهك لمنصة أمر تم في خطوات بسيطة</p>
    </div>

    <!-- PROGRESS -->
    <div class="progress-wrapper">
        <div class="steps-track" id="stepsTrack">
            <div class="step-item active" data-step="1">
                <div class="step-bubble"><i class="fas fa-check" style="display:none"></i><span>1</span></div>
                <div class="step-label">بياناتك</div>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-bubble"><i class="fas fa-check" style="display:none"></i><span>2</span></div>
                <div class="step-label">المنشأة</div>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-bubble"><i class="fas fa-check" style="display:none"></i><span>3</span></div>
                <div class="step-label">التراخيص</div>
            </div>
            <div class="step-item" data-step="4">
                <div class="step-bubble"><i class="fas fa-check" style="display:none"></i><span>4</span></div>
                <div class="step-label">المراجعة</div>
            </div>
        </div>
        <div class="progress-bar-line">
            <div class="progress-bar-fill" id="progressFill" style="width:25%"></div>
        </div>
    </div>

    <!-- MAIN FORM -->
    <div class="page-body">
        <form id="ownerRegisterForm" method="POST" action="{{ route('register.owner.submit') }}" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- Server-side validation errors --}}
            @if($errors->any())
            <div id="server-error-banner" style="background:#fef2f2;border:1.5px solid #fca5a5;border-radius:14px;padding:16px 20px;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                    <i class="fas fa-exclamation-circle" style="color:#dc2626;font-size:1.2rem;"></i>
                    <strong style="color:#991b1b;font-size:.95rem;">يوجد أخطاء في البيانات المُدخلة — يرجى المراجعة:</strong>
                </div>
                <ul style="margin:0;padding-right:20px;color:#b91c1c;font-size:.87rem;line-height:2;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- ═══════════════════════════════════════════
                 STEP 1 — USER INFO
            ═══════════════════════════════════════════ -->
            <div class="step-panel visible" id="step-1">

                <!-- Personal Info Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-user-circle"></i></div>
                        <div>
                            <div class="card-title">إنشاء حساب المنشأة</div>
                            <div class="card-subtitle">معلومات الشخص المسؤول عن المنشأة</div>
                        </div>
                    </div>
                    <div class="card">
                        <!-- نوع الكيان القانوني -->
                        <div class="entity-type-row">
                            <label class="entity-type-btn" id="entity-institution">
                                <input type="radio" name="entity_type" value="institution" class="entity-type-radio">
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <i class="fas fa-landmark"></i>
                                <span>مؤسسة</span>
                            </label>
                            <label class="entity-type-btn" id="entity-company">
                                <input type="radio" name="entity_type" value="company" class="entity-type-radio">
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <i class="fas fa-building"></i>
                                <span>شركة</span>
                            </label>
                            <label class="entity-type-btn" id="entity-officiant">
                                <input type="radio" name="entity_type" value="officiant" class="entity-type-radio">
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <i class="fas fa-scroll"></i>
                                <span>مأذون شرعي</span>
                            </label>
                        </div>
                        <!-- hidden input يضمن إرسال account_type=officiant عند اختيار المأذون -->
                        <input type="hidden" id="account_type_resolved" name="account_type" value="hall">
                        <input type="hidden" id="officiant_full_name" name="officiant_full_name" value="">
                    </div>
                </div>{{-- /card إنشاء حساب المنشأة --}}

                <!-- نوع الحساب -->
                <div class="card" id="account-type-card">
                    <div class="card-header">
                        <div class="card-icon gold"><i class="fas fa-briefcase"></i></div>
                        <div>
                            <div class="card-title">نوع الحساب</div>
                            <div class="card-subtitle">اختر نوع حسابك كشريك معنا</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="venue-types">
                            <label class="account-type-btn venue-type-btn selected" id="account-hall">
                                <input type="radio" name="_account_type_ui" value="hall" class="account-type-radio venue-type-radio" checked>
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <i class="fas fa-building"></i>
                                <span>مالك قاعة / استراحة</span>
                            </label>
                            <label class="account-type-btn venue-type-btn" id="account-service">
                                <input type="radio" name="_account_type_ui" value="service" class="account-type-radio venue-type-radio">
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <i class="fas fa-gift"></i>
                                <span>مقدم خدمة تكاملية</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- نوع النشاط -->
                <div class="card" id="venue-type-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-star"></i></div>
                        <div>
                            <div class="card-title">نوع النشاط</div>
                            <div class="card-subtitle">اختر نوع المنشأة التي ترغب في تسجيلها</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="venue-types">
                            <label class="venue-type-btn selected" id="type-hall">
                                <input type="radio" name="venue_type" value="wedding_hall" class="venue-type-radio" checked>
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <i class="fas fa-building"></i>
                                <span>قاعة أفراح</span>
                            </label>
                            <label class="venue-type-btn coming-soon" id="type-retreat">
                                <i class="fas fa-tree"></i>
                                <span>استراحة</span>
                            </label>
                            <label class="venue-type-btn coming-soon" id="type-chalet">
                                <i class="fas fa-umbrella-beach"></i>
                                <span>شاليه</span>
                            </label>
                        </div>
                        <div class="invalid-msg" id="venue-type-error" style="display:none; margin-top:12px;">
                            <i class="fas fa-exclamation-circle"></i> الرجاء اختيار نوع المنشأة
                        </div>
                    </div>
                </div>

                <!-- بيانات التسجيل -->
                <div class="card" id="reg-data-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-file-alt"></i></div>
                        <div>
                            <div class="card-title" id="reg-data-title">بيانات التسجيل</div>
                            <div class="card-subtitle" id="reg-data-subtitle">معلومات تعريفية للمنشأة</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-grid-2" id="reg-row-1" style="grid-template-columns: 1fr 1fr 1fr;">
                            <div class="form-group">
                                <label class="form-label" for="venue_name">
                                    <span class="form-label-icon"><i class="fas fa-tag"></i></span>
                                    <span id="venue-name-label-text">اسم المنشأة</span>
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-tag"></i>
                                    <input type="text" id="venue_name" name="venue_name" class="form-control"
                                        value="{{ old('venue_name') }}" required>
                                </div>
                                <div class="invalid-msg" id="venue-name-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل اسم المنشأة
                                </div>
                            </div>
                            <div class="form-group" id="reg-number-group">
                                <label class="form-label" for="venue_registration_number">
                                    <span class="form-label-icon"><i class="fas fa-id-card"></i></span>
                                    رقم السجل
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-id-card"></i>
                                    <input type="text" id="venue_registration_number" name="venue_registration_number" class="form-control"
                                        value="{{ old('venue_registration_number') }}">
                                </div>
                                <div class="invalid-msg" id="venue-registration-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل رقم السجل
                                </div>
                            </div>
                            <div class="form-group" id="unified-number-group">
                                <label class="form-label" for="venue_unified_number">
                                    <span class="form-label-icon"><i class="fas fa-hashtag"></i></span>
                                    الرقم الموحد
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-hashtag"></i>
                                    <input type="text" id="venue_unified_number" name="venue_unified_number" class="form-control"
                                        value="{{ old('venue_unified_number') }}">
                                </div>
                                <div class="invalid-msg" id="venue-unified-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل الرقم الموحد
                                </div>
                            </div>
                        </div>

                        <div class="form-grid-2" style="grid-template-columns: 1fr 1fr 1fr;">
                            <div class="form-group">
                                <label class="form-label" for="venue_phone">
                                    <span class="form-label-icon"><i class="fas fa-phone-alt"></i></span>
                                    رقم الهاتف
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-phone-alt"></i>
                                    <input type="text" id="venue_phone" name="venue_phone" class="form-control"
                                        placeholder="011XXXXXXX"
                                        value="{{ old('venue_phone') }}" required>
                                </div>
                                <div class="invalid-msg" id="venue-phone-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل رقم الهاتف
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="venue_email">
                                    <span class="form-label-icon"><i class="fas fa-envelope"></i></span>
                                    <span id="venue-email-label-text">بريد المؤسسة الإلكتروني</span>
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-envelope"></i>
                                    <input type="email" id="venue_email" name="venue_email" class="form-control"
                                        placeholder="info@example.com"
                                        value="{{ old('venue_email') }}" required>
                                </div>
                                <div class="invalid-msg" id="venue-email-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل البريد الإلكتروني
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="user_phone">
                                    <span class="form-label-icon"><i class="fas fa-mobile-alt"></i></span>
                                    رقم الجوال
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-mobile-alt"></i>
                                    <input type="text" id="user_phone" name="user_phone" class="form-control"
                                        placeholder="05XXXXXXXX"
                                        value="{{ old('user_phone') }}" required>
                                </div>
                                <div class="invalid-msg" id="user-phone-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل رقم الجوال
                                </div>
                            </div>
                        </div>

                        <!-- حقول كلمة المرور — تظهر فقط للمأذون الشرعي -->
                        <div id="officiant-password-row" style="display:none;">
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="form-label" for="officiant_password_input">
                                        <span class="form-label-icon"><i class="fas fa-lock"></i></span>
                                        كلمة المرور
                                        <span class="required-star">*</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="input-icon fas fa-lock"></i>
                                        <input type="password" id="officiant_password_input" name="password"
                                            class="form-control" placeholder="••••••••"
                                            autocomplete="new-password"
                                            oninput="checkPasswordStrength(this.value)">
                                        <button type="button" class="toggle-pass" onclick="togglePass('officiant_password_input', this)" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength">
                                        <div class="strength-bar">
                                            <div class="strength-fill" id="strengthFillOfficiant"></div>
                                        </div>
                                        <div class="strength-text" id="strengthTextOfficiant">أدخل كلمة مرور (8 أحرف على الأقل)</div>
                                    </div>
                                    <div class="invalid-msg" id="officiant-password-error" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> كلمة المرور يجب أن تكون 8 أحرف على الأقل
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="officiant_confirm_input">
                                        <span class="form-label-icon"><i class="fas fa-lock"></i></span>
                                        تأكيد كلمة المرور
                                        <span class="required-star">*</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="input-icon fas fa-lock"></i>
                                        <input type="password" id="officiant_confirm_input" name="password_confirmation"
                                            class="form-control" placeholder="••••••••" autocomplete="new-password">
                                        <button type="button" class="toggle-pass" onclick="togglePass('officiant_confirm_input', this)" tabindex="-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-msg" id="officiant-confirm-error" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> كلمتا المرور غير متطابقتين
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>{{-- /card بيانات التسجيل --}}
                <!-- Officiant Extra Fields -->
                <div class="card" id="officiant-fields-card" style="display:none;">
                    <div class="card-header">
                        <div class="card-icon gold"><i class="fas fa-id-badge"></i></div>
                        <div>
                            <div class="card-title">بيانات المأذون الشرعي</div>
                            <div class="card-subtitle">معلومات إضافية خاصة بالمأذون الشرعي</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-grid-2" style="grid-template-columns: 1fr 1fr;">
                            <div class="form-group">
                                <label class="form-label" for="officiant_license_number">
                                    <span class="form-label-icon"><i class="fas fa-id-card"></i></span>
                                    رقم الرخصة
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-id-card"></i>
                                    <input type="text" id="officiant_license_number" name="officiant_license_number" class="form-control"
                                        placeholder="أدخل رقم رخصة المأذون"
                                        value="{{ old('officiant_license_number') }}">
                                </div>
                                <div class="invalid-msg" id="officiant-license-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل رقم الرخصة
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="officiant_working_hours">
                                    <span class="form-label-icon"><i class="fas fa-clock"></i></span>
                                    ساعات الدوام
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-clock"></i>
                                    <input type="text" id="officiant_working_hours" name="officiant_working_hours" class="form-control"
                                        placeholder="مثال: 8:00 ص — 5:00 م"
                                        value="{{ old('officiant_working_hours') }}">
                                </div>
                                <div class="invalid-msg" id="officiant-hours-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل ساعات الدوام
                                </div>
                            </div>
                        </div>
                        <div class="form-grid-2" style="grid-template-columns: 1fr 1fr;">
                            <div class="form-group">
                                <label class="form-label" for="officiant_bank_account">
                                    <span class="form-label-icon"><i class="fas fa-university"></i></span>
                                    الحساب البنكي
                                    <span class="optional-tag">اختياري</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-university"></i>
                                    <input type="text" id="officiant_bank_account" name="officiant_bank_account" class="form-control"
                                        placeholder="رقم الحساب البنكي"
                                        value="{{ old('officiant_bank_account') }}">
                                </div>
                                <div class="invalid-msg" id="officiant-bank-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل رقم الحساب البنكي
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="officiant_iban">
                                    <span class="form-label-icon"><i class="fas fa-money-check-alt"></i></span>
                                    الآيبان (IBAN)
                                    <span class="optional-tag">اختياري</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-money-check-alt"></i>
                                    <input type="text" id="officiant_iban" name="officiant_iban" class="form-control"
                                        placeholder="SA0000000000000000000000"
                                        value="{{ old('officiant_iban') }}"
                                        style="letter-spacing:.5px;">
                                </div>
                                <div class="invalid-msg" id="officiant-iban-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل رقم الآيبان
                                </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- /card officiant fields --}}

                <!-- Venue Details -->
                <div class="card" id="venue-details-card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-building"></i></div>
                        <div>
                            <div class="card-title">بيانات المنشأة</div>
                            <div class="card-subtitle">معلومات أساسية عن قاعتك</div>
                        </div>
                    </div>

                <div class="card-body">

                        <!-- ── بيانات ممثل النظام ── -->
                        <div class="section-divider">
                            <i class="fas fa-id-badge"></i>
                            <span> الممثل النظامي (المدير)</span>
                        </div>

                        <div class="form-grid-2" style="grid-template-columns: 1fr 1fr 1fr;">
                            <div class="form-group">
                                <label class="form-label" for="rep_first_name">
                                    <span class="form-label-icon"><i class="fas fa-user"></i></span>
                                    الاسم
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-user"></i>
                                    <input type="text" id="rep_first_name" name="rep_first_name" class="form-control"
                                        placeholder=""
                                        value="{{ old('rep_first_name') }}" required>
                                </div>
                                <div class="invalid-msg" id="rep-first-name-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل الاسم
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="rep_father_name">
                                    <span class="form-label-icon"><i class="fas fa-user"></i></span>
                                    اسم الأب
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-user"></i>
                                    <input type="text" id="rep_father_name" name="rep_father_name" class="form-control"
                                        placeholder=""
                                        value="{{ old('rep_father_name') }}" required>
                                </div>
                                <div class="invalid-msg" id="rep-father-name-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل اسم الأب
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="rep_grandfather_name">
                                    <span class="form-label-icon"><i class="fas fa-user"></i></span>
                                    اسم العائلة
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-user"></i>
                                    <input type="text" id="rep_grandfather_name" name="rep_grandfather_name" class="form-control"
                                        placeholder=""
                                        value="{{ old('rep_grandfather_name') }}" required>
                                </div>
                                <div class="invalid-msg" id="rep-grandfather-name-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل اسم العائلة
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="phone">
                                <span class="form-label-icon"><i class="fas fa-mobile-alt"></i></span>
                                رقم الجوال
                                <span class="required-star">*</span>
                            </label>
                            <div class="phone-input-wrap">
                                <div class="phone-prefix">🇸🇦 +966</div>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="5XXXXXXXX"
                                    value="{{ old('phone') }}" required autocomplete="tel"
                                    maxlength="9" pattern="[0-9]{9}">
                            </div>
                            <div class="hint-msg">أدخل الرقم بدون الصفر الأول — مثال: 512345678</div>
                            <div class="invalid-msg" id="phone-error" style="display:none">
                                <i class="fas fa-exclamation-circle"></i> أدخل رقم جوال سعودي صحيح (9 أرقام)
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">
                                <span class="form-label-icon"><i class="fas fa-envelope"></i></span>
                                البريد الإلكتروني
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-wrap">
                                <i class="input-icon fas fa-envelope"></i>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="owner@example.com"
                                    value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            <div class="invalid-msg" id="email-error" style="display:none">
                                <i class="fas fa-exclamation-circle"></i> أدخل بريد إلكتروني صحيح
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="password">
                                    <span class="form-label-icon"><i class="fas fa-lock"></i></span>
                                    كلمة المرور
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-lock"></i>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="••••••••" required autocomplete="new-password"
                                        oninput="checkPasswordStrength(this.value)">
                                    <button type="button" class="toggle-pass" onclick="togglePass('password', this)" tabindex="-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <div class="strength-text" id="strengthText">أدخل كلمة مرور (8 أحرف على الأقل)</div>
                                </div>
                                <div class="invalid-msg" id="password-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> كلمة المرور يجب أن تكون 8 أحرف على الأقل
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">
                                    <span class="form-label-icon"><i class="fas fa-lock"></i></span>
                                    تأكيد كلمة المرور
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-lock"></i>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="••••••••" required autocomplete="new-password">
                                    <button type="button" class="toggle-pass" onclick="togglePass('password_confirmation', this)" tabindex="-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-msg" id="confirm-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> كلمتا المرور غير متطابقتين
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Nav -->
                <div class="nav-btns">
                    <a href="{{ route('register') }}" class="btn btn-outline">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                    <span class="step-counter">الخطوة <strong>1</strong> من 4</span>
                    <button type="button" class="btn btn-primary" onclick="goNext(1)">
                        التالي <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- ═══════════════════════════════════════════
                 STEP 2 — VENUE INFO
            ═══════════════════════════════════════════ -->
            <div class="step-panel" id="step-2">

                <!-- Availability Calendar Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <div class="card-title">تاريخ إتاحة القاعة</div>
                            <div class="card-subtitle">حدد اليوم الذي تبدأ فيه قاعتك بقبول الحجوزات</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="available_from" name="available_from" value="{{ old('available_from') }}">

                        <div class="avail-cal-head">
                            <button type="button" class="avail-cal-nav-btn" id="avail-prev">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="avail-cal-month-label" id="avail-month-label"></div>
                            <button type="button" class="avail-cal-nav-btn" id="avail-next">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        </div>

                        <div class="avail-cal-grid" id="avail-grid"></div>

                        <div class="avail-legend">
                            <div class="avail-legend-item">
                                <div class="avail-legend-dot" style="background:var(--green);"></div>
                                <span>تاريخ الإتاحة</span>
                            </div>
                            <div class="avail-legend-item">
                                <div class="avail-legend-dot" style="background:rgba(82,183,136,.15); border:1px solid var(--green-light);"></div>
                                <span>متاح للحجز</span>
                            </div>
                            <div class="avail-legend-item">
                                <div class="avail-legend-dot" style="background:var(--bg); border:1px solid var(--border);"></div>
                                <span>مغلق</span>
                            </div>
                            <div class="avail-legend-item">
                                <div class="avail-legend-dot" style="border:1.5px solid var(--gold); background:var(--gold-light);"></div>
                                <span>اليوم</span>
                            </div>
                        </div>

                        <div class="avail-result" id="avail-result">
                            <div class="avail-result-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <div class="avail-result-label">تاريخ الإتاحة المحدد:</div>
                                <div class="avail-result-date" id="avail-result-date"></div>
                            </div>
                        </div>

                        <div class="avail-blocked-note" id="avail-blocked-note">
                            <i class="fas fa-ban"></i>
                            <span>جميع الأيام السابقة لهذا التاريخ <strong>مغلقة تلقائياً</strong> ولن تظهر للعملاء للحجز.</span>
                        </div>

                        <div class="invalid-msg" id="avail-date-error" style="display:none">
                            <i class="fas fa-exclamation-circle"></i> الرجاء تحديد تاريخ إتاحة القاعة
                        </div>
                    </div>
                </div>

                <!-- Pricing Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon gold"><i class="fas fa-tag"></i></div>
                        <div>
                            <div class="card-title">التسعير</div>
                            <div class="card-subtitle">حدد السعر المبدئي لحجز منشأتك</div>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Price per day (hall only) -->
                        <div class="form-group" id="price-hall-group">
                            <label class="form-label" for="price_per_day">
                                <span class="form-label-icon"><i class="fas fa-tag"></i></span>
                                السعر الأولي لليوم
                                <span class="optional-tag">اختياري</span>
                            </label>
                            <div class="price-input-wrap">
                                <input type="number" id="price_per_day" name="price_per_day" class="form-control"
                                    placeholder="0" min="0" step="1"
                                    value="{{ old('price_per_day') }}">
                                <span class="price-suffix">ريال / يوم</span>
                            </div>
                            <div class="price-note">
                                <i class="fas fa-info-circle"></i>
                                يمكنك تعديل السعر لاحقاً من لوحة التحكم
                            </div>
                            <div class="invalid-msg" id="price-hall-error" style="display:none">
                                <i class="fas fa-exclamation-circle"></i> أدخل السعر الأولي لليوم
                            </div>
                        </div>

                        <!-- Base price (service / officiant) -->
                        <div class="form-group" id="price-service-group" style="display:none;">
                            <label class="form-label" for="base_price">
                                <span class="form-label-icon"><i class="fas fa-tag"></i></span>
                                <span id="base-price-label">السعر الأولي للخدمة</span>
                                <span class="optional-tag">اختياري</span>
                            </label>
                            <div class="price-input-wrap">
                                <input type="number" id="base_price" name="base_price" class="form-control"
                                    placeholder="0" min="0" step="1"
                                    value="{{ old('base_price') }}">
                                <span class="price-suffix">ريال</span>
                            </div>
                            <div class="price-note">
                                <i class="fas fa-info-circle"></i>
                                يمكنك تعديل السعر وإضافة تفاصيل الخدمات من لوحة التحكم
                            </div>
                            <div class="invalid-msg" id="price-service-error" style="display:none">
                                <i class="fas fa-exclamation-circle"></i> أدخل السعر الأولي للخدمة
                            </div>
                        </div>

                        <!-- Category (service / officiant) -->
                        @if(isset($partnerCategories) && $partnerCategories->count() > 0)
                        <div class="form-group" id="category-service-group" style="display:none;">
                            <label class="form-label" for="partner_category_id">
                                <span class="form-label-icon"><i class="fas fa-layer-group"></i></span>
                                تصنيف الخدمة
                            </label>
                            <select id="partner_category_id" name="partner_category_id" class="form-control">
                                <option value="">-- اختر تصنيف خدمتك --</option>
                                @foreach($partnerCategories as $cat)
                                <option value="{{ $cat->id }}" {{ old('partner_category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                    </div>
                </div>{{-- /card التسعير --}}

                <!-- Location -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-location-dot"></i></div>
                        <div>
                            <div class="card-title">موقع المنشأة</div>
                            <div class="card-subtitle">حدد موقعك على الخريطة أو أدخل العنوان يدوياً</div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="map-search-wrap">
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-search"></i>
                                    <input type="text" id="map-search" class="form-control"
                                        placeholder="ابحث عن موقعك... مثال: الرياض، حي النزهة">
                                </div>
                            </div>
                            <div id="map"></div>
                            <div class="hint-msg" style="text-align:center; margin-top:6px;">
                                <i class="fas fa-hand-pointer"></i> انقر على الخريطة لتحديد الموقع الدقيق أو اسحب العلامة
                            </div>
                        </div>

                        <div class="map-coords">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="latitude">خط العرض</label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-crosshairs"></i>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        placeholder="24.7136" readonly>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="longitude">خط الطول</label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-crosshairs"></i>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        placeholder="46.6753" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top:18px;">
                            <label class="form-label" for="address">
                                <span class="form-label-icon"><i class="fas fa-map-marker-alt"></i></span>
                                العنوان الوطني
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-wrap">
                                <i class="input-icon fas fa-map-marker-alt"></i>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="مثال: JHHA3454"
                                    maxlength="8"
                                    pattern="[a-zA-Z]{4}[0-9]{4}"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase()"
                                    value="{{ old('address') }}" required>
                            </div>
                            <div class="hint-msg">
                                <i class="fas fa-info-circle"></i>
                                مثال: JHHA3454
                            </div>
                            <div class="invalid-msg" id="address-error" style="display:none">
                                <i class="fas fa-exclamation-circle"></i> أدخل العنوان الوطني بصيغة صحيحة (4 أحرف + 4 أرقام)
                            </div>
                        </div>

                        <!-- تنبيه التعبئة التلقائية -->
                        <div class="map-autofill-note" id="map-autofill-note" style="display:none;">
                            <i class="fas fa-map-pin"></i>
                            <span>تم تعبئة الحقول أدناه تلقائياً من الموقع المحدد على الخريطة — يمكنك تعديلها يدوياً</span>
                        </div>

                        <!-- الصف الأول: الدولة | المحافظة / المدينة | الشارع -->
                        <div class="form-grid-2" style="grid-template-columns:1fr 1fr 1fr; margin-top:16px;">
                            <div class="form-group">
                                <label class="form-label" for="country">
                                    <span class="form-label-icon"><i class="fas fa-globe"></i></span>
                                    الدولة
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-globe"></i>
                                    <input type="text" id="country" name="country" class="form-control"
                                        placeholder="المملكة العربية السعودية"
                                        value="{{ old('country') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="city">
                                    <span class="form-label-icon"><i class="fas fa-city"></i></span>
                                    المحافظة / المدينة
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-city"></i>
                                    <input type="text" id="city" name="city" class="form-control"
                                        placeholder="الرياض"
                                        value="{{ old('city') }}" required>
                                </div>
                                <div class="invalid-msg" id="city-error" style="display:none">
                                    <i class="fas fa-exclamation-circle"></i> أدخل المدينة
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="street">
                                    <span class="form-label-icon"><i class="fas fa-road"></i></span>
                                    الشارع
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-road"></i>
                                    <input type="text" id="street" name="street" class="form-control"
                                        placeholder="اسم الشارع"
                                        value="{{ old('street') }}">
                                </div>
                            </div>
                        </div>

                        <!-- الصف الثاني: رقم المبنى | الدور | رقم المكتب -->
                        <div class="form-grid-2" style="grid-template-columns:1fr 1fr 1fr;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label" for="building_number">
                                    <span class="form-label-icon"><i class="fas fa-door-open"></i></span>
                                    رقم المبنى
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-door-open"></i>
                                    <input type="text" id="building_number" name="building_number" class="form-control"
                                        placeholder="١٢٣"
                                        value="{{ old('building_number') }}">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label" for="floor">
                                    <span class="form-label-icon"><i class="fas fa-layer-group"></i></span>
                                    الدور
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-layer-group"></i>
                                    <input type="text" id="floor" name="floor" class="form-control"
                                        placeholder="الأرضي"
                                        value="{{ old('floor') }}">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label" for="office_number">
                                    <span class="form-label-icon"><i class="fas fa-hashtag"></i></span>
                                    رقم المكتب / الوحدة
                                </label>
                                <div class="input-wrap">
                                    <i class="input-icon fas fa-hashtag"></i>
                                    <input type="text" id="office_number" name="office_number" class="form-control"
                                        placeholder="٤٥"
                                        value="{{ old('office_number') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Services -->
                {{-- <div class="card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-concierge-bell"></i></div>
                        <div>
                            <div class="card-title">الخدمات المقدمة</div>
                            <div class="card-subtitle">اختر الخدمات المتاحة في منشأتك</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="check-grid" id="services-grid">
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="catering">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🍽️</span> خدمة تقديم الطعام</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="decoration">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🌸</span> تزيين وديكور</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="photography">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">📸</span> تصوير وفيديو</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="music">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🎵</span> موسيقى وإضاءة</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="security">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🔐</span> حراسة وأمن</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="valet">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🚗</span> خدمة صف السيارات</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="flowers">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">💐</span> تنسيق الزهور</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="kids_area">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🎠</span> منطقة أطفال</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="stage">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🎪</span> منصة وشاشة</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="services[]" value="bridal_suite">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">👰</span> جناح العروسين</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-list-check"></i></div>
                        <div>
                            <div class="card-title">المرافق والتجهيزات</div>
                            <div class="card-subtitle">حدد المرافق المتوفرة في منشأتك</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="check-grid">
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="parking">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🅿️</span> مواقف سيارات</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="kitchen">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🍳</span> مطبخ مجهز</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="rooms">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🛏️</span> غرف نوم</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="prayer_room">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🕌</span> غرفة صلاة</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="ac">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">❄️</span> تكييف مركزي</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="wifi">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">📶</span> واي فاي</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="generator">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">⚡</span> مولد كهرباء</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="pool">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🏊</span> مسبح</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="garden">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">🌿</span> حديقة خارجية</span>
                            </label>
                            <label class="check-item" onclick="toggleCheck(this)">
                                <input type="checkbox" name="amenities[]" value="accessible">
                                <div class="check-box"></div>
                                <span class="check-label"><span class="check-label-icon">♿</span> مناسب لذوي الاحتياجات</span>
                            </label>
                        </div>
                    </div>
                </div> --}}

                <!-- Nav -->
                <div class="nav-btns">
                    <button type="button" class="btn btn-outline" onclick="goTo(1)">
                        <i class="fas fa-arrow-right"></i> السابق
                    </button>
                    <span class="step-counter">الخطوة <strong>2</strong> من 4</span>
                    <button type="button" class="btn btn-primary" onclick="goNext(2)">
                        التالي <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- ═══════════════════════════════════════════
                 STEP 3 — LICENSES
            ═══════════════════════════════════════════ -->
            <div class="step-panel" id="step-3">

                <!-- Mandatory Notice -->
                <div class="mandatory-notice">
                    <i class="fas fa-shield-exclamation"></i>
                    <div>
                        <h4>التراخيص الإلزامية — مطلوبة قبل قبول الطلب</h4>
                        <p>يُشترط رفع جميع التراخيص الأربعة ادناه (سارية المفعول وواضحة) حتى يتم قبول طلبك على منصة أمر تم. الملفات المقبولة: PDF، JPG، PNG.</p>
                    </div>
                </div>

                <!-- Required Docs -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon red"><i class="fas fa-file-certificate"></i></div>
                        <div>
                            <div class="card-title">التراخيص الأساسية</div>
                            <div class="card-subtitle">جميع الوثائق التالية إلزامية</div>
                        </div>
                    </div>
                    <div class="card-body" style="padding-top:16px;">

                        <!-- Doc 1: Commercial Register -->
                        <div class="doc-card" id="doc-card-cr" data-doc="cr">
                            <div class="doc-card-header">
                                <div class="doc-badge required" id="badge-cr">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <div class="doc-info">
                                    <div class="doc-title">السجل التجاري</div>
                                    <div class="doc-hint">ارفع نسخة من السجل التجاري ساري المفعول</div>
                                </div>
                                <span class="required-badge">إلزامي</span>
                            </div>
                            <div class="doc-body">
                                <div>
                                    <label class="form-label" style="font-size:.8rem; margin-bottom:6px;">رفع الملف</label>
                                    <div class="upload-zone" id="zone-cr" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event,'cr')">
                                        <input type="file" name="doc_commercial_register" id="file-cr"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFileSelect(this,'cr')">
                                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <div class="upload-text">اسحب الملف هنا أو اضغط للرفع</div>
                                        <div class="upload-subtext">PDF · JPG · PNG (حجم أقصى 5MB)</div>
                                    </div>
                                    <div class="file-status" id="file-status-cr"></div>
                                </div>
                                <div class="expiry-wrap">
                                    <div class="expiry-label-row">
                                        <label class="form-label" style="font-size:.8rem;">تاريخ الانتهاء <span class="required-star">*</span></label>
                                        <span class="expiry-tag" id="expiry-tag-cr"></span>
                                    </div>
                                    <input type="date" name="doc_cr_expiry" id="expiry-cr"
                                        class="form-control" style="font-size:.85rem;"
                                        onchange="checkExpiry('cr')" required>
                                    <div class="hint-msg">يجب أن يكون التاريخ في المستقبل</div>
                                    <div class="invalid-msg" id="expiry-error-cr" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> أدخل تاريخ صحيح
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doc 2: Municipal License -->
                        <div class="doc-card" id="doc-card-ml" data-doc="ml">
                            <div class="doc-card-header">
                                <div class="doc-badge required" id="badge-ml">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div class="doc-info">
                                    <div class="doc-title">الرخصة البلدية</div>
                                    <div class="doc-hint">رخصة مزاولة النشاط الصادرة من الأمانة أو البلدية</div>
                                </div>
                                <span class="required-badge">إلزامي</span>
                            </div>
                            <div class="doc-body">
                                <div>
                                    <label class="form-label" style="font-size:.8rem; margin-bottom:6px;">رفع الملف</label>
                                    <div class="upload-zone" id="zone-ml" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event,'ml')">
                                        <input type="file" name="doc_municipal_license" id="file-ml"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFileSelect(this,'ml')">
                                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <div class="upload-text">اسحب الملف هنا أو اضغط للرفع</div>
                                        <div class="upload-subtext">PDF · JPG · PNG (حجم أقصى 5MB)</div>
                                    </div>
                                    <div class="file-status" id="file-status-ml"></div>
                                </div>
                                <div class="expiry-wrap">
                                    <div class="expiry-label-row">
                                        <label class="form-label" style="font-size:.8rem;">تاريخ الانتهاء <span class="required-star">*</span></label>
                                        <span class="expiry-tag" id="expiry-tag-ml"></span>
                                    </div>
                                    <input type="date" name="doc_ml_expiry" id="expiry-ml"
                                        class="form-control" style="font-size:.85rem;"
                                        onchange="checkExpiry('ml')" required>
                                    <div class="hint-msg">يجب أن يكون التاريخ في المستقبل</div>
                                    <div class="invalid-msg" id="expiry-error-ml" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> أدخل تاريخ صحيح
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doc 3: Operating License -->
                        <div class="doc-card" id="doc-card-ol" data-doc="ol">
                            <div class="doc-card-header">
                                <div class="doc-badge required" id="badge-ol">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="doc-info">
                                    <div class="doc-title">رخصة التشغيل</div>
                                    <div class="doc-hint">الرخصة الرسمية لتشغيل هذه المنشأة</div>
                                </div>
                                <span class="required-badge">إلزامي</span>
                            </div>
                            <div class="doc-body">
                                <div>
                                    <label class="form-label" style="font-size:.8rem; margin-bottom:6px;">رفع الملف</label>
                                    <div class="upload-zone" id="zone-ol" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event,'ol')">
                                        <input type="file" name="doc_operating_license" id="file-ol"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFileSelect(this,'ol')">
                                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <div class="upload-text">اسحب الملف هنا أو اضغط للرفع</div>
                                        <div class="upload-subtext">PDF · JPG · PNG (حجم أقصى 5MB)</div>
                                    </div>
                                    <div class="file-status" id="file-status-ol"></div>
                                </div>
                                <div class="expiry-wrap">
                                    <div class="expiry-label-row">
                                        <label class="form-label" style="font-size:.8rem;">تاريخ الانتهاء <span class="required-star">*</span></label>
                                        <span class="expiry-tag" id="expiry-tag-ol"></span>
                                    </div>
                                    <input type="date" name="doc_ol_expiry" id="expiry-ol"
                                        class="form-control" style="font-size:.85rem;"
                                        onchange="checkExpiry('ol')" required>
                                    <div class="hint-msg">يجب أن يكون التاريخ في المستقبل</div>
                                    <div class="invalid-msg" id="expiry-error-ol" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> أدخل تاريخ صحيح
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doc 4: Civil Defense -->
                        <div class="doc-card" id="doc-card-cd" data-doc="cd">
                            <div class="doc-card-header">
                                <div class="doc-badge required" id="badge-cd">
                                    <i class="fas fa-fire-extinguisher"></i>
                                </div>
                                <div class="doc-info">
                                    <div class="doc-title">موافقة الدفاع المدني</div>
                                    <div class="doc-hint">شهادة الموافقة الصادرة من الدفاع المدني</div>
                                </div>
                                <span class="required-badge">إلزامي</span>
                            </div>
                            <div class="doc-body">
                                <div>
                                    <label class="form-label" style="font-size:.8rem; margin-bottom:6px;">رفع الملف</label>
                                    <div class="upload-zone" id="zone-cd" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event,'cd')">
                                        <input type="file" name="doc_civil_defense" id="file-cd"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFileSelect(this,'cd')">
                                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <div class="upload-text">اسحب الملف هنا أو اضغط للرفع</div>
                                        <div class="upload-subtext">PDF · JPG · PNG (حجم أقصى 5MB)</div>
                                    </div>
                                    <div class="file-status" id="file-status-cd"></div>
                                </div>
                                <div class="expiry-wrap">
                                    <div class="expiry-label-row">
                                        <label class="form-label" style="font-size:.8rem;">تاريخ الانتهاء <span class="required-star">*</span></label>
                                        <span class="expiry-tag" id="expiry-tag-cd"></span>
                                    </div>
                                    <input type="date" name="doc_cd_expiry" id="expiry-cd"
                                        class="form-control" style="font-size:.85rem;"
                                        onchange="checkExpiry('cd')" required>
                                    <div class="hint-msg">يجب أن يكون التاريخ في المستقبل</div>
                                    <div class="invalid-msg" id="expiry-error-cd" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> أدخل تاريخ صحيح
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doc 5: Work License (مأذون شرعي only) -->
                        <div class="doc-card" id="doc-card-wl" data-doc="wl" style="display:none;">
                            <div class="doc-card-header">
                                <div class="doc-badge required" id="badge-wl">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <div class="doc-info">
                                    <div class="doc-title">رخصة العمل</div>
                                    <div class="doc-hint">رخصة العمل الصادرة للمأذون الشرعي من الجهة المختصة</div>
                                </div>
                                <span class="required-badge">إلزامي</span>
                            </div>
                            <div class="doc-body">
                                <div>
                                    <label class="form-label" style="font-size:.8rem; margin-bottom:6px;">رفع الملف</label>
                                    <div class="upload-zone" id="zone-wl" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event,'wl')">
                                        <input type="file" name="doc_work_license" id="file-wl"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            onchange="handleFileSelect(this,'wl')">
                                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <div class="upload-text">اسحب الملف هنا أو اضغط للرفع</div>
                                        <div class="upload-subtext">PDF · JPG · PNG (حجم أقصى 5MB)</div>
                                    </div>
                                    <div class="file-status" id="file-status-wl"></div>
                                </div>
                                <div class="expiry-wrap">
                                    <div class="expiry-label-row">
                                        <label class="form-label" style="font-size:.8rem;">تاريخ الانتهاء <span class="required-star">*</span></label>
                                        <span class="expiry-tag" id="expiry-tag-wl"></span>
                                    </div>
                                    <input type="date" name="doc_wl_expiry" id="expiry-wl"
                                        class="form-control" style="font-size:.85rem;"
                                        onchange="checkExpiry('wl')">
                                    <div class="hint-msg">يجب أن يكون التاريخ في المستقبل</div>
                                    <div class="invalid-msg" id="expiry-error-wl" style="display:none">
                                        <i class="fas fa-exclamation-circle"></i> أدخل تاريخ صحيح
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Optional Docs -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon gold"><i class="fas fa-plus-circle"></i></div>
                        <div>
                            <div class="card-title">تراخيص إضافية</div>
                            <div class="card-subtitle">اختياري — يمكنك إضافة تراخيص أخرى حسب طبيعة نشاطك</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="extra-docs-container"></div>
                        <button type="button" class="btn-add-doc" onclick="addExtraDoc()">
                            <i class="fas fa-plus"></i> إضافة ترخيص آخر
                        </button>
                    </div>
                </div>

                <!-- Nav -->
                <div class="nav-btns">
                    <button type="button" class="btn btn-outline" onclick="goTo(2)">
                        <i class="fas fa-arrow-right"></i> السابق
                    </button>
                    <span class="step-counter">الخطوة <strong>3</strong> من 4</span>
                    <button type="button" class="btn btn-primary" onclick="goNext(3)">
                        التالي <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- ═══════════════════════════════════════════
                 STEP 4 — REVIEW & SUBMIT
            ═══════════════════════════════════════════ -->
            <div class="step-panel" id="step-4">

                <!-- Summary Review -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-clipboard-check"></i></div>
                        <div>
                            <div class="card-title">مراجعة البيانات</div>
                            <div class="card-subtitle">تأكد من صحة المعلومات قبل الإرسال</div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="review-section">
                            <div class="review-section-title">البيانات الشخصية</div>
                            <div class="review-grid">
                                <div class="review-item">
                                    <div class="review-item-label">الاسم الكامل</div>
                                    <div class="review-item-value" id="rv-name">—</div>
                                </div>
                                <div class="review-item">
                                    <div class="review-item-label">رقم الجوال</div>
                                    <div class="review-item-value" id="rv-phone">—</div>
                                </div>
                                <div class="review-item">
                                    <div class="review-item-label">البريد الإلكتروني</div>
                                    <div class="review-item-value" id="rv-email">—</div>
                                </div>
                            </div>
                        </div>

                        <div class="review-section">
                            <div class="review-section-title">بيانات المنشأة</div>
                            <div class="review-grid">
                                <div class="review-item">
                                    <div class="review-item-label">اسم المنشأة</div>
                                    <div class="review-item-value" id="rv-venue-name">—</div>
                                </div>
                                <div class="review-item">
                                    <div class="review-item-label">نوع النشاط</div>
                                    <div class="review-item-value" id="rv-venue-type">—</div>
                                </div>
                                <div class="review-item">
                                    <div class="review-item-label">المدينة</div>
                                    <div class="review-item-value" id="rv-city">—</div>
                                </div>
                                <div class="review-item">
                                    <div class="review-item-label">العنوان</div>
                                    <div class="review-item-value" id="rv-address">—</div>
                                </div>
                                <div class="review-item">
                                    <div class="review-item-label" id="rv-price-label">السعر الأولي</div>
                                    <div class="review-item-value" id="rv-price">—</div>
                                </div>
                            </div>
                        </div>

                        <div class="review-section">
                            <div class="review-section-title">التراخيص المرفوعة</div>
                            <div class="review-doc-list" id="rv-docs">
                                <div class="review-doc-item missing"><i class="fas fa-times-circle"></i> السجل التجاري — لم يُرفع</div>
                                <div class="review-doc-item missing"><i class="fas fa-times-circle"></i> الرخصة البلدية — لم يُرفع</div>
                                <div class="review-doc-item missing"><i class="fas fa-times-circle"></i> رخصة التشغيل — لم يُرفع</div>
                                <div class="review-doc-item missing"><i class="fas fa-times-circle"></i> موافقة الدفاع المدني — لم يُرفع</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Terms / Declaration -->
                <div class="terms-card">
                    <div class="terms-header">
                        <i class="fas fa-file-signature"></i>
                        <h3>إقرار وتعهد</h3>
                    </div>

                    <div class="declaration-body">
                        <p class="decl-opening">
                            أقرّ أنا/ <strong id="decl-name" class="decl-name-inline">—</strong>
                            الموقع أدناه، بأن جميع البيانات والمعلومات والمستندات التي تم إدخالها أو رفعها أو تزويد منصة أمر تم لخدمات الأعمال بها صحيحة ودقيقة وحديثة، وأتحمل/ نتحمل كامل المسؤولية النظامية والقانونية تجاه أي معلومات غير صحيحة أو مضللة أو مخالفة للأنظمة والتعليمات المعمول بها في المملكة العربية السعودية.
                        </p>

                        <p class="decl-sub-title">كما أتعهد بما يلي:</p>

                        <ol class="decl-list">
                            <li>صحة جميع البيانات الشخصية أو التجارية أو المهنية أو العقارية أو الوظيفية أو التسويقية المدخلة عبر المنصة.</li>
                            <li>أن جميع المستندات والتراخيص والسجلات المرفوعة سارية المفعول وتعود لي/ لنا أو للجهة التي أمثلها نظامًا.</li>
                            <li>تحديث البيانات بشكل فوري عند حدوث أي تعديل عليها.</li>
                            <li>عدم استخدام المنصة لأي أعمال مخالفة للأنظمة أو الآداب العامة أو حقوق الغير.</li>
                            <li>أتحمل كامل المسؤولية عن المحتوى أو الإعلانات أو الخدمات أو العروض التي يتم نشرها من خلال حسابي في المنصة.</li>
                            <li>أوافق على أن لإدارة المنصة الحق في إيقاف أو حذف أي حساب أو محتوى يثبت عدم صحة معلوماته أو مخالفته للأنظمة والسياسات المعتمدة.</li>
                        </ol>

                        <p class="decl-footer-note">
                            كما أقرّ بأن منصة أمر تم لخدمات الأعمال تُعد منصة إلكترونية وسيطة لتسهيل عرض الخدمات والبيانات وربط الأطراف، ولا تتحمل مسؤولية صحة المعلومات المقدمة من المستخدمين أو أي تعاملات تتم بينهم، وتبقى المسؤولية كاملة على مقدم البيانات أو الخدمة.
                        </p>

                        <p class="decl-closing">وعليه جرى الإقرار والتعهد.</p>

                        <div class="decl-signature">
                            <div class="sig-row">
                                <span class="sig-label">الاسم:</span>
                                <span class="sig-value" id="decl-sig-name">—</span>
                            </div>
                            <div class="sig-row">
                                <span class="sig-label">الصفة:</span>
                                <span class="sig-value" id="decl-sig-role">—</span>
                            </div>
                            <div class="sig-row">
                                <span class="sig-label">اسم المنشأة:</span>
                                <span class="sig-value" id="decl-sig-venue">—</span>
                            </div>
                        </div>
                    </div>

                    <label class="terms-agree" id="terms-agree-label" onclick="toggleTerms(this)">
                        <input type="checkbox" name="terms_agreed" id="terms_agreed" value="1">
                        <div class="terms-checkbox"></div>
                        <span class="terms-agree-text">أوافق على <a href="{{ route('privacy') }}" target="_blank" style="color:var(--green); font-weight:700; text-decoration:none;" onclick="event.stopPropagation()">سياسة الخصوصية وشروط الاستخدام</a> الخاصة بمنصة أمر تم وأتعهد بالالتزام بجميع المتطلبات المذكورة.</span>
                    </label>
                    <div class="invalid-msg" id="terms-error" style="display:none; margin-top:10px;">
                        <i class="fas fa-exclamation-circle"></i> يجب الموافقة على الشروط والأحكام
                    </div>
                </div>

                <!-- Nav -->
                <div class="nav-btns">
                    <button type="button" class="btn btn-outline" onclick="goTo(3)">
                        <i class="fas fa-arrow-right"></i> السابق
                    </button>
                    <span class="step-counter">الخطوة <strong>4</strong> من 4</span>
                    <button type="submit" class="btn btn-gold" id="submit-btn" onclick="return validateFinal()">
                        <i class="fas fa-paper-plane"></i> تقديم الطلب
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- Save Banner -->
    {{-- <div class="save-banner" id="saveBanner">
        <i class="fas fa-cloud-check"></i> تم حفظ البيانات تلقائياً
    </div> --}}

    <!-- Leaflet Map JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
    /* ════════════════════════════════════════════════
       STATE
    ════════════════════════════════════════════════ */
    let currentStep = 1;
    const totalSteps = 4;

    const uploadedFiles = { cr: null, ml: null, ol: null, cd: null, wl: null };
    const docLabels = {
        cr: 'السجل التجاري',
        ml: 'الرخصة البلدية',
        ol: 'رخصة التشغيل',
        cd: 'موافقة الدفاع المدني',
        wl: 'رخصة العمل'
    };
    const venueTypeLabels = {
        wedding_hall: 'قاعة أفراح',
        retreat: 'استراحة',
        chalet: 'شاليه'
    };

    let extraDocCount = 0;
    let mapInstance = null;
    let mapMarker = null;
    let saveTimer = null;

    /* ════════════════════════════════════════════════
       MAP INIT
    ════════════════════════════════════════════════ */
    function initMap() {
        if (mapInstance) return;
        mapInstance = L.map('map', { zoomControl: true }).setView([24.7136, 46.6753], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap',
            maxZoom: 19
        }).addTo(mapInstance);

        mapInstance.on('click', function(e) {
            placeMarker(e.latlng.lat, e.latlng.lng);
        });

        // Restore saved coords
        const savedLat = localStorage.getItem('reg_latitude');
        const savedLng = localStorage.getItem('reg_longitude');
        if (savedLat && savedLng) {
            placeMarker(parseFloat(savedLat), parseFloat(savedLng));
            mapInstance.setView([parseFloat(savedLat), parseFloat(savedLng)], 14);
        }
    }

    function placeMarker(lat, lng) {
        if (mapMarker) mapInstance.removeLayer(mapMarker);
        mapMarker = L.marker([lat, lng], { draggable: true }).addTo(mapInstance);
        mapMarker.on('dragend', function(e) {
            const pos = e.target.getLatLng();
            setCoords(pos.lat, pos.lng);
        });
        setCoords(lat, lng);
    }

    function setCoords(lat, lng) {
        document.getElementById('latitude').value  = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
        reverseGeocode(lat, lng);
        scheduleSave();
    }

    function reverseGeocode(lat, lng) {
        fetch('https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lng + '&format=json&accept-language=ar')
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var a = data.address || {};
                var countryEl = document.getElementById('country');
                var cityEl    = document.getElementById('city');
                var streetEl  = document.getElementById('street');
                var noteEl    = document.getElementById('map-autofill-note');

                if (countryEl && a.country) {
                    countryEl.value = a.country;
                    countryEl.classList.add('map-filled');
                }
                if (cityEl) {
                    var cityVal = a.city || a.town || a.village || a.state_district || a.county || a.state || '';
                    if (cityVal) { cityEl.value = cityVal; cityEl.classList.add('map-filled'); }
                }
                if (streetEl && a.road) {
                    streetEl.value = a.road;
                    streetEl.classList.add('map-filled');
                }
                if (noteEl && (a.country || a.city || a.road)) noteEl.style.display = 'flex';
                scheduleSave();
            })
            .catch(function() {});
    }

    // Map search (simple geocoding via Nominatim)
    document.addEventListener('DOMContentLoaded', function() {
        initMap();

        document.getElementById('map-search').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); searchMap(this.value); }
        });

        // Bind description character counter
        const descArea = document.getElementById('description');
        if (descArea) {
            descArea.addEventListener('input', function() {
                const counter = document.getElementById('desc-count');
                if (counter) counter.textContent = this.value.length;
                scheduleSave();
            });
        }

        // Auto-save on text field changes
        document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea, select').forEach(function(el) {
            el.addEventListener('input', scheduleSave);
            el.addEventListener('change', scheduleSave);
        });

        // Restore saved data
        restoreFromStorage();

        // Venue type radio sync (only for venue-type card, not account-type)
        document.querySelectorAll('#venue-type-card .venue-type-radio').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var parentGroup = this.closest('.venue-types');
                parentGroup.querySelectorAll('.venue-type-btn').forEach(function(btn) { btn.classList.remove('selected'); });
                this.closest('.venue-type-btn').classList.add('selected');
            });
        });

        // Entity type radio sync + officiant toggle
        document.querySelectorAll('.entity-type-radio').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === 'officiant') {
                    window.location.href = '{{ route('register.officiant') }}';
                    return;
                }
                document.querySelectorAll('.entity-type-btn').forEach(function(btn) { btn.classList.remove('selected'); });
                this.closest('.entity-type-btn').classList.add('selected');

                var checkedUI = document.querySelector('input[name="_account_type_ui"]:checked');
                applyAccountType(checkedUI ? checkedUI.value : 'hall');
            });
        });

        // Account type handler
        function applyAccountType(value) {
            var isService   = value === 'service';
            var isOfficiant = value === 'officiant';
            var isHall      = value === 'hall';

            // Update the hidden account_type input that gets submitted
            var resolved = document.getElementById('account_type_resolved');
            if (resolved) resolved.value = value;

            document.querySelectorAll('.account-type-btn').forEach(function(btn) {
                var r = btn.querySelector('.account-type-radio');
                if (r) btn.classList.toggle('selected', r.value === value);
            });

            var venueTypeCard     = document.getElementById('venue-type-card');
            var wlCard            = document.getElementById('doc-card-wl');
            var priceHallGroup    = document.getElementById('price-hall-group');
            var priceServiceGroup = document.getElementById('price-service-group');
            var basePriceLabel    = document.getElementById('base-price-label');
            var categoryGroup     = document.getElementById('category-service-group');

            if (venueTypeCard)     venueTypeCard.style.display     = isHall ? 'block' : 'none';
            if (priceHallGroup)    priceHallGroup.style.display    = isHall ? 'block' : 'none';
            if (priceServiceGroup) priceServiceGroup.style.display = isHall ? 'none' : 'block';
            if (basePriceLabel)    basePriceLabel.textContent      = isOfficiant ? 'السعر الأولي لخدمة التأذين' : 'السعر الأولي للخدمة';
            if (wlCard)            wlCard.style.display            = isOfficiant ? 'block' : 'none';
            if (categoryGroup)     categoryGroup.style.display     = (isService || isOfficiant) ? 'block' : 'none';

            // Officiant extra fields card
            var officiantFieldsCard = document.getElementById('officiant-fields-card');
            if (officiantFieldsCard) officiantFieldsCard.style.display = isOfficiant ? 'block' : 'none';

            // الاسم: ثلاثة حقول للقاعة/الخدمة — حقل واحد للمأذون
            var repNameGrid        = document.getElementById('rep-name-grid');
            var officiantNameRow   = document.getElementById('officiant-name-row');
            var repFirstInp        = document.getElementById('rep_first_name');
            var repFatherInp       = document.getElementById('rep_father_name');
            var repGrandfatherInp  = document.getElementById('rep_grandfather_name');
            var officiantNameInp   = document.getElementById('officiant_full_name');
            if (isOfficiant) {
                if (repNameGrid)       repNameGrid.style.display      = 'none';
                if (officiantNameRow)  officiantNameRow.style.display = 'block';
                if (repFirstInp)       repFirstInp.disabled           = true;
                if (repFatherInp)      repFatherInp.disabled          = true;
                if (repGrandfatherInp) repGrandfatherInp.disabled     = true;
                if (officiantNameInp)  officiantNameInp.disabled      = false;
            } else {
                if (repNameGrid)       repNameGrid.style.display      = '';
                if (officiantNameRow)  officiantNameRow.style.display = 'none';
                if (repFirstInp)       repFirstInp.disabled           = false;
                if (repFatherInp)      repFatherInp.disabled          = false;
                if (repGrandfatherInp) repGrandfatherInp.disabled     = false;
                if (officiantNameInp)  officiantNameInp.disabled      = true;
            }

            // بيانات التسجيل — تعديل حسب نوع الحساب
            var regTitle       = document.getElementById('reg-data-title');
            var regSubtitle    = document.getElementById('reg-data-subtitle');
            var regRow1        = document.getElementById('reg-row-1');
            var regNumGroup    = document.getElementById('reg-number-group');
            var unifiedGroup   = document.getElementById('unified-number-group');
            var venuNameTxt    = document.getElementById('venue-name-label-text');
            var venueEmailTxt  = document.getElementById('venue-email-label-text');

            // إظهار/إخفاء كارد بيانات المنشأة + حقول المرور
            var venueDetailsCard = document.getElementById('venue-details-card');
            var mainPassInput    = document.getElementById('password');
            var mainConfInput    = document.getElementById('password_confirmation');
            var officiantPassRow = document.getElementById('officiant-password-row');
            var officiantPassInp = document.getElementById('officiant_password_input');
            var officiantConfInp = document.getElementById('officiant_confirm_input');

            if (isOfficiant) {
                if (regTitle)        regTitle.textContent    = 'بيانات المأذون الشرعي';
                if (regSubtitle)     regSubtitle.textContent = 'المعلومات التعريفية الخاصة بك';
                if (regRow1)         regRow1.style.gridTemplateColumns = '1fr';
                if (regNumGroup)     regNumGroup.style.display  = 'none';
                if (unifiedGroup)    unifiedGroup.style.display = 'none';
                if (venuNameTxt)     venuNameTxt.textContent   = 'اسم المأذون الشرعي (حسب الاسم المسجل في الرخصة)';
                if (venueEmailTxt)   venueEmailTxt.textContent = 'البريد الإلكتروني';
                if (venueDetailsCard) venueDetailsCard.style.display = 'none';
                if (mainPassInput)   mainPassInput.disabled   = true;
                if (mainConfInput)   mainConfInput.disabled   = true;
                if (officiantPassRow) officiantPassRow.style.display = 'block';
                if (officiantPassInp) officiantPassInp.disabled = false;
                if (officiantConfInp) officiantConfInp.disabled = false;
            } else {
                if (regTitle)        regTitle.textContent    = 'بيانات التسجيل';
                if (regSubtitle)     regSubtitle.textContent = 'معلومات تعريفية للمنشأة';
                if (regRow1)         regRow1.style.gridTemplateColumns = '1fr 1fr 1fr';
                if (regNumGroup)     regNumGroup.style.display  = '';
                if (unifiedGroup)    unifiedGroup.style.display = '';
                if (venuNameTxt)     venuNameTxt.textContent   = isHall ? 'اسم المنشأة' : 'اسم الخدمة / مزود الخدمة';
                if (venueEmailTxt)   venueEmailTxt.textContent = 'بريد المؤسسة الإلكتروني';
                if (venueDetailsCard) venueDetailsCard.style.display = 'block';
                if (mainPassInput)   mainPassInput.disabled   = false;
                if (mainConfInput)   mainConfInput.disabled   = false;
                if (officiantPassRow) officiantPassRow.style.display = 'none';
                if (officiantPassInp) officiantPassInp.disabled = true;
                if (officiantConfInp) officiantConfInp.disabled = true;
            }

            // Show/hide license docs based on account type
            var docCr = document.getElementById('doc-card-cr');
            var docMl = document.getElementById('doc-card-ml');
            var docOl = document.getElementById('doc-card-ol');
            var docCd = document.getElementById('doc-card-cd');
            var mandatoryNoticeP = document.querySelector('#step-3 .mandatory-notice p');
            if (isOfficiant) {
                if (docCr) docCr.style.display = 'none';
                if (docMl) docMl.style.display = 'none';
                if (docOl) docOl.style.display = 'none';
                if (docCd) docCd.style.display = 'none';
                if (mandatoryNoticeP) mandatoryNoticeP.textContent = 'يُشترط رفع صورة رخصة العمل الصادرة للمأذون الشرعي (سارية المفعول وواضحة) حتى يتم قبول طلبك على منصة أمر تم. الملفات المقبولة: PDF، JPG، PNG.';
            } else {
                if (docCr) docCr.style.display = '';
                if (docMl) docMl.style.display = '';
                if (docOl) docOl.style.display = '';
                if (docCd) docCd.style.display = '';
                if (mandatoryNoticeP) mandatoryNoticeP.textContent = 'يُشترط رفع جميع التراخيص الأربعة ادناه (سارية المفعول وواضحة) حتى يتم قبول طلبك على منصة أمر تم. الملفات المقبولة: PDF، JPG، PNG.';
            }
        }

        // Use click on the UI account-type radios
        document.querySelectorAll('input[name="_account_type_ui"]').forEach(function(radio) {
            radio.addEventListener('click', function() {
                applyAccountType(this.value);
            });
        });

        // Apply initial state on load
        var checkedAccountUI = document.querySelector('input[name="_account_type_ui"]:checked');
        applyAccountType(checkedAccountUI ? checkedAccountUI.value : 'hall');

        // For officiant: sync visible contact fields into the hidden phone/email inputs before submission
        var regForm = document.getElementById('ownerRegisterForm');
        if (regForm) {
            regForm.addEventListener('submit', function() {
                if (document.getElementById('account_type_resolved')?.value === 'officiant') {
                    var userPhone  = document.getElementById('user_phone')?.value  || '';
                    var venueEmail = document.getElementById('venue_email')?.value || '';
                    var venueName  = document.getElementById('venue_name')?.value  || '';
                    var phoneInput = document.getElementById('phone');
                    var emailInput = document.getElementById('email');
                    var officiantNameInput = document.getElementById('officiant_full_name');
                    if (phoneInput) phoneInput.value  = userPhone;
                    if (emailInput) emailInput.value  = venueEmail;
                    if (officiantNameInput) officiantNameInput.value = venueName;
                }
            });
        }
    });

    function searchMap(query) {
        if (!query.trim()) return;
        fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query + ', Saudi Arabia')}&format=json&limit=1`)
            .then(r => r.json())
            .then(function(results) {
                if (results.length > 0) {
                    const lat = parseFloat(results[0].lat);
                    const lng = parseFloat(results[0].lon);
                    mapInstance.setView([lat, lng], 15);
                    placeMarker(lat, lng);
                    if (!document.getElementById('address').value) {
                        document.getElementById('address').value = results[0].display_name.split(',').slice(0,3).join(',');
                    }
                }
            })
            .catch(() => {});
    }

    /* ════════════════════════════════════════════════
       STEP NAVIGATION
    ════════════════════════════════════════════════ */
    function goTo(step) {
        document.getElementById('step-' + currentStep).classList.remove('visible');
        currentStep = step;
        document.getElementById('step-' + currentStep).classList.add('visible');
        updateProgress();
        window.scrollTo({ top: 0, behavior: 'smooth' });

        if (step === 4) buildReview();
        if (step === 2) setTimeout(function() { if (mapInstance) mapInstance.invalidateSize(); }, 300);
    }

    function goNext(fromStep) {
        if (!validateStep(fromStep)) return;
        markStepCompleted(fromStep);
        goTo(fromStep + 1);
    }

    function updateProgress() {
        const pct = (currentStep / totalSteps) * 100;
        document.getElementById('progressFill').style.width = pct + '%';

        document.querySelectorAll('.step-item').forEach(function(item) {
            const s = parseInt(item.dataset.step);
            item.classList.remove('active', 'completed');
            if (s === currentStep) item.classList.add('active');
            else if (s < currentStep) item.classList.add('completed');
        });

        // Toggle check icons in bubbles
        document.querySelectorAll('.step-item').forEach(function(item) {
            const bubble = item.querySelector('.step-bubble');
            const icon = bubble.querySelector('i');
            const num  = bubble.querySelector('span');
            if (item.classList.contains('completed')) {
                icon.style.display = '';
                num.style.display  = 'none';
            } else {
                icon.style.display = 'none';
                num.style.display  = '';
            }
        });
    }

    function markStepCompleted(step) {
        const item = document.querySelector('.step-item[data-step="' + step + '"]');
        if (item) item.classList.add('completed');
    }

    /* ════════════════════════════════════════════════
       VALIDATION PER STEP
    ════════════════════════════════════════════════ */
    function validateStep(step) {
        clearErrors();
        let valid = true;

        if (step === 1) {
            const isOfficiantV = document.getElementById('account_type_resolved')?.value === 'officiant';
            if (isOfficiantV) {
                const officiantName = document.getElementById('venue_name')?.value.trim() || '';
                if (!officiantName) { showError('venue-name-error', 'venue_name'); valid = false; }
                const licNum = document.getElementById('officiant_license_number')?.value.trim() || '';
                const hours  = document.getElementById('officiant_working_hours')?.value.trim() || '';
                if (!licNum) { showError('officiant-license-error', 'officiant_license_number'); valid = false; }
                if (!hours)  { showError('officiant-hours-error',   'officiant_working_hours');  valid = false; }
            } else {
                const firstName       = document.getElementById('rep_first_name')?.value.trim() || '';
                const fatherName      = document.getElementById('rep_father_name')?.value.trim() || '';
                const grandfatherName = document.getElementById('rep_grandfather_name')?.value.trim() || '';
                if (!firstName)       { showError('rep-first-name-error', 'rep_first_name'); valid = false; }
                if (!fatherName)      { showError('rep-father-name-error', 'rep_father_name'); valid = false; }
                if (!grandfatherName) { showError('rep-grandfather-name-error', 'rep_grandfather_name'); valid = false; }
            }
            if (isOfficiantV) {
                const phone = document.getElementById('user_phone')?.value.trim() || '';
                const email = document.getElementById('venue_email')?.value.trim() || '';
                if (!phone) { showError('user-phone-error', 'user_phone'); valid = false; }
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showError('venue-email-error', 'venue_email'); valid = false; }
            } else {
                const phone = document.getElementById('phone').value.trim();
                const email = document.getElementById('email').value.trim();
                if (!phone || !/^[0-9]{9}$/.test(phone)) { showError('phone-error', 'phone'); valid = false; }
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showError('email-error', 'email'); valid = false; }
            }
            const passEl = isOfficiantV ? document.getElementById('officiant_password_input') : document.getElementById('password');
            const confEl = isOfficiantV ? document.getElementById('officiant_confirm_input')  : document.getElementById('password_confirmation');
            const passVal = passEl?.value || '';
            const confVal = confEl?.value || '';
            const passErrId  = isOfficiantV ? 'officiant-password-error' : 'password-error';
            const confErrId  = isOfficiantV ? 'officiant-confirm-error'  : 'confirm-error';
            const passFieldId = isOfficiantV ? 'officiant_password_input' : 'password';
            const confFieldId = isOfficiantV ? 'officiant_confirm_input'  : 'password_confirmation';
            if (!passVal || passVal.length < 8) { showError(passErrId, passFieldId); valid = false; }
            if (passVal !== confVal) { showError(confErrId, confFieldId); valid = false; }
        }

        if (step === 2) {
            const venueName   = document.getElementById('venue_name')?.value.trim() || '';
            const desc        = document.getElementById('description')?.value.trim() || '';
            const address     = document.getElementById('address')?.value.trim() || '';
            const city        = document.getElementById('city')?.value.trim() || '';
            const accountType = document.getElementById('account_type_resolved')?.value || 'hall';

            if (!venueName) { showError('venue-name-error', 'venue_name'); valid = false; }
            if (!address)   { showError('address-error', 'address'); valid = false; }
            if (!city)      { showError('city-error', 'city'); valid = false; }
        }

        if (step === 3) {
            const accountTypeEl = document.getElementById('account_type_resolved');
            const isOfficiantVal = accountTypeEl && accountTypeEl.value === 'officiant';
            const requiredDocs = isOfficiantVal ? ['wl'] : ['cr', 'ml', 'ol', 'cd'];
            requiredDocs.forEach(function(doc) {
                if (!uploadedFiles[doc]) {
                    document.getElementById('doc-card-' + doc).classList.add('error');
                    document.getElementById('file-status-' + doc).innerHTML =
                        '<span class="file-status error"><i class="fas fa-exclamation-circle"></i> الملف مطلوب</span>';
                    valid = false;
                }
                const expiry = document.getElementById('expiry-' + doc).value;
                if (!expiry) {
                    showError('expiry-error-' + doc, 'expiry-' + doc);
                    valid = false;
                } else if (new Date(expiry) <= new Date()) {
                    document.getElementById('expiry-error-' + doc).innerHTML =
                        '<i class="fas fa-exclamation-circle"></i> الترخيص منتهي الصلاحية — الرجاء استيفاء ترخيص ساري';
                    document.getElementById('expiry-error-' + doc).style.display = 'flex';
                    document.getElementById('expiry-' + doc).classList.add('is-invalid');
                    valid = false;
                }
            });
            if (!valid) {
                window.scrollTo({ top: document.querySelector('#step-3').offsetTop - 80, behavior: 'smooth' });
            }
        }

        if (!valid) {
            // Scroll to first error
            const firstError = document.querySelector('.is-invalid, .error');
            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        return valid;
    }

    function validateFinal() {
        const agreed = document.getElementById('terms_agreed').checked;
        if (!agreed) {
            document.getElementById('terms-error').style.display = 'flex';
            document.getElementById('terms-agree-label').style.borderColor = 'var(--red)';
            return false;
        }
        return true;
    }

    function showError(errorId, fieldId) {
        const errEl = document.getElementById(errorId);
        if (errEl) errEl.style.display = 'flex';
        const field = document.getElementById(fieldId);
        if (field) field.classList.add('is-invalid');
    }

    function clearErrors() {
        document.querySelectorAll('.invalid-msg').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.doc-card.error').forEach(el => el.classList.remove('error'));
    }

    /* ════════════════════════════════════════════════
       VENUE TYPE TOGGLE
    ════════════════════════════════════════════════ */
    function toggleCheck(label) {
        const isChecked = label.querySelector('input').checked;
        label.classList.toggle('checked', isChecked);
    }

    /* ════════════════════════════════════════════════
       FILE UPLOAD
    ════════════════════════════════════════════════ */
    function handleFileSelect(input, docKey) {
        if (!input.files || !input.files[0]) return;
        processFile(input.files[0], docKey);
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.currentTarget.classList.add('drag-over');
    }

    function handleDragLeave(e) {
        e.currentTarget.classList.remove('drag-over');
    }

    function handleDrop(e, docKey) {
        e.preventDefault();
        e.currentTarget.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (file) processFile(file, docKey);
    }

    function processFile(file, docKey) {
        const maxSize = 5 * 1024 * 1024;
        const allowed = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
        const zone    = document.getElementById('zone-' + docKey);
        const status  = document.getElementById('file-status-' + docKey);
        const badge   = document.getElementById('badge-' + docKey);
        const card    = document.getElementById('doc-card-' + docKey);

        if (!allowed.includes(file.type)) {
            status.innerHTML = '<span class="file-status error"><i class="fas fa-times-circle"></i> نوع الملف غير مدعوم (PDF، JPG، PNG فقط)</span>';
            return;
        }

        if (file.size > maxSize) {
            status.innerHTML = '<span class="file-status error"><i class="fas fa-times-circle"></i> حجم الملف يتجاوز 5MB</span>';
            return;
        }

        uploadedFiles[docKey] = file;
        const sizeMB = (file.size / 1024 / 1024).toFixed(2);

        zone.classList.add('has-file');
        zone.querySelector('.upload-icon i').className = 'fas fa-file-check';
        zone.querySelector('.upload-text').textContent  = file.name;
        zone.querySelector('.upload-subtext').textContent = `${sizeMB} MB — ${file.type.split('/')[1].toUpperCase()}`;

        status.innerHTML = '<span class="file-status success"><i class="fas fa-check-circle"></i> تم رفع الملف بنجاح</span>';
        badge.className  = 'doc-badge uploaded';
        badge.innerHTML  = '<i class="fas fa-check"></i>';
        card.classList.remove('error');
        card.classList.add('uploaded');
    }

    /* ════════════════════════════════════════════════
       EXPIRY DATE CHECK
    ════════════════════════════════════════════════ */
    function checkExpiry(docKey) {
        const input   = document.getElementById('expiry-' + docKey);
        const tagEl   = document.getElementById('expiry-tag-' + docKey);
        const errEl   = document.getElementById('expiry-error-' + docKey);
        if (!input.value) return;

        const expiry = new Date(input.value);
        const now    = new Date();
        const diff   = (expiry - now) / (1000 * 60 * 60 * 24);

        input.classList.remove('is-invalid');
        errEl.style.display = 'none';

        if (diff < 0) {
            tagEl.textContent = 'منتهي الصلاحية';
            tagEl.className   = 'expiry-tag expired';
            errEl.innerHTML   = '<i class="fas fa-exclamation-circle"></i> الترخيص منتهي الصلاحية';
            errEl.style.display = 'flex';
            input.classList.add('is-invalid');
        } else if (diff < 90) {
            tagEl.textContent = 'ينتهي قريباً';
            tagEl.className   = 'expiry-tag soon';
        } else {
            tagEl.textContent = 'ساري';
            tagEl.className   = 'expiry-tag valid';
        }
    }

    /* ════════════════════════════════════════════════
       EXTRA DOCS
    ════════════════════════════════════════════════ */
    function addExtraDoc() {
        extraDocCount++;
        const idx = extraDocCount;
        const container = document.getElementById('extra-docs-container');

        const docHtml = `
        <div class="doc-card" id="extra-doc-${idx}" style="position:relative;">
            <button type="button" class="btn-remove-doc" onclick="removeExtraDoc(${idx})">
                <i class="fas fa-times"></i>
            </button>
            <div class="doc-card-header" style="margin-bottom:12px;">
                <div class="doc-badge optional"><i class="fas fa-file-plus"></i></div>
                <div class="doc-info">
                    <input type="text" name="extra_doc_name_${idx}" class="form-control"
                        placeholder="اسم الترخيص الإضافي..." style="font-size:.88rem;">
                </div>
                <span class="optional-badge">اختياري</span>
            </div>
            <div class="doc-body">
                <div>
                    <label class="form-label" style="font-size:.8rem; margin-bottom:6px;">رفع الملف</label>
                    <div class="upload-zone" id="zone-extra-${idx}"
                        ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)"
                        ondrop="handleDropExtra(event,${idx})">
                        <input type="file" name="extra_doc_file_${idx}"
                            accept=".pdf,.jpg,.jpeg,.png"
                            onchange="handleExtraFile(this,${idx})">
                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="upload-text">اسحب الملف هنا أو اضغط للرفع</div>
                        <div class="upload-subtext">PDF · JPG · PNG (حجم أقصى 5MB)</div>
                    </div>
                    <div class="file-status" id="file-status-extra-${idx}"></div>
                </div>
                <div class="expiry-wrap">
                    <label class="form-label" style="font-size:.8rem;">تاريخ الانتهاء</label>
                    <input type="date" name="extra_doc_expiry_${idx}" class="form-control" style="font-size:.85rem;">
                </div>
            </div>
        </div>`;

        container.insertAdjacentHTML('beforeend', docHtml);
    }

    function removeExtraDoc(idx) {
        const el = document.getElementById('extra-doc-' + idx);
        if (el) el.remove();
    }

    function handleExtraFile(input, idx) {
        if (!input.files || !input.files[0]) return;
        const file  = input.files[0];
        const zone  = document.getElementById('zone-extra-' + idx);
        const status = document.getElementById('file-status-extra-' + idx);
        const allowed = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];

        if (!allowed.includes(file.type) || file.size > 5 * 1024 * 1024) {
            status.innerHTML = '<span class="file-status error"><i class="fas fa-times-circle"></i> ملف غير صالح</span>';
            return;
        }

        zone.classList.add('has-file');
        zone.querySelector('.upload-text').textContent = file.name;
        zone.querySelector('.upload-subtext').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        status.innerHTML = '<span class="file-status success"><i class="fas fa-check-circle"></i> تم الرفع</span>';
    }

    function handleDropExtra(e, idx) {
        e.preventDefault();
        e.currentTarget.classList.remove('drag-over');
        if (e.dataTransfer.files[0]) handleExtraFile({ files: e.dataTransfer.files }, idx);
    }

    /* ════════════════════════════════════════════════
       PASSWORD STRENGTH
    ════════════════════════════════════════════════ */
    function checkPasswordStrength(val) {
        const fill = document.getElementById('strengthFillOfficiant') || document.getElementById('strengthFill');
        const text = document.getElementById('strengthTextOfficiant') || document.getElementById('strengthText');
        let score = 0;
        if (val.length >= 8)  score++;
        if (val.length >= 12) score++;
        if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { pct: '0%',   color: 'transparent',   label: 'أدخل كلمة مرور (8 أحرف على الأقل)' },
            { pct: '25%',  color: '#dc3545',        label: 'ضعيفة جداً' },
            { pct: '50%',  color: '#e67e22',        label: 'ضعيفة' },
            { pct: '65%',  color: '#f0ad4e',        label: 'مقبولة' },
            { pct: '82%',  color: '#52b788',        label: 'جيدة' },
            { pct: '100%', color: 'var(--green)',   label: 'قوية جداً ✓' },
        ];

        const lvl = levels[score] || levels[0];
        fill.style.width      = lvl.pct;
        fill.style.background = lvl.color;
        text.textContent      = lvl.label;
        text.style.color      = lvl.color === 'transparent' ? 'var(--text-muted)' : lvl.color;
    }

    /* ════════════════════════════════════════════════
       TOGGLE PASSWORD VISIBILITY
    ════════════════════════════════════════════════ */
    function togglePass(id, btn) {
        const input = document.getElementById(id);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    /* ════════════════════════════════════════════════
       TERMS TOGGLE
    ════════════════════════════════════════════════ */
    function toggleTerms(label) {
        const cb = label.querySelector('input[type="checkbox"]');
        // The click event will naturally toggle the checkbox, but since we use onclick
        // on the label with a hidden input, we need to manually sync
        setTimeout(function() {
            label.classList.toggle('checked', cb.checked);
            document.getElementById('terms-error').style.display = 'none';
            label.style.borderColor = cb.checked ? 'var(--green)' : 'var(--border)';
        }, 0);
    }

    /* ════════════════════════════════════════════════
       REVIEW BUILDER
    ════════════════════════════════════════════════ */
    function buildReview() {
        const selectedAccountTypeRv = document.getElementById('account_type_resolved')?.value || 'hall';
        let fullName;
        if (selectedAccountTypeRv === 'officiant') {
            fullName = document.getElementById('officiant_full_name')?.value.trim() || '—';
        } else {
            const firstName       = document.getElementById('rep_first_name')?.value.trim() || '';
            const fatherName      = document.getElementById('rep_father_name')?.value.trim() || '';
            const grandfatherName = document.getElementById('rep_grandfather_name')?.value.trim() || '';
            fullName = [firstName, fatherName, grandfatherName].filter(Boolean).join(' ') || '—';
        }
        document.getElementById('rv-name').textContent    = fullName;
        document.getElementById('rv-phone').textContent   = '+966 ' + (document.getElementById('phone').value || '—');
        document.getElementById('rv-email').textContent   = document.getElementById('email').value || '—';
        document.getElementById('rv-venue-name').textContent = document.getElementById('venue_name').value || '—';

        // Declaration auto-fill
        const accountTypeLabels = { hall: 'مالك قاعة', service: 'مقدم خدمة احتفالات', officiant: 'مأذون شرعي' };
        const selectedAccountType = document.getElementById('account_type_resolved')?.value || 'hall';
        const declVenueName = document.getElementById('venue_name').value || '—';
        const declRole = accountTypeLabels[selectedAccountType] || '—';
        const declNameEl = document.getElementById('decl-name');
        if (declNameEl) declNameEl.textContent = fullName;
        const declSigName = document.getElementById('decl-sig-name');
        if (declSigName) declSigName.textContent = fullName;
        const declSigRole = document.getElementById('decl-sig-role');
        if (declSigRole) declSigRole.textContent = declRole;
        const declSigVenue = document.getElementById('decl-sig-venue');
        if (declSigVenue) declSigVenue.textContent = declVenueName;
        document.getElementById('rv-address').textContent = document.getElementById('address').value || '—';

        document.getElementById('rv-city').textContent = document.getElementById('city')?.value || '—';

        const typeEl = document.querySelector('#venue-type-card .venue-type-radio:checked');
        document.getElementById('rv-venue-type').textContent = typeEl ? venueTypeLabels[typeEl.value] : '—';

        // Price review
        const rvAccountType = document.getElementById('account_type_resolved')?.value || 'hall';
        const rvPriceLabel  = document.getElementById('rv-price-label');
        const rvPrice       = document.getElementById('rv-price');
        if (rvAccountType === 'hall') {
            const p = document.getElementById('price_per_day').value;
            if (rvPriceLabel) rvPriceLabel.textContent = 'السعر الأولي لليوم';
            if (rvPrice) rvPrice.textContent = p ? p + ' ريال / يوم' : '—';
        } else {
            const p = document.getElementById('base_price').value;
            if (rvPriceLabel) rvPriceLabel.textContent = rvAccountType === 'officiant' ? 'السعر الأولي للتأذين' : 'السعر الأولي للخدمة';
            if (rvPrice) rvPrice.textContent = p ? p + ' ريال' : '—';
        }

        // Docs review
        const docsContainer = document.getElementById('rv-docs');
        docsContainer.innerHTML = '';
        const accountTypeReview = document.getElementById('account_type_resolved')?.value || 'hall';
        const docList = accountTypeReview === 'officiant'
            ? [{ key: 'wl', label: 'رخصة العمل' }]
            : [
                { key: 'cr', label: 'السجل التجاري' },
                { key: 'ml', label: 'الرخصة البلدية' },
                { key: 'ol', label: 'رخصة التشغيل' },
                { key: 'cd', label: 'موافقة الدفاع المدني' },
            ];

        docList.forEach(function(d) {
            const uploaded = !!uploadedFiles[d.key];
            const expiry   = document.getElementById('expiry-' + d.key).value;
            const expiryFmt = expiry ? new Date(expiry).toLocaleDateString('ar-SA') : '';
            const div = document.createElement('div');
            div.className = 'review-doc-item' + (uploaded ? '' : ' missing');
            div.innerHTML = uploaded
                ? `<i class="fas fa-check-circle"></i> ${d.label} — ${uploadedFiles[d.key].name} ${expiryFmt ? '(ينتهي: ' + expiryFmt + ')' : ''}`
                : `<i class="fas fa-times-circle"></i> ${d.label} — لم يُرفع بعد`;
            docsContainer.appendChild(div);
        });
    }

    /* ════════════════════════════════════════════════
       AUTO-SAVE (localStorage)
    ════════════════════════════════════════════════ */
    function scheduleSave() {
        clearTimeout(saveTimer);
        saveTimer = setTimeout(saveToStorage, 1200);
    }

    function saveToStorage() {
        const fields = ['name','phone','email','venue_name','description','address','country','city','street','building_number','floor','office_number','latitude','longitude','price_per_day','base_price'];
        fields.forEach(function(f) {
            const el = document.getElementById(f);
            if (el) localStorage.setItem('reg_' + f, el.value);
        });
        const typeEl = document.querySelector('#venue-type-card .venue-type-radio:checked');
        if (typeEl) localStorage.setItem('reg_venue_type', typeEl.value);

        showSaveBanner();
    }

    function restoreFromStorage() {
        const fields = ['name','phone','email','venue_name','description','address','country','city','street','building_number','floor','office_number','latitude','longitude','price_per_day','base_price'];
        fields.forEach(function(f) {
            const val = localStorage.getItem('reg_' + f);
            const el  = document.getElementById(f);
            if (val && el) {
                el.value = val;
                if (f === 'description') {
                    document.getElementById('desc-count').textContent = val.length;
                }
            }
        });

        const savedType = localStorage.getItem('reg_venue_type');
        if (savedType) {
            const radio = document.querySelector(`#venue-type-card .venue-type-radio[value="${savedType}"]`);
            if (radio) {
                radio.checked = true;
                document.querySelectorAll('#venue-type-card .venue-type-btn').forEach(btn => btn.classList.remove('selected'));
                radio.closest('.venue-type-btn').classList.add('selected');
            }
        }
    }

    function showSaveBanner() {
        const banner = document.getElementById('saveBanner');
        if (!banner) return;
        banner.classList.add('show');
        setTimeout(() => banner.classList.remove('show'), 2500);
    }

    /* ════════════════════════════════════════════════
       AVAILABILITY CALENDAR
    ════════════════════════════════════════════════ */
    (function availCal() {
        const MONTHS = ['يناير','فبراير','مارس','أبريل','مايو','يونيو',
                        'يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
        // RTL grid order: Sat Sun Mon Tue Wed Thu Fri
        const DAYS   = ['السبت','الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'];

        const today = new Date(); today.setHours(0,0,0,0);
        let vYear = today.getFullYear(), vMonth = today.getMonth();
        let selected = null;

        const hiddenInput = document.getElementById('available_from');
        const grid        = document.getElementById('avail-grid');
        const monthLabel  = document.getElementById('avail-month-label');
        const resultBox   = document.getElementById('avail-result');
        const resultDate  = document.getElementById('avail-result-date');
        const blockedNote = document.getElementById('avail-blocked-note');

        if (hiddenInput && hiddenInput.value) {
            selected = new Date(hiddenInput.value);
            selected.setHours(0,0,0,0);
        }

        function fmtAr(d) {
            return d.getDate() + ' ' + MONTHS[d.getMonth()] + ' ' + d.getFullYear();
        }

        function render() {
            if (!grid || !monthLabel) return;
            monthLabel.textContent = MONTHS[vMonth] + ' ' + vYear;
            grid.innerHTML = '';

            // Day name headers
            DAYS.forEach(function(n) {
                const el = document.createElement('div');
                el.className = 'avail-day-name';
                el.textContent = n;
                grid.appendChild(el);
            });

            // JS: 0=Sun … 6=Sat. We want Sat=col0, so offset = (dayOfWeek+1)%7
            const first  = new Date(vYear, vMonth, 1);
            const offset = (first.getDay() + 1) % 7;
            for (let i = 0; i < offset; i++) {
                const e = document.createElement('div');
                e.className = 'avail-day empty';
                grid.appendChild(e);
            }

            const total = new Date(vYear, vMonth + 1, 0).getDate();
            for (let d = 1; d <= total; d++) {
                const date = new Date(vYear, vMonth, d);
                const el   = document.createElement('div');
                el.textContent = d;

                const isToday     = date.getTime() === today.getTime();
                const isPast      = date < today;
                const isSel       = selected && date.getTime() === selected.getTime();
                const isBeforeSel = selected && date < selected && !isPast;
                const isAfterSel  = selected && date > selected;

                const cls = ['avail-day'];
                if      (isSel)        cls.push('selected');
                else if (isPast)       cls.push('past');
                else if (isBeforeSel)  cls.push('before-sel');
                else if (isAfterSel)   cls.push('after-sel');
                else                   cls.push('avail');
                if (isToday)           cls.push('today');

                el.className = cls.join(' ');
                if (!isPast) el.addEventListener('click', function() { pick(date); });
                grid.appendChild(el);
            }
        }

        function pick(date) {
            selected = new Date(date); selected.setHours(0,0,0,0);

            const y  = selected.getFullYear();
            const m  = String(selected.getMonth() + 1).padStart(2, '0');
            const dd = String(selected.getDate()).padStart(2, '0');
            if (hiddenInput)  hiddenInput.value = y + '-' + m + '-' + dd;
            if (resultBox)    resultBox.classList.add('show');
            if (resultDate)   resultDate.textContent = fmtAr(selected);
            if (blockedNote)  blockedNote.classList.add('show');

            const err = document.getElementById('avail-date-error');
            if (err) err.style.display = 'none';

            render();
        }

        document.getElementById('avail-prev') &&
            document.getElementById('avail-prev').addEventListener('click', function() {
                vMonth--; if (vMonth < 0) { vMonth = 11; vYear--; } render();
            });

        document.getElementById('avail-next') &&
            document.getElementById('avail-next').addEventListener('click', function() {
                vMonth++; if (vMonth > 11) { vMonth = 0; vYear++; } render();
            });

        render();

        if (selected) {
            if (resultBox)   resultBox.classList.add('show');
            if (resultDate)  resultDate.textContent = fmtAr(selected);
            if (blockedNote) blockedNote.classList.add('show');
        }
    })();
    </script>
</body>
</html>
