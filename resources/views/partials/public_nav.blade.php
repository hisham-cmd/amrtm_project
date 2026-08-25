@php
    $locale = app()->getLocale();
    $isAr   = $locale === 'ar';
    $switchLocale = $isAr ? 'en' : 'ar';
@endphp

<nav class="public-nav" id="publicNav">
    <div class="nav-container">

        <a href="/" class="nav-logo">
            <img src="{{ asset('images/new-logo1.png') }}" alt="أمر تم">
        </a>

        <div class="nav-links" id="navLinks">
            <a href="/"           class="nav-link {{ request()->is('/')           ? 'active' : '' }}">{{ __('nav.home') }}</a>
            <a href="/about"      class="nav-link {{ request()->is('about')      ? 'active' : '' }}">{{ __('nav.about') }}</a>
            <a href="/projects"   class="nav-link {{ request()->is('projects')   ? 'active' : '' }}">{{ __('nav.projects') }}</a>
            @if(env('AGENCIES_ENABLED', false))
            <a href="/agencies"       class="nav-link {{ request()->is('agencies*')       ? 'active' : '' }}">{{ __('nav.agencies') }}</a>
            @endif
            <a href="/contact"    class="nav-link {{ request()->is('contact')    ? 'active' : '' }}">{{ __('nav.contact') }}</a>
        </div>

        <div class="nav-actions">
            {{-- Language Toggle Pill --}}
            <div class="lang-toggle">
                <a href="{{ route('lang.switch', 'ar') }}" class="{{ $isAr ? 'active' : '' }}">عربي</a>
                <span class="lang-divider"></span>
                <a href="{{ route('lang.switch', 'en') }}" class="{{ !$isAr ? 'active' : '' }}">EN</a>
            </div>
            @auth
                @php
                    $role = auth()->user()->role;
                    $dashUrl = $role === \App\Enums\UserRole::User
                        ? url('/halls_list')
                        : url('/' . $role->value . '/dashboard');
                @endphp
                <a href="{{ $dashUrl }}" class="nav-btn-primary">
                    <i class="fa fa-th-large"></i>
                    <span>{{ $role === \App\Enums\UserRole::User ? __('nav.browse') : __('nav.dashboard') }}</span>
                </a>
            @else
                <a href="/login" class="nav-btn-primary">
                    <i class="fa fa-sign-in-alt"></i> <span>{{ __('nav.login') }}</span>
                </a>
            @endauth
            <button class="nav-hamburger" id="navHamburger" aria-label="{{ __('nav.home') }}">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</nav>

<script>
(function(){
    const nav  = document.getElementById('publicNav');
    const ham  = document.getElementById('navHamburger');
    const links = document.getElementById('navLinks');

    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 30);
    });

    ham && ham.addEventListener('click', () => {
        ham.classList.toggle('open');
        links.classList.toggle('open');
    });

    // close on link click (mobile)
    links && links.querySelectorAll('.nav-link').forEach(l => {
        l.addEventListener('click', () => {
            ham && ham.classList.remove('open');
            links.classList.remove('open');
        });
    });

    // page enter animation
    document.body.classList.add('page-enter');
    requestAnimationFrame(() => requestAnimationFrame(() => document.body.classList.add('page-ready')));
})();
</script>
