<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الامتيازات والعلامات التجارية — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:#0d2448; --navy-mid:#1a3a6e; --navy-deep:#081428;
            --gold:#f59e0b; --gold-light:rgba(245,158,11,.12);
        }
        body.inner-page { background:#f5f7fa !important; color:#1a1a2e !important; }

        /* ───── HERO ───── */
        .ba-hero {
            background:linear-gradient(160deg,#0d2448 0%,#1a3a6e 60%,#0d2448 100%);
            padding:80px 24px 52px; text-align:center; position:relative; overflow:hidden;
        }
        .ba-hero-badge { display:inline-flex; align-items:center; gap:8px; background:var(--gold-light); border:1px solid rgba(245,158,11,.3); color:#f59e0b; font-size:12px; font-weight:700; padding:6px 18px; border-radius:24px; margin-bottom:18px; }
        .ba-hero h1 { font-size:clamp(26px,4.5vw,48px); font-weight:900; color:#fff; margin:0 0 10px; line-height:1.25; }
        .ba-hero h1 span { color:#f59e0b; }
        .ba-hero p { font-size:15px; color:rgba(255,255,255,.7); max-width:580px; margin:0 auto 28px; line-height:1.8; }
        .search-wrap { max-width:540px; margin:0 auto; position:relative; }
        .search-input { width:100%; padding:15px 52px 15px 18px; border-radius:14px; border:1.5px solid rgba(255,255,255,.18); background:rgba(255,255,255,.1); backdrop-filter:blur(14px); color:#fff; font-size:14px; font-family:'Cairo',sans-serif; box-sizing:border-box; }
        .search-input::placeholder { color:rgba(255,255,255,.4); }
        .search-input:focus { outline:none; border-color:rgba(245,158,11,.6); }
        .search-icon { position:absolute; left:16px; top:50%; transform:translateY(-50%); color:rgba(255,255,255,.5); }

        /* ───── STATS BAR ───── */
        .stats-strip { background:#0d2448; display:flex; justify-content:center; border-bottom:1px solid rgba(255,255,255,.08); }
        .stat-chip { flex:1; max-width:200px; text-align:center; padding:16px 10px; border-left:1px solid rgba(255,255,255,.07); }
        .stat-chip:last-child { border-left:none; }
        .stat-chip .snum { font-size:24px; font-weight:900; color:#f59e0b; display:block; }
        .stat-chip .slbl { font-size:11px; color:rgba(255,255,255,.5); margin-top:2px; }

        /* ───── SECTION NAV TABS ───── */
        .section-tabs { background:#fff; border-bottom:2px solid #e2e8f0; position:sticky; top:0; z-index:100; }
        .section-tabs-inner { max-width:1240px; margin:0 auto; display:flex; overflow-x:auto; scrollbar-width:none; }
        .section-tabs-inner::-webkit-scrollbar { display:none; }
        .sec-tab { flex-shrink:0; padding:16px 28px; font-size:14px; font-weight:800; color:#64748b; border:none; background:none; cursor:pointer; font-family:'Cairo',sans-serif; border-bottom:3px solid transparent; margin-bottom:-2px; transition:all .2s; display:flex; align-items:center; gap:8px; text-decoration:none; white-space:nowrap; }
        .sec-tab:hover { color:#0d2448; }
        .sec-tab.active { color:#0d2448; border-bottom-color:#f59e0b; background:#fafbfc; }
        .sec-tab i { font-size:16px; }

        /* ───── SLIDER ───── */
        .page-slider { position:relative; overflow:hidden; height:380px; background:#0d2448; }
        .slide { position:absolute; inset:0; opacity:0; transition:opacity .8s ease; }
        .slide.active { opacity:1; }
        .slide img { width:100%; height:100%; object-fit:cover; }
        .slide-overlay { position:absolute; inset:0; background:linear-gradient(135deg,rgba(13,36,72,.7),rgba(26,74,138,.4)); display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:24px; }
        .slide-title { font-size:clamp(20px,3.5vw,38px); font-weight:900; color:#fff; text-shadow:0 2px 12px rgba(0,0,0,.4); margin:0 0 8px; }
        .slide-sub { font-size:clamp(13px,1.8vw,17px); color:rgba(255,255,255,.8); margin:0 0 18px; }
        .slide-btn { display:inline-flex; align-items:center; gap:8px; background:#f59e0b; color:#1a1100; padding:11px 26px; border-radius:12px; font-weight:800; font-size:14px; text-decoration:none; }
        .slider-dots { position:absolute; bottom:14px; left:50%; transform:translateX(-50%); display:flex; gap:7px; }
        .slider-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,.4); cursor:pointer; transition:all .3s; }
        .slider-dot.active { background:#f59e0b; transform:scale(1.3); }
        .slider-prev,.slider-next { position:absolute; top:50%; transform:translateY(-50%); background:rgba(255,255,255,.15); backdrop-filter:blur(6px); border:none; border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:#fff; font-size:15px; transition:background .2s; }
        .slider-prev:hover,.slider-next:hover { background:rgba(255,255,255,.3); }
        .slider-prev { right:14px; } .slider-next { left:14px; }
        @media(max-width:600px) { .page-slider { height:230px; } }

        /* ───── SECTION WRAPPERS ───── */
        .ba-section { display:none; animation:fadeIn .35s ease; }
        .ba-section.active { display:block; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .section-inner { max-width:1240px; margin:0 auto; padding:48px 24px; }
        .section-title { text-align:center; margin-bottom:40px; }
        .section-title .pre-tag { display:inline-block; background:#dbeafe; color:#1d4ed8; padding:4px 16px; border-radius:20px; font-size:12px; font-weight:800; margin-bottom:10px; }
        .section-title h2 { font-size:clamp(20px,3vw,32px); font-weight:900; color:#0d2448; margin:0 0 8px; }
        .section-title p { color:#64748b; font-size:14px; margin:0; }

        /* ───── FRANCHISE SECTION ───── */
        #sec-franchise { background:#f5f7fa; }
        .franchise-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px; }
        .fc-card { background:#fff; border-radius:18px; overflow:hidden; border:1.5px solid #e2e8f0; transition:transform .3s,box-shadow .3s; }
        .fc-card:hover { transform:translateY(-5px); box-shadow:0 12px 32px rgba(13,36,72,.1); border-color:#0d2448; }
        .fc-header { padding:0; position:relative; overflow:hidden; }
        .fc-header-img { width:100%; height:140px; object-fit:cover; display:block; }
        .fc-header-gradient { height:140px; display:flex; align-items:center; padding:18px 20px; gap:14px; }
        .fc-icon { width:50px; height:50px; border-radius:12px; background:rgba(255,255,255,.18); display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#fff; flex-shrink:0; }
        .fc-brand-name { font-size:16px; font-weight:800; color:#fff; margin:0 0 2px; }
        .fc-brand-en { font-size:11px; color:rgba(255,255,255,.65); }
        .fc-badge { margin-right:auto; background:rgba(255,255,255,.2); color:#fff; padding:3px 10px; border-radius:8px; font-size:10px; font-weight:700; }
        .fc-body { padding:16px 18px 18px; }
        .fc-desc { font-size:13px; color:#4b5563; line-height:1.7; margin-bottom:14px; }
        .fc-meta-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:14px; }
        .fc-meta-box { background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:8px 10px; }
        .fc-meta-label { font-size:10px; color:#94a3b8; font-weight:600; }
        .fc-meta-val { font-size:13px; font-weight:800; color:#0f172a; margin-top:2px; }
        .fc-tags { display:flex; gap:6px; flex-wrap:wrap; margin-bottom:14px; }
        .fc-tag { padding:3px 10px; border-radius:8px; font-size:11px; font-weight:700; background:#e0f2fe; color:#0369a1; }
        .fc-apply-btn { width:100%; padding:11px; background:#0d2448; color:#fff; font-weight:800; font-size:14px; border:none; border-radius:12px; cursor:pointer; font-family:'Cairo',sans-serif; transition:opacity .2s; }
        .fc-apply-btn:hover { opacity:.85; }
        .cat-filter { display:flex; gap:8px; flex-wrap:wrap; justify-content:center; margin-bottom:28px; }
        .cat-pill { padding:7px 16px; border-radius:20px; font-size:13px; font-weight:700; border:1.5px solid #e2e8f0; color:#64748b; background:#fff; cursor:pointer; white-space:nowrap; font-family:'Cairo',sans-serif; transition:all .2s; }
        .cat-pill:hover,.cat-pill.active { background:#0d2448; border-color:#0d2448; color:#fff; }

        /* ───── AGENCIES SECTION ───── */
        #sec-agencies { background:#fff; }
        .agencies-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px; }
        .agency-card { background:#f8fafc; border-radius:18px; overflow:hidden; border:1.5px solid #e2e8f0; transition:transform .3s,box-shadow .3s; }
        .agency-card:hover { transform:translateY(-5px); box-shadow:0 12px 32px rgba(13,36,72,.1); border-color:#0d2448; }
        .agency-header { background:linear-gradient(135deg,#0d2448,#1a4a8a); padding:22px 20px 16px; display:flex; align-items:center; gap:14px; }
        .agency-logo { width:56px; height:56px; border-radius:14px; background:rgba(255,255,255,.12); display:flex; align-items:center; justify-content:center; font-weight:900; color:#f59e0b; font-size:1.2rem; flex-shrink:0; overflow:hidden; border:1.5px solid rgba(255,255,255,.15); }
        .agency-logo img { width:100%; height:100%; object-fit:contain; }
        .agency-name { font-size:15px; font-weight:800; color:#fff; margin:0 0 2px; }
        .agency-name-en { font-size:11px; color:rgba(255,255,255,.55); }
        .agency-verified { margin-right:auto; background:rgba(245,158,11,.2); color:#f59e0b; padding:3px 9px; border-radius:7px; font-size:10px; font-weight:700; display:inline-flex; align-items:center; gap:4px; }
        .agency-body { padding:14px 18px 18px; }
        .agency-type-badge { display:inline-flex; align-items:center; gap:6px; background:#dbeafe; color:#1d4ed8; padding:4px 12px; border-radius:8px; font-size:11px; font-weight:700; margin-bottom:10px; }
        .agency-desc { font-size:13px; color:#4b5563; line-height:1.65; margin-bottom:12px; }
        .agency-meta { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:12px; }
        .agency-meta-item { font-size:11px; color:#64748b; display:flex; align-items:center; gap:4px; background:#f1f5f9; padding:4px 10px; border-radius:8px; }
        .agency-meta-item i { color:#0d2448; font-size:10px; }
        .agency-invest { font-size:12px; font-weight:800; color:#0d2448; margin-bottom:12px; }
        .agency-regions { display:flex; gap:5px; flex-wrap:wrap; margin-bottom:12px; }
        .agency-region { font-size:10px; background:#f0fdf4; color:#15803d; padding:3px 8px; border-radius:6px; font-weight:700; }
        .agency-btn { width:100%; padding:10px; background:#0d2448; color:#fff; font-weight:800; font-size:13px; border:none; border-radius:10px; cursor:pointer; font-family:'Cairo',sans-serif; transition:opacity .2s; display:flex; align-items:center; justify-content:center; gap:6px; }
        .agency-btn:hover { opacity:.85; }

        /* ───── BRANDS SECTION ───── */
        #sec-brands { background:#f5f7fa; }
        .range-section { padding:40px 0; }
        .range-section:not(:last-child) { border-bottom:1px solid #e2e8f0; }
        .range-header { display:flex; align-items:center; gap:14px; margin-bottom:24px; }
        .range-label { background:#0d2448; color:#fff; font-weight:800; font-size:12px; padding:7px 18px; border-radius:9px; white-space:nowrap; flex-shrink:0; }
        .range-line { flex:1; height:2px; background:linear-gradient(90deg,#0d2448,transparent); }
        .range-count { font-size:12px; color:#94a3b8; white-space:nowrap; }
        .brands-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(210px,1fr)); gap:16px; }
        .brand-card { background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 2px 12px rgba(13,36,72,.06); border:1.5px solid #e8edf5; transition:transform .3s,box-shadow .3s,border-color .3s; cursor:pointer; display:flex; flex-direction:column; }
        .brand-card:hover { transform:translateY(-6px); box-shadow:0 14px 36px rgba(13,36,72,.12); border-color:#0d2448; }
        .brand-card:hover .bc-btn { background:#0d2448; color:#fff; }
        .bc-top { padding:16px 14px 10px; text-align:center; flex:1; position:relative; }
        .bc-logo { width:72px; height:72px; border-radius:16px; margin:0 auto 10px; border:1.5px solid #e8edf5; display:flex; align-items:center; justify-content:center; font-weight:900; color:#0d2448; font-size:1.3rem; overflow:hidden; background:#f8fafc; }
        .bc-logo img { width:100%; height:100%; object-fit:contain; }
        .bc-name { font-size:14px; font-weight:800; color:#0f172a; margin-bottom:2px; }
        .bc-cat { font-size:11px; color:#94a3b8; margin-bottom:6px; }
        .bc-invest { font-size:12px; font-weight:800; color:#0d2448; }
        .bc-invest span { color:#64748b; font-weight:400; font-size:11px; }
        .bc-metrics { display:grid; grid-template-columns:1fr 1fr 1fr; gap:0; border-top:1px solid #f1f5f9; border-bottom:1px solid #f1f5f9; }
        .bc-metric { padding:7px 5px; text-align:center; border-left:1px solid #f1f5f9; }
        .bc-metric:last-child { border-left:none; }
        .bc-metric-val { font-size:12px; font-weight:900; line-height:1; }
        .bc-metric-lbl { font-size:9px; color:#94a3b8; margin-top:2px; font-weight:600; }
        .bc-demand-bar { height:3px; border-radius:2px; margin:4px auto 0; width:80%; background:#e2e8f0; overflow:hidden; }
        .bc-demand-fill { height:100%; border-radius:2px; }
        .bc-footer { padding:9px 12px 12px; }
        .bc-btn { display:flex; align-items:center; justify-content:center; gap:6px; width:100%; padding:9px; border-radius:10px; font-size:12px; font-weight:800; border:1.5px solid #0d2448; color:#0d2448; background:transparent; cursor:pointer; font-family:'Cairo',sans-serif; transition:all .2s; text-decoration:none; }
        .bc-badge-auction { position:absolute; top:8px; right:8px; background:#ef4444; color:#fff; font-size:9px; font-weight:700; padding:3px 7px; border-radius:7px; }
        .bc-badge-featured { position:absolute; top:8px; left:8px; background:#f59e0b; color:#1a1100; font-size:9px; font-weight:700; padding:3px 7px; border-radius:7px; }
        .bc-badge-trending { position:absolute; top:8px; left:8px; background:linear-gradient(135deg,#ef4444,#f97316); color:#fff; font-size:9px; font-weight:700; padding:3px 7px; border-radius:7px; display:flex; align-items:center; gap:3px; }
        .bc-verified { display:inline-flex; align-items:center; gap:3px; background:#dbeafe; color:#1d4ed8; font-size:10px; font-weight:700; padding:2px 7px; border-radius:6px; margin-bottom:5px; }

        /* ───── AUCTIONS SECTION ───── */
        #sec-auctions { background:linear-gradient(135deg,#081428,#0d2448); min-height:400px; }
        #sec-auctions .section-inner { padding:48px 24px; }
        #sec-auctions .section-title .pre-tag { background:rgba(245,158,11,.15); color:#f59e0b; }
        #sec-auctions .section-title h2 { color:#fff; }
        #sec-auctions .section-title p { color:rgba(255,255,255,.5); }
        .live-badge { display:inline-flex; align-items:center; gap:7px; background:rgba(239,68,68,.15); border:1px solid rgba(239,68,68,.3); color:#ef4444; padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700; margin-bottom:20px; }
        .live-dot { width:8px; height:8px; border-radius:50%; background:#ef4444; box-shadow:0 0 0 3px rgba(239,68,68,.25); animation:pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.3)} }
        .auction-cards { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px; }
        .auction-card { background:rgba(255,255,255,.06); backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,.1); border-radius:20px; overflow:hidden; transition:transform .3s,border-color .3s; }
        .auction-card:hover { transform:translateY(-5px); border-color:rgba(245,158,11,.3); }
        .ac-header { padding:18px 18px 12px; border-bottom:1px solid rgba(255,255,255,.07); display:flex; align-items:center; gap:12px; }
        .ac-logo { width:50px; height:50px; border-radius:12px; background:rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center; font-weight:900; color:#f59e0b; font-size:1rem; flex-shrink:0; overflow:hidden; }
        .ac-logo img { width:100%; height:100%; object-fit:contain; }
        .ac-name { font-size:15px; font-weight:800; color:#fff; margin:0 0 2px; }
        .ac-cat { font-size:11px; color:rgba(255,255,255,.4); }
        .ac-body { padding:14px 18px 18px; }
        .ac-price-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
        .ac-price { font-size:21px; font-weight:900; color:#f59e0b; direction:ltr; display:inline-block; }
        .ac-bids { font-size:11px; color:rgba(255,255,255,.5); }
        .ac-timer { display:flex; gap:5px; margin-bottom:12px; }
        .ac-tu { background:rgba(245,158,11,.1); border:1px solid rgba(245,158,11,.15); border-radius:8px; padding:5px 8px; min-width:38px; text-align:center; }
        .ac-tn { font-size:15px; font-weight:900; color:#f59e0b; line-height:1; display:block; }
        .ac-tl { font-size:9px; color:rgba(255,255,255,.4); }
        .ac-bid-btn { width:100%; padding:11px; background:linear-gradient(135deg,#f59e0b,#d97706); color:#1a1100; font-weight:800; font-size:14px; border:none; border-radius:12px; cursor:pointer; font-family:'Cairo',sans-serif; transition:transform .2s; text-decoration:none; display:flex; align-items:center; justify-content:center; gap:6px; }
        .ac-bid-btn:hover { transform:translateY(-2px); }
        .ended-section { margin-top:40px; }
        .ended-section h3 { font-size:16px; font-weight:800; color:rgba(255,255,255,.6); margin-bottom:16px; }
        .ended-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:14px; }
        .ended-card { background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); border-radius:14px; padding:16px; display:flex; align-items:center; gap:12px; }
        .ended-logo { width:42px; height:42px; border-radius:10px; background:rgba(255,255,255,.08); display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:.9rem; font-weight:700; overflow:hidden; flex-shrink:0; }
        .ended-logo img { width:100%; height:100%; object-fit:contain; }
        .ended-name { font-size:13px; font-weight:800; color:rgba(255,255,255,.7); }
        .ended-price { font-size:13px; font-weight:900; color:#94a3b8; direction:ltr; }
        .ended-badge { font-size:10px; background:rgba(100,116,139,.2); color:#94a3b8; padding:2px 8px; border-radius:6px; font-weight:700; margin-top:3px; display:inline-block; }

        /* ───── EMPTY STATE ───── */
        .empty-state { text-align:center; padding:60px 24px; color:#94a3b8; }
        .empty-state i { font-size:2.5rem; margin-bottom:14px; display:block; color:#cbd5e1; }
        .empty-state h3 { color:#64748b; font-weight:700; margin:0 0 6px; }
        .empty-state p { font-size:13px; }

        /* ───── MODAL ───── */
        .modal-overlay { position:fixed; inset:0; z-index:9000; background:rgba(0,0,0,.75); backdrop-filter:blur(8px); display:none; align-items:center; justify-content:center; padding:20px; overflow-y:auto; }
        .modal-overlay.open { display:flex; }
        .modal-box { background:linear-gradient(160deg,#0d1f3c,#0f2d5a); border:1px solid rgba(255,255,255,.1); border-radius:24px; max-width:560px; width:100%; position:relative; box-shadow:0 32px 80px rgba(0,0,0,.7); overflow:hidden; max-height:90vh; display:flex; flex-direction:column; }
        .modal-header { background:linear-gradient(135deg,#0d2448,#1a4a8a); padding:26px 26px 18px; color:#fff; flex-shrink:0; }
        .modal-header h3 { margin:0 0 4px; font-size:19px; }
        .modal-header p { margin:0; font-size:13px; color:rgba(255,255,255,.5); }
        .modal-close { position:absolute; top:14px; left:14px; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.15); border-radius:50%; width:30px; height:30px; cursor:pointer; color:#fff; display:flex; align-items:center; justify-content:center; font-size:13px; transition:background .2s; }
        .modal-close:hover { background:rgba(255,255,255,.22); }
        .modal-body { padding:22px 26px; overflow-y:auto; }
        .form-group { margin-bottom:13px; }
        .form-group label { display:block; font-size:12px; font-weight:700; color:rgba(255,255,255,.6); margin-bottom:5px; }
        .form-group input, .form-group select, .form-group textarea { width:100%; padding:10px 12px; border:1.5px solid rgba(255,255,255,.12); border-radius:10px; font-family:'Cairo',sans-serif; font-size:.9rem; box-sizing:border-box; background:rgba(255,255,255,.07); color:#fff; }
        .form-group input::placeholder, .form-group textarea::placeholder { color:rgba(255,255,255,.3); }
        .form-group select option { background:#0f2d5a; color:#fff; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline:none; border-color:rgba(245,158,11,.5); }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .modal-submit { width:100%; padding:13px; background:linear-gradient(135deg,#f59e0b,#d97706); color:#1a1100; font-weight:800; font-size:15px; border:none; border-radius:12px; cursor:pointer; font-family:'Cairo',sans-serif; margin-top:8px; transition:opacity .2s; }
        .modal-submit:hover { opacity:.9; }

        /* ───── REVEAL ───── */
        .reveal { opacity:0; transform:translateY(18px); transition:opacity .5s ease,transform .5s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }

        /* ───── RESPONSIVE ───── */
        @media(max-width:700px) {
            .brands-grid { grid-template-columns:repeat(2,1fr); }
            .franchise-grid,.auction-cards,.agencies-grid { grid-template-columns:1fr; }
            .stats-strip { flex-wrap:wrap; }
            .stat-chip { min-width:50%; }
            .form-row { grid-template-columns:1fr; }
        }
    </style>
</head>
<body class="inner-page">

<canvas id="bg-canvas" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none;opacity:0.3;"></canvas>

@include('partials.public_nav')

{{-- ═══════════ HERO ═══════════ --}}
<section class="ba-hero">
    <div class="ba-hero-badge"><i class="fa fa-certificate"></i> منصة سعودية معتمدة لدى SAIP</div>
    <h1>الامتيازات<br><span>والعلامات التجارية</span></h1>
    <p>استعرض فرص الامتياز، الوكالات التجارية، واشترِ علامتك عبر أول منصة سعودية متخصصة.</p>
    <div class="search-wrap">
        <input type="text" id="searchInput" class="search-input" placeholder="ابحث عن علامة تجارية أو قطاع...">
        <i class="fa fa-search search-icon"></i>
    </div>
</section>

{{-- ═══════════ STATS BAR ═══════════ --}}
<div class="stats-strip">
    <div class="stat-chip"><span class="snum">{{ $stats['opportunities'] }}</span><span class="slbl">فرصة امتياز</span></div>
    <div class="stat-chip"><span class="snum">{{ $stats['agencies'] }}</span><span class="slbl">وكالة تجارية</span></div>
    <div class="stat-chip"><span class="snum">{{ $stats['brands'] }}</span><span class="slbl">علامة للبيع</span></div>
    <div class="stat-chip"><span class="snum">{{ $stats['auctions'] }}</span><span class="slbl">مزاد نشط</span></div>
</div>

{{-- ═══════════ SLIDER ═══════════ --}}
@if($sliders->isNotEmpty())
<div class="page-slider" id="pageSlider">
    @foreach($sliders as $i => $slide)
    <div class="slide {{ $i===0 ? 'active' : '' }}" data-slide="{{ $i }}">
        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}">
        <div class="slide-overlay">
            @if($slide->title)<h2 class="slide-title">{{ $slide->title }}</h2>@endif
            @if($slide->subtitle)<p class="slide-sub">{{ $slide->subtitle }}</p>@endif
            @if($slide->link_url)<a href="{{ $slide->link_url }}" class="slide-btn">{{ $slide->link_text ?: 'اكتشف المزيد' }} <i class="fa fa-arrow-left"></i></a>@endif
        </div>
    </div>
    @endforeach
    @if($sliders->count() > 1)
    <button class="slider-prev" onclick="sliderMove(-1)"><i class="fa fa-chevron-right"></i></button>
    <button class="slider-next" onclick="sliderMove(1)"><i class="fa fa-chevron-left"></i></button>
    <div class="slider-dots">
        @foreach($sliders as $i => $s)
        <div class="slider-dot {{ $i===0?'active':'' }}" onclick="goSlide({{ $i }})"></div>
        @endforeach
    </div>
    @endif
</div>
@endif

{{-- ═══════════ SECTION TABS ═══════════ --}}
<nav class="section-tabs" id="sectionTabs">
    <div class="section-tabs-inner">
        <button class="sec-tab {{ $section==='franchise' ? 'active' : '' }}" onclick="switchSection('franchise',this)">
            <i class="fas fa-store"></i> فرص الامتياز
        </button>
        <button class="sec-tab {{ $section==='agencies' ? 'active' : '' }}" onclick="switchSection('agencies',this)">
            <i class="fas fa-building"></i> الوكالات التجارية
        </button>
        <button class="sec-tab {{ $section==='brands' ? 'active' : '' }}" onclick="switchSection('brands',this)">
            <i class="fas fa-trademark"></i> بيع العلامات
        </button>
        <button class="sec-tab {{ $section==='auctions' ? 'active' : '' }}" onclick="switchSection('auctions',this)">
            <i class="fas fa-gavel"></i> المزادات
            @if($stats['auctions'] > 0)
            <span style="background:#ef4444;color:#fff;font-size:9px;font-weight:700;padding:2px 6px;border-radius:10px;margin-right:2px;">{{ $stats['auctions'] }}</span>
            @endif
        </button>
    </div>
</nav>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECTION 1: FRANCHISE OPPORTUNITIES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div id="sec-franchise" class="ba-section {{ $section==='franchise' ? 'active' : '' }}">
    <div class="section-inner">
        <div class="section-title reveal">
            <div class="pre-tag"><i class="fas fa-store"></i> فرص الامتياز</div>
            <h2>علامات تجارية موثوقة تنتظرك</h2>
            <p>اختر الامتياز المناسب لإمكاناتك وابدأ رحلتك الاستثمارية</p>
        </div>

        @if($franchiseOpportunities->isNotEmpty())
        {{-- Category filter --}}
        @php $fcCats = $franchiseOpportunities->pluck('category')->unique()->values(); @endphp
        @if($fcCats->count() > 1)
        <div class="cat-filter reveal" id="fcCatFilter">
            <button class="cat-pill active" onclick="filterFC('all',this)">الكل</button>
            @foreach($fcCats as $cat)
            <button class="cat-pill" onclick="filterFC('{{ $cat }}',this)">{{ \App\Models\FranchiseOpportunity::$categories[$cat] ?? $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="franchise-grid" id="fcGrid">
            @foreach($franchiseOpportunities as $opp)
            <div class="fc-card reveal" data-fc-cat="{{ $opp->category }}">
                {{-- Card Header: image if available, else gradient --}}
                <div class="fc-header">
                    @if($opp->logo_url)
                    <div style="position:relative;">
                        <img src="{{ $opp->logo_url }}" alt="{{ $opp->name }}" class="fc-header-img">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(13,36,72,.7),transparent);display:flex;align-items:flex-end;padding:14px 18px;">
                            <div>
                                <div class="fc-brand-name" style="font-size:17px;">{{ $opp->name }}</div>
                                @if($opp->name_en)<div class="fc-brand-en">{{ $opp->name_en }}</div>@endif
                            </div>
                            @if($opp->badge_text)
                            <span class="fc-badge" style="margin-right:auto;margin-bottom:auto;">{{ $opp->badge_text }}</span>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="fc-header-gradient" style="background:linear-gradient(135deg,{{ $opp->gradient_from }},{{ $opp->gradient_to }});">
                        <div class="fc-icon"><i class="fas {{ $opp->icon }}"></i></div>
                        <div>
                            <div class="fc-brand-name">{{ $opp->name }}</div>
                            @if($opp->name_en)<div class="fc-brand-en">{{ $opp->name_en }}</div>@endif
                        </div>
                        @if($opp->badge_text)<span class="fc-badge">{{ $opp->badge_text }}</span>@endif
                    </div>
                    @endif
                </div>
                <div class="fc-body">
                    @if($opp->description)<p class="fc-desc">{{ $opp->description }}</p>@endif
                    <div class="fc-meta-grid">
                        <div class="fc-meta-box">
                            <div class="fc-meta-label"><i class="fa fa-coins" style="color:#f59e0b;"></i> الاستثمار</div>
                            <div class="fc-meta-val">{{ number_format($opp->investment_min/1000) }}K–{{ number_format($opp->investment_max/1000) }}K ر.س</div>
                        </div>
                        <div class="fc-meta-box">
                            <div class="fc-meta-label"><i class="fa fa-clock" style="color:#38bdf8;"></i> العائد</div>
                            <div class="fc-meta-val">{{ $opp->roi_months_min }}–{{ $opp->roi_months_max }} شهراً</div>
                        </div>
                        @if($opp->available_regions && count($opp->available_regions))
                        <div class="fc-meta-box">
                            <div class="fc-meta-label"><i class="fa fa-map-marker-alt" style="color:#10b981;"></i> المناطق</div>
                            <div class="fc-meta-val" style="font-size:11px;">{{ implode('، ', array_slice($opp->available_regions,0,2)) }}{{ count($opp->available_regions)>2 ? '...' : '' }}</div>
                        </div>
                        @endif
                        <div class="fc-meta-box">
                            <div class="fc-meta-label"><i class="fa fa-percentage" style="color:#a78bfa;"></i> رسوم الامتياز</div>
                            <div class="fc-meta-val">{{ $opp->franchise_fee_percent }}%</div>
                        </div>
                    </div>
                    @if($opp->requirements && count($opp->requirements))
                    <div class="fc-tags">
                        @foreach(array_slice($opp->requirements,0,3) as $req)
                        <span class="fc-tag">{{ $req }}</span>
                        @endforeach
                    </div>
                    @endif
                    <button class="fc-apply-btn" onclick="openFranchiseModal({{ $opp->id }})">
                        تقدم الآن <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-store"></i>
            <h3>لا توجد فرص امتياز حتى الآن</h3>
            <p>يمكن للمشرف إضافة فرص الامتياز من لوحة التحكم.</p>
        </div>
        @endif
    </div>

    {{-- Why us + SAIP steps --}}
    <section style="background:#0d2448;padding:48px 24px;">
        <div style="max-width:1100px;margin:0 auto;text-align:center;">
            <h2 style="font-size:clamp(18px,2.5vw,28px);font-weight:900;color:#fff;margin:0 0 8px;">لماذا تختار منصتنا؟</h2>
            <p style="color:rgba(255,255,255,.5);font-size:13px;margin-bottom:36px;">Why choose our platform</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
                @foreach([
                    ['fa-shield-alt','توثيق وفحص معمّق','كل علامة تمر بعملية فحص شاملة قبل نشرها.'],
                    ['fa-balance-scale','دعم قانوني متكامل','فريق قانوني من صياغة العقود حتى التوقيع.'],
                    ['fa-gavel','مزادات شفافة','مزادات مباشرة على العلامات بإشراف SAIP.'],
                    ['fa-chart-line','دراسات جدوى','دراسات جدوى محدّثة لكل فرصة استثمارية.'],
                    ['fa-headset','دعم مستمر','مرافقة متواصلة حتى استقرار مشروعك.'],
                ] as $w)
                <div style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:22px 16px;text-align:center;">
                    <div style="width:48px;height:48px;border-radius:12px;background:rgba(245,158,11,.12);border:1px solid rgba(245,158,11,.2);display:flex;align-items:center;justify-content:center;font-size:20px;color:#f59e0b;margin:0 auto 12px;">
                        <i class="fa {{ $w[0] }}"></i>
                    </div>
                    <h4 style="font-size:13px;font-weight:800;color:#fff;margin:0 0 6px;">{{ $w[1] }}</h4>
                    <p style="font-size:11px;color:rgba(255,255,255,.5);line-height:1.65;margin:0;">{{ $w[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECTION 2: COMMERCIAL AGENCIES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div id="sec-agencies" class="ba-section {{ $section==='agencies' ? 'active' : '' }}">
    <div class="section-inner">
        <div class="section-title reveal">
            <div class="pre-tag" style="background:#dbeafe;color:#1d4ed8;"><i class="fas fa-building"></i> الوكالات التجارية</div>
            <h2>وكالات ووكلاء معتمدون</h2>
            <p>احصل على وكالة حصرية أو توزيع معتمد لأكبر الماركات العالمية في السوق السعودي</p>
        </div>

        @if($agencies->isNotEmpty())
        {{-- Category filter --}}
        @php $agCats = $agencies->pluck('category')->unique()->values(); @endphp
        @if($agCats->count() > 1)
        <div class="cat-filter reveal" id="agCatFilter">
            <button class="cat-pill active" onclick="filterAgencies('all',this)">الكل</button>
            @foreach($agCats as $cat)
            <button class="cat-pill" onclick="filterAgencies('{{ $cat }}',this)">{{ \App\Models\CommercialAgency::$categories[$cat] ?? $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="agencies-grid" id="agGrid">
            @foreach($agencies as $agency)
            <div class="agency-card reveal" data-ag-cat="{{ $agency->category }}" data-ag-name="{{ $agency->name }}">
                <div class="agency-header">
                    <div class="agency-logo">
                        @if($agency->logo_url)
                            <img src="{{ $agency->logo_url }}" alt="{{ $agency->name }}">
                        @else
                            {{ mb_substr($agency->name,0,2) }}
                        @endif
                    </div>
                    <div style="flex:1;">
                        <div class="agency-name">{{ $agency->name }}</div>
                        @if($agency->name_en)<div class="agency-name-en">{{ $agency->name_en }}</div>@endif
                    </div>
                    @if($agency->is_verified)
                    <div class="agency-verified"><i class="fas fa-circle-check"></i> موثق</div>
                    @endif
                </div>
                <div class="agency-body">
                    <span class="agency-type-badge"><i class="fas fa-handshake"></i> {{ $agency->agency_type_label }}</span>
                    @if($agency->description)<p class="agency-desc">{{ Str::limit($agency->description, 100) }}</p>@endif
                    <div class="agency-meta">
                        <div class="agency-meta-item"><i class="fas fa-globe"></i> {{ $agency->country_origin }}</div>
                        @if($agency->min_years_experience > 0)
                        <div class="agency-meta-item"><i class="fas fa-briefcase"></i> {{ $agency->min_years_experience }}+ سنوات خبرة</div>
                        @endif
                    </div>
                    @if($agency->available_regions && count($agency->available_regions))
                    <div class="agency-regions">
                        @foreach(array_slice($agency->available_regions,0,3) as $region)
                        <span class="agency-region">{{ $region }}</span>
                        @endforeach
                        @if(count($agency->available_regions) > 3)
                        <span class="agency-region" style="background:#dbeafe;color:#1d4ed8;">+{{ count($agency->available_regions)-3 }}</span>
                        @endif
                    </div>
                    @endif
                    <div class="agency-invest"><i class="fas fa-coins" style="color:#f59e0b;margin-left:4px;"></i>
                        {{ number_format($agency->investment_min/1000) }}K — {{ number_format($agency->investment_max/1000) }}K ريال
                    </div>
                    <button class="agency-btn" onclick="openAgencyModal('{{ addslashes($agency->name) }}', {{ $agency->id }})">
                        <i class="fas fa-paper-plane"></i> طلب التواصل
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-building"></i>
            <h3>لا توجد وكالات متاحة حتى الآن</h3>
            <p>يمكن للمشرف إضافة الوكالات من لوحة التحكم.</p>
        </div>
        @endif
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECTION 3: BRAND SALES --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div id="sec-brands" class="ba-section {{ $section==='brands' ? 'active' : '' }}">
    @php
        $brandsByRange = [];
        $ranges = [
            ['label'=>'أقل من 100 ألف ريال',    'min'=>0,        'max'=>99999],
            ['label'=>'100 ألف — 500 ألف ريال',  'min'=>100000,   'max'=>499999],
            ['label'=>'500 ألف — مليون ريال',    'min'=>500000,   'max'=>999999],
            ['label'=>'أكثر من مليون ريال',      'min'=>1000000,  'max'=>PHP_INT_MAX],
        ];
        foreach($ranges as $r) {
            $inRange = $brands->filter(fn($b) => $b->investment_min >= $r['min'] && $b->investment_min <= $r['max']);
            if($inRange->isNotEmpty()) $brandsByRange[] = ['label'=>$r['label'], 'brands'=>$inRange];
        }
        $unranked = $brands->filter(fn($b) => collect($ranges)->every(fn($r) => $b->investment_min < $r['min'] || $b->investment_min > $r['max']));
        if($unranked->isNotEmpty()) $brandsByRange[] = ['label'=>'فئات أخرى', 'brands'=>$unranked];
    @endphp

    {{-- Category quick-nav --}}
    <nav style="background:#fff;border-bottom:1px solid #e2e8f0;padding:12px 24px;display:flex;gap:8px;overflow-x:auto;scrollbar-width:none;">
        <button class="cat-pill active" onclick="filterBrands('all',this)">الكل</button>
        @foreach($brands->pluck('category')->unique() as $cat)
        <button class="cat-pill" onclick="filterBrands('{{ $cat }}',this)">{{ $cat }}</button>
        @endforeach
    </nav>

    <div style="max-width:1240px;margin:0 auto;padding:24px 24px 48px;">
        @if(empty($brandsByRange))
        <div class="empty-state">
            <i class="fas fa-trademark"></i>
            <h3>لا توجد علامات تجارية حتى الآن</h3>
            <p>يمكن للمشرف إضافة علامات من لوحة التحكم.</p>
        </div>
        @else
        @foreach($brandsByRange as $range)
        <div class="range-section">
            <div class="range-header reveal">
                <div class="range-label"><i class="fa fa-coins"></i> {{ $range['label'] }}</div>
                <div class="range-line"></div>
                <div class="range-count">{{ $range['brands']->count() }} علامة</div>
            </div>
            <div class="brands-grid">
                @foreach($range['brands'] as $brand)
                @php
                    $auction     = $brand->activeAuction();
                    $demandScore = (($brand->id * 37 + 23) % 45) + 52;
                    $confidence  = (($brand->id * 53 + 11) % 30) + 65;
                    $isTrending  = ($brand->id % 4 === 0);
                    $demandColor = $demandScore >= 80 ? '#10b981' : ($demandScore >= 65 ? '#f59e0b' : '#ef4444');
                    $roiChange   = ($brand->id % 2 === 0) ? '+' . (($brand->id * 7 + 3) % 18 + 4) : '-' . (($brand->id * 5 + 2) % 8 + 1);
                    $roiUp       = str_starts_with($roiChange, '+');
                @endphp
                <div class="brand-card reveal" data-cat="{{ $brand->category }}" data-name="{{ $brand->name }}" data-nameen="{{ $brand->name_en }}">
                    <div class="bc-top">
                        @if($auction)<span class="bc-badge-auction"><i class="fa fa-gavel"></i> مزاد</span>@endif
                        @if($isTrending && !$auction)<span class="bc-badge-trending"><i class="fa fa-fire"></i> رائج</span>
                        @elseif($brand->is_featured && !$auction)<span class="bc-badge-featured"><i class="fa fa-star"></i> مميز</span>@endif
                        <div class="bc-logo">
                            @if($brand->logo_url)
                                <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}">
                            @else
                                {{ mb_substr($brand->name,0,2) }}
                            @endif
                        </div>
                        <span class="bc-verified"><i class="fa fa-circle-check"></i> موثق</span>
                        <div class="bc-name">{{ $brand->name }}</div>
                        @if($brand->name_en)<div class="bc-cat">{{ $brand->name_en }}</div>@endif
                        <div class="bc-invest">
                            {{ number_format($brand->investment_min/1000) }}K–{{ number_format($brand->investment_max/1000) }}K <span>ر.س</span>
                        </div>
                    </div>
                    <div class="bc-metrics">
                        <div class="bc-metric">
                            <div class="bc-metric-val" style="color:{{ $demandColor }};">{{ $demandScore }}</div>
                            <div class="bc-demand-bar"><div class="bc-demand-fill" style="width:{{ $demandScore }}%;background:{{ $demandColor }};"></div></div>
                            <div class="bc-metric-lbl">الطلب</div>
                        </div>
                        <div class="bc-metric">
                            <div class="bc-metric-val" style="color:{{ $roiUp ? '#10b981' : '#ef4444' }};">
                                <i class="fa fa-arrow-{{ $roiUp ? 'up' : 'down' }}" style="font-size:8px;"></i> {{ abs((int)$roiChange) }}%
                            </div>
                            <div class="bc-metric-lbl">ROI</div>
                        </div>
                        <div class="bc-metric">
                            <div class="bc-metric-val" style="color:#0d2448;">{{ $brand->roi_months_min }}–{{ $brand->roi_months_max }}</div>
                            <div class="bc-metric-lbl">شهر عائد</div>
                        </div>
                    </div>
                    <div class="bc-footer">
                        @if($auction)
                            <a href="{{ route('brands.auction.show', $auction) }}" class="bc-btn" style="background:#0d2448;color:#fff;border-color:#0d2448;">
                                <i class="fa fa-gavel"></i> زايد الآن — {{ number_format($auction->current_bid) }} ر.س
                            </a>
                        @else
                            <button class="bc-btn" onclick="openApplyModal('{{ addslashes($brand->name) }}','{{ $brand->investment_min/1000 }}K–{{ $brand->investment_max/1000 }}K ر.س')">
                                <i class="fa fa-handshake"></i> طلب الامتياز
                            </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        @endif
    </div>

    {{-- SAIP Steps --}}
    <section style="background:#fff;padding:48px 24px;">
        <div style="max-width:960px;margin:0 auto;text-align:center;">
            <h2 style="font-size:clamp(18px,2.5vw,28px);font-weight:900;color:#0d2448;margin:0 0 6px;">خطوات نقل العلامة التجارية</h2>
            <p style="color:#64748b;font-size:13px;margin-bottom:32px;">وفق نظام العلامات التجارية الخليجي الموحد — المادة 25</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px;text-align:right;">
                @foreach([
                    ['fa-file-signature','توقيع عقد التنازل','يوقّع البائع والمشتري عقد نقل موثق.'],
                    ['fa-university','توثيق كاتب عدل','التوثيق لدى كاتب عدل معتمد.'],
                    ['fa-paper-plane','تقديم طلب SAIP','رفع طلب النقل إلكترونياً + رسوم 575 ر.س.'],
                    ['fa-check-double','التسجيل والنشر','تسجيل النقل في السجل الرسمي ونشره.'],
                    ['fa-certificate','شهادة الملكية','استلام شهادة التسجيل الجديدة.'],
                ] as $i => $s)
                <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:14px;padding:16px;position:relative;">
                    <div style="position:absolute;top:10px;right:10px;width:22px;height:22px;border-radius:50%;background:#0d2448;color:#fff;font-size:10px;font-weight:900;display:flex;align-items:center;justify-content:center;">{{ $i+1 }}</div>
                    <i class="fa {{ $s[0] }}" style="font-size:1.6rem;color:#0d2448;margin-bottom:8px;display:block;margin-top:6px;"></i>
                    <h4 style="font-size:12px;font-weight:800;color:#0f172a;margin:0 0 4px;">{{ $s[1] }}</h4>
                    <p style="font-size:11px;color:#64748b;line-height:1.6;margin:0;">{{ $s[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECTION 4: AUCTIONS --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div id="sec-auctions" class="ba-section {{ $section==='auctions' ? 'active' : '' }}">
    <div class="section-inner">
        <div class="section-title reveal">
            <div class="pre-tag"><i class="fas fa-gavel"></i> المزادات الإلكترونية</div>
            <h2 style="color:#fff;">مزادات حية على العلامات التجارية</h2>
            <p>شارك في مزاداتنا الشفافة واحصل على علامتك بأفضل سعر</p>
        </div>

        @if($activeAuctions->isNotEmpty())
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;flex-wrap:wrap;gap:10px;">
            <div class="live-badge"><div class="live-dot"></div> {{ $activeAuctions->count() }} مزاد نشط الآن</div>
        </div>
        <div class="auction-cards">
            @foreach($activeAuctions as $auction)
            <div class="auction-card reveal">
                <div class="ac-header">
                    <div class="ac-logo">
                        @if($auction->brand->logo_url)
                            <img src="{{ $auction->brand->logo_url }}" alt="{{ $auction->brand->name }}">
                        @else
                            {{ mb_substr($auction->brand->name,0,2) }}
                        @endif
                    </div>
                    <div>
                        <div class="ac-name">{{ $auction->brand->name }}</div>
                        <div class="ac-cat">{{ $auction->brand->name_en }} · {{ $auction->brand->category }}</div>
                    </div>
                </div>
                <div class="ac-body">
                    <div class="ac-price-row">
                        <div>
                            <div style="font-size:10px;color:rgba(255,255,255,.4);margin-bottom:2px;">المزايدة الحالية</div>
                            <div class="ac-price">{{ number_format($auction->current_bid) }} <span style="font-size:12px;color:rgba(255,255,255,.4);font-weight:600;">ر.س</span></div>
                        </div>
                        <div class="ac-bids"><i class="fa fa-gavel"></i> {{ $auction->bids_count }} مزايدة</div>
                    </div>
                    <div class="ac-timer" data-end="{{ $auction->ends_at->toIso8601String() }}">
                        <div class="ac-tu"><span class="ac-tn day">--</span><span class="ac-tl">يوم</span></div>
                        <div class="ac-tu"><span class="ac-tn hour">--</span><span class="ac-tl">ساعة</span></div>
                        <div class="ac-tu"><span class="ac-tn min">--</span><span class="ac-tl">دقيقة</span></div>
                        <div class="ac-tu"><span class="ac-tn sec">--</span><span class="ac-tl">ثانية</span></div>
                    </div>
                    <a href="{{ route('brands.auction.show', $auction) }}" class="ac-bid-btn">
                        <i class="fa fa-gavel"></i> عرض المزاد والمزايدة
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state" style="background:rgba(255,255,255,.05);border-radius:20px;border:1px solid rgba(255,255,255,.1);">
            <i class="fas fa-gavel" style="color:rgba(255,255,255,.2);"></i>
            <h3 style="color:rgba(255,255,255,.6);">لا توجد مزادات نشطة حالياً</h3>
            <p style="color:rgba(255,255,255,.35);">تابعنا لمعرفة المزادات القادمة.</p>
        </div>
        @endif

        {{-- Ended Auctions --}}
        @if($endedAuctions->isNotEmpty())
        <div class="ended-section">
            <h3><i class="fas fa-history"></i> مزادات منتهية مؤخراً</h3>
            <div class="ended-grid">
                @foreach($endedAuctions as $ended)
                <div class="ended-card">
                    <div class="ended-logo">
                        @if($ended->brand->logo_url)
                            <img src="{{ $ended->brand->logo_url }}" alt="{{ $ended->brand->name }}">
                        @else
                            {{ mb_substr($ended->brand->name,0,2) }}
                        @endif
                    </div>
                    <div>
                        <div class="ended-name">{{ $ended->brand->name }}</div>
                        <div class="ended-price">{{ number_format($ended->current_bid) }} ر.س</div>
                        <span class="ended-badge">{{ $ended->bids_count }} مزايدة</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- ═══════════ FOOTER CTA ═══════════ --}}
<section style="background:#f5f7fa;padding:56px 24px;text-align:center;">
    <div style="max-width:680px;margin:0 auto;background:#fff;border-radius:24px;padding:44px 36px;box-shadow:0 4px 24px rgba(0,0,0,.07);border:1.5px solid #e2e8f0;">
        <h2 style="font-size:clamp(18px,2.5vw,28px);font-weight:900;color:#0d2448;margin:0 0 10px;">ابدأ رحلتك اليوم</h2>
        <p style="font-size:14px;color:#64748b;margin:0 0 24px;line-height:1.8;">سواء كنت مستثمراً أو صاحب علامة — منصتنا تربطك بالفرصة المناسبة.</p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="/contact" style="display:inline-flex;align-items:center;gap:8px;background:#0d2448;color:#fff;padding:12px 26px;border-radius:12px;font-weight:800;font-size:14px;text-decoration:none;">
                <i class="fa fa-store"></i> سجّل علامتك للامتياز أو المزاد
            </a>
            <a href="/register" style="display:inline-flex;align-items:center;gap:8px;border:1.5px solid #0d2448;color:#0d2448;padding:12px 26px;border-radius:12px;font-weight:800;font-size:14px;text-decoration:none;">
                <i class="fa fa-user-plus"></i> سجّل كمستثمر
            </a>
        </div>
    </div>
</section>

@include('partials.public_footer')

{{-- FRANCHISE APPLY MODAL --}}
<div class="modal-overlay" id="applyModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeApplyModal()"><i class="fa fa-times"></i></button>
        <div class="modal-header">
            <h3><i class="fa fa-handshake"></i> طلب الامتياز</h3>
            <p id="applyBrandName">اسم العلامة</p>
        </div>
        <div class="modal-body">
            <div id="franchiseStepsArea"></div>
            <p style="font-size:11px;font-weight:700;color:rgba(255,255,255,.5);margin:0 0 12px;letter-spacing:.5px;">بيانات المتقدم</p>
            <form id="applyForm" onsubmit="submitApply(event)">
                @csrf
                <input type="hidden" name="opportunity_id" id="applyOpportunityId">
                <input type="hidden" name="brand_name" id="applyBrandNameInput">
                <div class="form-row">
                    <div class="form-group"><label>الاسم الكامل</label><input type="text" name="full_name" required placeholder="اسمك الكامل"></div>
                    <div class="form-group"><label>رقم الجوال</label><input type="tel" name="phone" required placeholder="05XXXXXXXX"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>البريد الإلكتروني</label><input type="email" name="email" required placeholder="email@example.com"></div>
                    <div class="form-group">
                        <label>المنطقة</label>
                        <select name="region" required>
                            <option value="">اختر...</option>
                            <option>الرياض</option><option>جدة</option><option>مكة المكرمة</option>
                            <option>المدينة المنورة</option><option>الدمام</option><option>الأحساء</option><option>أبها</option><option>أخرى</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>رأس المال المتاح</label>
                        <select name="capital_range" required>
                            <option value="">اختر...</option>
                            <option>أقل من 100,000</option><option>100,000 — 300,000</option>
                            <option>300,000 — 750,000</option><option>أكثر من 750,000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>خبرة سابقة؟</label>
                        <select name="has_experience"><option value="1">نعم</option><option value="0" selected>لا</option></select>
                    </div>
                </div>
                <div class="form-group"><label>ملاحظات (اختياري)</label><textarea name="notes" rows="2" placeholder="أي معلومات إضافية..."></textarea></div>
                <button type="submit" class="modal-submit" id="applySubmitBtn"><i class="fa fa-paper-plane"></i> إرسال الطلب</button>
            </form>
        </div>
    </div>
</div>

{{-- AGENCY INQUIRY MODAL --}}
<div class="modal-overlay" id="agencyModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeAgencyModal()"><i class="fa fa-times"></i></button>
        <div class="modal-header">
            <h3><i class="fas fa-building"></i> طلب التواصل</h3>
            <p id="agencyModalName">اسم الوكالة</p>
        </div>
        <div class="modal-body">
            <form id="agencyForm" onsubmit="submitAgencyInquiry(event)">
                @csrf
                <input type="hidden" name="agency_id" id="agencyInquiryId">
                <input type="hidden" name="agency_name" id="agencyInquiryName">
                <div class="form-row">
                    <div class="form-group"><label>الاسم الكامل</label><input type="text" name="full_name" required placeholder="اسمك الكامل"></div>
                    <div class="form-group"><label>رقم الجوال</label><input type="tel" name="phone" required placeholder="05XXXXXXXX"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>البريد الإلكتروني</label><input type="email" name="email" required placeholder="email@example.com"></div>
                    <div class="form-group">
                        <label>المنطقة</label>
                        <select name="region" required>
                            <option value="">اختر...</option>
                            <option>الرياض</option><option>جدة</option><option>مكة المكرمة</option>
                            <option>المدينة المنورة</option><option>الدمام</option><option>الأحساء</option><option>أبها</option><option>أخرى</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label>رسالتك</label><textarea name="message" rows="3" required placeholder="أخبرنا عن خلفيتك واهتمامك بهذه الوكالة..."></textarea></div>
                <button type="submit" class="modal-submit" id="agencySubmitBtn"><i class="fa fa-paper-plane"></i> إرسال الطلب</button>
            </form>
        </div>
    </div>
</div>

{{-- Franchise steps data for JS --}}
<script>
const franchiseData = {
    @foreach($franchiseOpportunities as $opp)
    {{ $opp->id }}: {
        name: "{{ addslashes($opp->name) }}",
        steps: [
            @foreach($opp->steps as $step)
            { title: "{{ addslashes($step->title) }}", desc: "{{ addslashes($step->description ?? '') }}", icon: "{{ $step->icon }}" },
            @endforeach
        ]
    },
    @endforeach
};
</script>

<script src="https://cdn.jsdelivr.net/npm/three@0.158.0/build/three.min.js"></script>
<script>
/* THREE.JS PARTICLES */
(function(){
    const c=document.getElementById('bg-canvas'); if(!c||!window.THREE)return;
    const sc=new THREE.Scene(),cam=new THREE.PerspectiveCamera(60,innerWidth/innerHeight,.1,1000);
    cam.position.z=14;
    const r=new THREE.WebGLRenderer({canvas:c,alpha:true,antialias:true});
    r.setSize(innerWidth,innerHeight); r.setClearColor(0,0);
    const N=60,g=new THREE.BufferGeometry(),pos=new Float32Array(N*3),vel=[];
    for(let i=0;i<N;i++){pos[i*3]=(Math.random()-.5)*28;pos[i*3+1]=(Math.random()-.5)*28;pos[i*3+2]=0;vel.push({x:(Math.random()-.5)*.008,y:(Math.random()-.5)*.008});}
    g.setAttribute('position',new THREE.BufferAttribute(pos,3));
    sc.add(new THREE.Points(g,new THREE.PointsMaterial({color:0x38bdf8,size:.07,transparent:true,opacity:.25})));
    (function loop(){requestAnimationFrame(loop);for(let i=0;i<N;i++){pos[i*3]+=vel[i].x;pos[i*3+1]+=vel[i].y;if(Math.abs(pos[i*3])>14)vel[i].x*=-1;if(Math.abs(pos[i*3+1])>14)vel[i].y*=-1;}g.attributes.position.needsUpdate=true;r.render(sc,cam);})();
    window.addEventListener('resize',()=>{cam.aspect=innerWidth/innerHeight;cam.updateProjectionMatrix();r.setSize(innerWidth,innerHeight);});
})();

/* SECTION SWITCHING */
function switchSection(name, btn) {
    document.querySelectorAll('.ba-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.sec-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('sec-' + name).classList.add('active');
    if (btn) btn.classList.add('active');
    const tabs = document.getElementById('sectionTabs');
    if (tabs) window.scrollTo({top: tabs.offsetTop - 10, behavior:'smooth'});
    history.replaceState(null, '', '?section=' + name);
}

/* FRANCHISE CATEGORY FILTER */
function filterFC(cat, btn) {
    document.querySelectorAll('#fcCatFilter .cat-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#fcGrid .fc-card').forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.fcCat === cat) ? '' : 'none';
    });
}

/* AGENCY CATEGORY FILTER */
function filterAgencies(cat, btn) {
    document.querySelectorAll('#agCatFilter .cat-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#agGrid .agency-card').forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.agCat === cat) ? '' : 'none';
    });
}

/* BRAND CATEGORY FILTER */
function filterBrands(cat, btn) {
    document.querySelectorAll('#sec-brands .cat-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.brand-card').forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
    });
}

/* SEARCH */
document.getElementById('searchInput')?.addEventListener('input', function() {
    const q = this.value.trim().toLowerCase();
    document.querySelectorAll('.brand-card').forEach(card => {
        const name = (card.dataset.name||'').toLowerCase();
        const en   = (card.dataset.nameen||'').toLowerCase();
        card.style.display = (!q || name.includes(q) || en.includes(q)) ? '' : 'none';
    });
    document.querySelectorAll('.agency-card').forEach(card => {
        const name = (card.dataset.agName||'').toLowerCase();
        card.style.display = (!q || name.includes(q)) ? '' : 'none';
    });
});

/* FRANCHISE APPLY MODAL (brand cards / inline apply) */
function openApplyModal(name, investment) {
    document.getElementById('applyBrandName').textContent = name + (investment ? ' — ' + investment : '');
    document.getElementById('applyBrandNameInput').value = name;
    document.getElementById('applyOpportunityId').value = '';
    document.getElementById('franchiseStepsArea').innerHTML = '';
    document.getElementById('applyModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeApplyModal() {
    document.getElementById('applyModal').classList.remove('open');
    document.body.style.overflow = '';
    document.getElementById('applyForm').reset();
    document.getElementById('franchiseStepsArea').innerHTML = '';
}

/* FRANCHISE OPPORTUNITY MODAL (DB-driven with steps) */
function openFranchiseModal(id) {
    const data = (typeof franchiseData !== 'undefined') ? franchiseData[id] : null;
    if (!data) { openApplyModal('امتياز #'+id); return; }
    document.getElementById('applyBrandName').textContent = data.name;
    document.getElementById('applyBrandNameInput').value = data.name;
    document.getElementById('applyOpportunityId').value = id;
    let stepsHtml = '';
    if (data.steps && data.steps.length) {
        stepsHtml = '<div style="margin-bottom:18px;padding-bottom:16px;border-bottom:1.5px solid rgba(255,255,255,.12);">';
        stepsHtml += '<p style="font-size:11px;font-weight:700;color:rgba(255,255,255,.5);margin:0 0 10px;letter-spacing:.5px;">خطوات التقديم</p>';
        stepsHtml += '<div style="display:flex;flex-direction:column;gap:8px;">';
        data.steps.forEach((s,i) => {
            stepsHtml += `<div style="display:flex;gap:10px;align-items:flex-start;">
                <div style="min-width:26px;height:26px;border-radius:50%;background:rgba(245,158,11,.2);border:1.5px solid rgba(245,158,11,.4);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:11px;font-weight:900;flex-shrink:0;">${i+1}</div>
                <div><div style="font-size:13px;font-weight:700;color:#fff;">${s.title}</div>${s.desc?'<div style="font-size:11px;color:rgba(255,255,255,.5);margin-top:1px;">'+s.desc+'</div>':''}</div>
            </div>`;
        });
        stepsHtml += '</div></div>';
    }
    document.getElementById('franchiseStepsArea').innerHTML = stepsHtml;
    document.getElementById('applyModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

async function submitApply(e) {
    e.preventDefault();
    const btn = document.getElementById('applySubmitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> جارٍ الإرسال...';
    try {
        const res = await fetch('{{ route("franchise.apply") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('[name=_token]').value, 'Accept': 'application/json' },
            body: new FormData(e.target),
        });
        const data = await res.json();
        if (data.success) {
            btn.innerHTML = '<i class="fa fa-check-circle"></i> تم إرسال الطلب بنجاح!';
            btn.style.background = 'linear-gradient(135deg,#059669,#34d399)';
            setTimeout(closeApplyModal, 2500);
        } else {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-paper-plane"></i> إرسال الطلب';
            alert(data.message || 'حدث خطأ، حاول مرة أخرى');
        }
    } catch(err) {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-paper-plane"></i> إرسال الطلب';
    }
}

document.getElementById('applyModal').addEventListener('click', function(e) { if(e.target===this) closeApplyModal(); });

/* AGENCY INQUIRY MODAL */
function openAgencyModal(name, id) {
    document.getElementById('agencyModalName').textContent = name;
    document.getElementById('agencyInquiryId').value = id;
    document.getElementById('agencyInquiryName').value = name;
    document.getElementById('agencyModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeAgencyModal() {
    document.getElementById('agencyModal').classList.remove('open');
    document.body.style.overflow = '';
    document.getElementById('agencyForm').reset();
}
async function submitAgencyInquiry(e) {
    e.preventDefault();
    const btn = document.getElementById('agencySubmitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> جارٍ الإرسال...';
    setTimeout(() => {
        btn.innerHTML = '<i class="fa fa-check-circle"></i> تم إرسال طلبك بنجاح!';
        btn.style.background = 'linear-gradient(135deg,#059669,#34d399)';
        setTimeout(closeAgencyModal, 2500);
    }, 800);
}
document.getElementById('agencyModal').addEventListener('click', function(e) { if(e.target===this) closeAgencyModal(); });

/* AUCTION COUNTDOWNS */
document.querySelectorAll('.ac-timer[data-end]').forEach(el => {
    const end = new Date(el.dataset.end).getTime();
    function tick() {
        const diff = end - Date.now();
        if (diff <= 0) { el.innerHTML='<span style="color:#ef4444;font-size:13px;font-weight:700;">انتهى المزاد</span>'; return; }
        const d=Math.floor(diff/86400000),h=Math.floor(diff%86400000/3600000),m=Math.floor(diff%3600000/60000),s=Math.floor(diff%60000/1000);
        el.querySelector('.day').textContent  = String(d).padStart(2,'0');
        el.querySelector('.hour').textContent = String(h).padStart(2,'0');
        el.querySelector('.min').textContent  = String(m).padStart(2,'0');
        el.querySelector('.sec').textContent  = String(s).padStart(2,'0');
    }
    tick(); setInterval(tick,1000);
});

/* SLIDER */
@if($sliders->count() > 1)
let currentSlide = 0;
const totalSlides = {{ $sliders->count() }};
function goSlide(n) {
    document.querySelectorAll('.slide').forEach((s,i) => s.classList.toggle('active', i===n));
    document.querySelectorAll('.slider-dot').forEach((d,i) => d.classList.toggle('active', i===n));
    currentSlide = n;
}
function sliderMove(dir) { goSlide((currentSlide + dir + totalSlides) % totalSlides); }
setInterval(() => sliderMove(1), 5000);
@endif

/* SCROLL REVEAL */
const revObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){e.target.classList.add('visible');revObs.unobserve(e.target);} });
}, { threshold:0.08 });
document.querySelectorAll('.reveal').forEach(el => revObs.observe(el));
</script>
</body>
</html>
