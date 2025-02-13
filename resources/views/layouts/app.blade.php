<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FutureSight') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('css/special-nav.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .profile-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.2s;
        }

        .profile-section:hover {
            transform: translateY(-2px);
        }

        .section-header {
            border-bottom: 2px solid #f3f4f6;
            padding: 1rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .current-avatar {
            border-radius: 50%;
            border: 3px solid #e5e7eb;
            transition: border-color 0.2s;
        }

        .current-avatar:hover {
            border-color: #3b82f6;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-weight: 500;
            transition: opacity 0.2s;
            text-decoration: none;
        }

        .back-button:hover {
            opacity: 0.9;
            color: white;
        }

        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .nav-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }

        .btn-custom {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .btn-custom:hover {
            background-color: #2563eb;
        }

        .navbar {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
        }

        .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: opacity 0.2s;
        }

        .nav-link:hover {
            opacity: 0.9;
        }

        main {
            min-height: calc(100vh - 70px);
            background-color: #f3f4f6;
            padding: 2rem 0;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="app">
        <!-- Navbar -->
        <nav class="text-white shadow-sm navbar navbar-expand-md navbar-light bg-primary">
        <div class="container-fluid">
            <a class="text-white navbar-brand fw-bold" href="{{ route('admin.home') }}">
            <box-icon name='chevron-left'></box-icon><h3>Get back to Dashboard</h3>
            </a>
            <button class="text-white navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="text-white nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="text-white nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a id="navbarDropdown" class="text-white nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="d-flex align-items-center">
                                @if(Auth::user()->avatar)
                                    <img class="rounded-circle me-2" src="/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px; object-fit:cover;">
                                @else
                                    <img class="rounded-circle me-2" src="{{ asset('/img/default_profile.png') }}" style="width:40px; height:40px; object-fit:cover;">
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

        <!-- Main Content -->
        <main class="" style="padding: 10px; background-color: #D0FFF4;">
            <div class="">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
