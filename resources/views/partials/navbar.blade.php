<header>
    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('home') }}" class="logo">Otaku<span>space</span></a>
            <div class="menu-wrapper">
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('home') }}" class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}">Isi Kuisioner</a></li>
                </ul>
                @auth
                    <!-- Jika user sudah login -->
                    <div class="user-profile">
                        @if(Auth::user()->avatar)
                            <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
                        @else
                            <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                        @endif
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                @else
                    <!-- Jika user belum login -->
                    <a href="{{ route('login') }}" class="btn-member">Login</a>
                @endauth
            </div>
            <div class="menu-toggle bx bxs-grid-alt"></div>
        </div>
    </nav>
</header>