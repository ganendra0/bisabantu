<header class="header" id="header">
    <a href="{{ url('/') }}" class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"/>
        </svg>
        <span class="logo-text">Donasi Sosial</span>
    </a>
    
    {{-- NAVIGASI DESKTOP --}}
    <nav class="nav">
        <a href="{{ url('/') }}" class="nav-link">Beranda</a>
        <a href="{{ url('/donasi') }}" class="nav-link">Kampanye</a>
        <a href="{{ url('/donatur') }}" class="nav-link">List Donatur</a>
        
        {{-- LOGIKA LOGIN/LOGOUT UNTUK DESKTOP --}}
        @if (Auth::check())
            <div class="nav-dropdown">
                <a href="#" class="nav-link user-menu-trigger">{{ ucwords(Auth::user()->username) }}</a>
                <div class="dropdown-content">
                    @if (Auth::user()->jenisAkun === 'admin')
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @endif
                    <a href="{{ url('/session/logout') }}">Logout</a>
                </div>
            </div>
        @else
            <a href="{{ url('/session') }}" class="nav-link btn-login">Login</a>
        @endif
    </nav>

    <div class="mobile-menu-toggle" id="mobileMenuToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

{{-- NAVIGASI MOBILE --}}
<nav class="mobile-nav" id="mobileNav">
    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
    <a href="{{ url('/donasi') }}" class="nav-link">Kampanye</a>
    <a href="{{ url('/donatur') }}" class="nav-link">List Donatur</a>

    {{-- LOGIKA LOGIN/LOGOUT UNTUK MOBILE --}}
    @if (Auth::check())
        <div class="nav-dropdown-mobile">
            <span class="nav-link">{{ ucwords(Auth::user()->username) }}</span>
            @if (Auth::user()->jenisAkun === 'admin')
                <a href="{{ url('/dashboard') }}" class="nav-link sub-link">Dashboard</a>
            @endif
            <a href="{{ url('/session/logout') }}" class="nav-link sub-link">Logout</a>
        </div>
    @else
        <a href="{{ url('/login') }}" class="nav-link btn-login">Login</a>
    @endif
</nav>