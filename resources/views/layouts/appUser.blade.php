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

    <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('css/special-nav.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-primary text-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}">
            <box-icon name='chevron-left'></box-icon><h3>Get back to Homepage</h3>
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        <main class="" style="padding: 10px;">
            <div class="">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
