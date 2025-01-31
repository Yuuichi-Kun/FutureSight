<header class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo" style="margin-left: 10px;">
                <span class="h3 mb-0 font-weight-bold text-primary">Future</span><span class="h3 mb-0">sight.</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarContent">
                <i class='bx bx-menu h3 mb-0 text-primary'></i>
            </button>

            <!-- Main Menu -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item px-2">
                        <a href="{{ route('alumni.register') }}" 
                           class="nav-link {{ request()->routeIs('alumni.register') ? 'active font-weight-bold text-primary' : 'text-gray-600' }}">
                           Daftar Alumni
                        </a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="{{ route('questionnaire.index') }}" 
                           class="nav-link {{ request()->routeIs('questionnaire.index') ? 'active font-weight-bold text-primary' : 'text-gray-600' }}">
                           Isi Kuisioner
                        </a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="{{ route('forum.index') }}" 
                           class="nav-link {{ request()->routeIs('forum.*') ? 'active font-weight-bold text-primary' : 'text-gray-600' }}">
                           Forum
                        </a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="{{ route('school.profile') }}" 
                           class="nav-link {{ request()->routeIs('school.profile') ? 'active font-weight-bold text-primary' : 'text-gray-600' }}">
                           Profile Sekolah
                        </a>
                    </li>

                    @auth
                        <!-- Messages Dropdown -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle p-2" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown">
                                <i class="fas fa-envelope fa-fw"></i>
                                @if(auth()->user()->unreadMessages()->count() > 0)
                                    <span class="badge badge-danger badge-counter">
                                        {{ auth()->user()->unreadMessages()->count() }}
                                    </span>
                                @endif
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-sm animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header bg-primary border-0">
                                    Message Center
                                </h6>
                                @foreach(auth()->user()->unreadMessages()->take(5)->get() as $message)
                                    <a class="dropdown-item d-flex align-items-center py-3" href="{{ route('messages.show', $message->sender) }}">
                                        <div class="mr-3">
                                            <img class="rounded-circle" 
                                                 src="{{ $message->sender->avatar ? '/avatars/'.$message->sender->avatar : asset('/img/default_profile.png') }}"
                                                 style="width: 45px; height: 45px; object-fit: cover;">
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">{{ Str::limit($message->content, 30) }}</div>
                                            <div class="small text-gray-500">
                                                {{ $message->sender->name }} · {{ $message->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                <a class="dropdown-item text-center small text-gray-500 py-3" href="{{ route('messages.index') }}">
                                    Read More Messages
                                </a>
                            </div>
                        </li>

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown no-arrow ml-3">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown">
                                <span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="rounded-circle" 
                                     src="{{ Auth::user()->avatar ? '/avatars/'.Auth::user()->avatar : asset('/img/default_profile.png') }}"
                                     style="width: 40px; height: 40px; object-fit: cover;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm animated--grow-in">
                                <a class="dropdown-item" href="{{ route('profileUser.edit') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item ml-3">
                            <a href="{{ route('login') }}" 
                               class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold">
                               Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
:root {
    --navbar-height: 80px; /* Sesuaikan dengan tinggi navbar Anda */
}

body {
    padding-top: var(--navbar-height);
}

.navbar {
    height: var(--navbar-height);
    padding: 0;
    transition: all 0.3s ease;
}

.navbar .nav-link {
    position: relative;
    transition: all 0.3s ease;
}

.navbar .nav-link:hover {
    color: var(--primary) !important;
}

.navbar .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: var(--primary);
}

.dropdown-menu {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.badge-counter {
    position: absolute;
    transform: scale(0.7);
    transform-origin: top right;
    right: 0;
    top: 0;
}

/* Animasi untuk dropdown */
.animated--grow-in {
    animation-name: growIn;
    animation-duration: 200ms;
    animation-timing-function: transform cubic-bezier(0.18, 1.25, 0.4, 1), opacity cubic-bezier(0, 1, 0.4, 1);
}

@keyframes growIn {
    0% {
        transform: scale(0.9);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Menyesuaikan navbar untuk mobile */
@media (max-width: 992px) {
    :root {
        --navbar-height: 70px; /* Navbar lebih pendek di mobile */
    }
    
    body {
        padding-top: var(--navbar-height);
    }

    .navbar-collapse {
        position: absolute;
        top: var(--navbar-height);
        left: 0;
        right: 0;
        background: white;
        padding: 1rem;
        border-radius: 0 0 0.5rem 0.5rem;
        margin-top: 0;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .navbar .nav-item {
        padding: 0.5rem 0;
    }
}
</style>