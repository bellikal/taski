
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ auth()->check() ? route('dashboard') : url('/') }}">
            <h2><i class="fa-solid fa-thumbtack"></i> Taski</h2>
        </a>
    
        {{-- Navigations Links --}}
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mx-auto">
                
                @if (Route::has('login'))
                    @auth
                        {{-- Dashboard Link --}}
                        <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">Dashboard</a>
                        {{-- Tasks Link --}}
                        <a class="nav-link {{ Request::routeIs('tasks*') ? 'active' : '' }}"
                            href="{{ route('tasks.index') }}">Tasks</a>
                    @else
                        {{-- Home Link --}}
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    @endauth
                @endif
                {{-- About Link --}}
                <a class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}"
                    href="{{ route('about') }}">About</a>
                {{-- Kontakt Link --}}
                <a class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}"
                    href="{{ route('contact') }}">Contact</a>
            </div>

            <div class="navbar-nav ml-auto">
                {{-- Authentication Links für unangemeldete User --}}
                @if (Route::has('login'))
                    @guest
                        {{-- Login Link --}}
                        <a class="nav-link {{ Request::routeIs('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            {{-- Register Link --}}
                            <a class="nav-link {{ Request::routeIs('register') ? 'active' : '' }}"
                                href="{{ route('register') }}">Register</a>
                        @endif
                    @else
                        {{-- Logout Link --}}
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">Logout</a>
                    @endguest
                @endif
            </div>
            
        </div>
    </div>
</nav>

{{-- Logout Formular (Hidden) --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
