<header>
    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('home') }}" class="logo">Otaku<span>space</span></a>
            <div class="menu-wrapper">
                <ul class="menu">
                    <li class="menu-item">
                        <a href="{{ route('home') }}" class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}">Isi Kuisioner</a>
                    </li>
                    @auth
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->avatar)
                                <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
                            @else
                                <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profileUser.edit') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="menu-item">
                        <a href="{{ route('login') }}" class="btn-member">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
            <div class="menu-toggle bx bxs-grid-alt"></div>
        </div>
    </nav>
</header>