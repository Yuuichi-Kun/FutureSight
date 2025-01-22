<header>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Nav Item - Messages -->
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
            <h6 class="dropdown-header">
                Message Center
            </h6>
            @foreach(auth()->user()->unreadMessages()->take(5)->get() as $message)
                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.messages.show', $message->sender) }}">
                    <div class="dropdown-list-image mr-3">
                        @if($message->sender->avatar)
                            <img class="rounded-circle" src="/avatars/{{ $message->sender->avatar }}"
                                style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                            <img class="rounded-circle" src="{{ asset('/img/default_profile.png') }}"
                                style="width: 40px; height: 40px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate {{ $message->is_system_message ? 'text-danger' : '' }}">
                            {{ Str::limit($message->content, 50) }}
                        </div>
                        <div class="small text-gray-500">{{ $message->sender->name }} · {{ $message->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @endforeach
            <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.messages.index') }}">
                Read More Messages
            </a>
        </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
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
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->
</header>