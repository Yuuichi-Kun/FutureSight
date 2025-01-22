<header>
    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="{{ route('home') }}" class="logo">Future<span>sight.</span></a>
            <div class="menu-wrapper">
                <ul class="menu">
                    <li class="menu-item">
                        <a href="{{ route('alumni.register') }}" class="menu-link {{ request()->routeIs('alumni.register') ? 'active' : '' }}">Daftar Alumni</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('questionnaire.index') }}" class="menu-link {{ request()->routeIs('questionnaire.index') ? 'active' : '' }}">Isi Kuisioner</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('forum.index') }}" class="menu-link {{ request()->routeIs('forum.*') ? 'active' : '' }}">Forum</a>
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
                    <!-- Messages Dropdown -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            @if(auth()->user()->unreadMessages()->count() > 0)
                                <span class="badge badge-danger badge-counter" style="font-size: 0.65rem; padding: 0.2rem 0.4rem;">
                                    {{ auth()->user()->unreadMessages()->count() }}
                                </span>
                            @endif
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="messagesDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                            <h6 class="dropdown-header" style="font-size: 0.8rem;">
                                Message Center
                            </h6>
                            @foreach(auth()->user()->unreadMessages()->take(5)->get() as $message)
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('messages.show', $message->sender) }}">
                                    <div class="mr-2" style="width: 40px;">
                                        @if($message->sender->avatar)
                                            <img class="rounded-circle" src="/avatars/{{ $message->sender->avatar }}" 
                                                 style="width: 35px; height: 35px; object-fit: cover;">
                                        @else
                                            <img class="rounded-circle" src="{{ asset('/img/default_profile.png') }}"
                                                 style="width: 35px; height: 35px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="text-truncate" style="max-width: 200px;">
                                        <div class="small font-weight-bold mb-1">{{ $message->sender->name }}</div>
                                        <div class="small text-truncate {{ $message->is_system_message ? 'text-danger' : 'text-gray-500' }}">
                                            {{ Str::limit($message->content, 30) }}
                                        </div>
                                        <div class="small text-gray-500">{{ $message->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500 py-2" href="{{ route('messages.index') }}">
                                Read More Messages
                            </a>
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