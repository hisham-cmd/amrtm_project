{{--
    Right-side fixed icon navigation bar.
    Include once per page: @include('partials.sidebar_nav')
--}}
<style>
    .side-nav {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        z-index: 500;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        background: linear-gradient(180deg, #0f3d24 0%, #1a5c38 100%);
        border-radius: 18px 0 0 18px;
        padding: 14px 8px;
        box-shadow: -4px 0 24px rgba(15,61,36,.28);
        border: 1px solid rgba(255,255,255,.10);
        border-right: none;
    }

    .sn-item {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        color: rgba(255,255,255,.55);
        font-size: 18px;
        text-decoration: none;
        transition: background .18s, color .18s, transform .18s;
        border: none;
        background: transparent;
        cursor: pointer;
        font-family: 'Cairo', sans-serif;
        flex-shrink: 0;
    }
    .sn-item:hover {
        background: rgba(255,255,255,.14);
        color: #fff;
        transform: translateX(-3px);
    }
    .sn-item.active {
        background: rgba(167,243,208,.18);
        color: #a7f3d0;
    }
    .sn-item.soon {
        opacity: .32;
        cursor: default;
        pointer-events: none;
    }

    /* Tooltip — appears to the left */
    .sn-item::before {
        content: attr(data-tip);
        position: absolute;
        right: calc(100% + 12px);
        top: 50%;
        transform: translateY(-50%);
        background: #071f12;
        color: #a7f3d0;
        font-family: 'Cairo', sans-serif;
        font-size: 11.5px;
        font-weight: 700;
        white-space: nowrap;
        padding: 5px 12px;
        border-radius: 10px;
        pointer-events: none;
        opacity: 0;
        transition: opacity .15s, transform .15s;
        z-index: 501;
        border: 1px solid rgba(167,243,208,.22);
        box-shadow: 0 4px 14px rgba(0,0,0,.22);
        transform: translateY(-50%) translateX(4px);
    }
    .sn-item:hover::before {
        opacity: 1;
        transform: translateY(-50%) translateX(0);
    }

    /* Arrow pointing right toward the icon */
    .sn-item::after {
        content: '';
        position: absolute;
        right: calc(100% + 7px);
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-left-color: #071f12;
        pointer-events: none;
        opacity: 0;
        transition: opacity .15s;
        z-index: 501;
    }
    .sn-item:hover::after { opacity: 1; }

    .sn-sep {
        width: 28px;
        height: 1px;
        background: rgba(255,255,255,.15);
        margin: 4px 0;
        flex-shrink: 0;
    }

    /* Logo dot at top */
    .sn-logo {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        overflow: hidden;
        background: #fff;
        border: 2px solid rgba(255,255,255,.4);
        margin-bottom: 6px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,.2);
        transition: transform .2s;
    }
    .sn-logo:hover { transform: scale(1.08); }
    .sn-logo img {
        width: 28px;
        height: 28px;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .side-nav { display: none; }
    }
</style>

<nav class="side-nav" aria-label="{{ __('nav.browse') }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @php $cp = request()->path(); @endphp

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="sn-logo" title="{{ __('nav.home') }}">
        <img src="/images/new-logo1.png" alt="أمر تم">
    </a>

    <div class="sn-sep"></div>

    {{-- Home --}}
    <a href="{{ url('/') }}"
       class="sn-item {{ $cp === '/' ? 'active' : '' }}"
       data-tip="{{ __('nav.home') }}">
        <i class="fa fa-house"></i>
    </a>

    {{-- Halls --}}
    <a href="{{ url('/halls_list') }}"
       class="sn-item {{ in_array($cp, ['venues','halls_list']) || str_starts_with($cp, 'halls') ? 'active' : '' }}"
       data-tip="{{ __('halls.halls') }}">
        <i class="fa fa-building"></i>
    </a>

    {{-- Chalets (soon) --}}
    <span class="sn-item soon" data-tip="{{ __('halls.chalets') }} — {{ app()->getLocale() === 'ar' ? 'قريباً' : 'Soon' }}">
        <i class="fa fa-water"></i>
    </span>

    {{-- Rest houses (soon) --}}
    <span class="sn-item soon" data-tip="{{ __('halls.rest_houses') }} — {{ app()->getLocale() === 'ar' ? 'قريباً' : 'Soon' }}">
        <i class="fa fa-tree"></i>
    </span>
    
    {{-- Partners/Services --}}
        <a href="{{ url('/partners') }}"
       class="sn-item {{ in_array($cp, ['partners','services']) || str_starts_with($cp, 'partners') ? 'active' : '' }}"
       data-tip="{{ __('halls.partner_services') }}">
        <i class="fa fa-handshake"></i>
    </a>

    <div class="sn-sep"></div>

    {{-- Dashboard / Login --}}
    @auth
        @php
            $role = Auth::user()->role->value;
            $dashRoute = match($role) {
                'supervisor' => route('supervisor.dashboard'),
                'manager'    => route('manager.dashboard'),
                'agent'      => route('agent.dashboard'),
                'owner'      => route('owner.dashboard'),
                default      => null,
            };
        @endphp
        @if($dashRoute)
        <a href="{{ $dashRoute }}"
           class="sn-item {{ str_contains($cp, 'dashboard') ? 'active' : '' }}"
           data-tip="{{ __('header.dashboard') }}">
            <i class="fa fa-table-columns"></i>
        </a>
        @endif
    @else
        <a href="{{ route('login') }}"
           class="sn-item {{ $cp === 'login' ? 'active' : '' }}"
           data-tip="{{ __('header.login') }}">
            <i class="fa fa-right-to-bracket"></i>
        </a>
    @endauth

    <div class="sn-sep"></div>

    {{-- Contact --}}
    <a href="{{ url('/contact') }}"
       class="sn-item {{ $cp === 'contact' ? 'active' : '' }}"
       data-tip="{{ __('header.contact') }}">
        <i class="fa fa-headset"></i>
    </a>
</nav>
