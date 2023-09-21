<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <link href="/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="/css/selectize.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    <style>
        /* Gaya navbar */

        /* Logo di tengah */
        .navbar-logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    {{-- NAVBAR USER --}}
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <!-- Logo di tengah -->
                {{-- <a class="navbar-logo" href="#">
                    <img src="https://o.remove.bg/downloads/4d24f093-c9a4-4eee-b9f5-ea92f318648b/logo1-removebg-preview.png" alt="Admin Logo" width="60">
                </a> --}}
                <!-- Menu di sebelah kiri menggunakan dropdown -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="menuDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 9.5H3M21 4.5H3M21 14.5H3M17 19.5H3" />
                            </svg>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menuDropdown">
                            <a class="dropdown-item" href="{{ url('/') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9" />
                                    <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6" />
                                </svg> Home</a>
                            @if (Auth::check())
                                <a class="dropdown-item" href="{{ url('/home') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21.5 12H16c-.7 2-2 3-4 3s-3.3-1-4-3H2.5" />
                                        <path
                                            d="M5.5 5.1L2 12v6c0 1.1.9 2 2 2h16a2 2 0 002-2v-6l-3.4-6.9A2 2 0 0016.8 4H7.2a2 2 0 00-1.8 1.1z" />
                                    </svg> Dashboard</a>
                            @endif
                            @role('admin')
                                <a class="dropdown-item" href="{{ route('authors.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg> Penulis
                                </a>
                                <a class="dropdown-item" href="{{ route('books.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Buku
                                </a>
                                <a class="dropdown-item" href="{{ route('members.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Member
                                </a>
                                <a class="dropdown-item" href="{{ route('statistics.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Peminjam
                                </a>
                            @endrole
                        </div>
                    </li>
                </ul>
                <!-- Profil admin di sebelah kanan -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        @guest
                            @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                {{-- <li><a href="{{ url('/settings/password') }}"><i class="fa fa-btn fa-lock"></i> Ubah Password</a></li> --}}
                                @if (auth()->check())
                                    <a class="dropdown-item" href="{{ url('/settings/profile') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                                            <circle cx="12" cy="10" r="3" />
                                            <circle cx="12" cy="12" r="10" />
                                        </svg> Profil</a>
                                @endif
                                <a class="dropdown-item" href="{{ url('/settings/password') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg> Ubah Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9" />
                                    </svg> {{ __(' Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    </li>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @include('layouts._flash')
            @yield('content')
        </main>

    {{-- @role('admin')
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name1', 'Home') }}
                        </a>
                        @if (Auth::check())
                            <a class="navbar-brand" href="{{ url('/home') }}">
                                {{ config('app.name1', 'Dashboard') }}
                            </a>


                            @role('admin')
                                <a class="navbar-brand" href="{{ route('authors.index') }}">
                                    {{ config('app.name2', 'Penulis') }}
                                </a>
                                <a class="navbar-brand" href="{{ route('books.index') }}">
                                    {{ config('app.name3', 'Buku') }}
                                </a>
                                <a class="navbar-brand" href="{{ route('members.index') }}">
                                    {{ config('app.name4', 'Member') }}
                                </a>
                                <a class="navbar-brand" href="{{ route('statistics.index') }}">
                                    {{ config('app.name5', 'Peminjam') }}
                                </a>
                            @endrole
                            @if (auth()->check())
                                <a class="navbar-brand" href="{{ url('/settings/profile') }}">
                                    {{ config('app.name4', 'Profil') }}
                                </a>
                            @endif
                        @endif

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        {{-- <li><a href="{{ url('/settings/password') }}"><i class="fa fa-btn fa-lock"></i> Ubah Password</a></li> --}}

                                        {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ url('/settings/password') }}">
                                            Ubah Password
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form> --}}
                                    {{-- </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @include('layouts._flash')
                @yield('content')
            </main>
        @endrole --}}

        
    </div>

    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/selectize.min.js"></script>
    <script src="/js/custom.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}
    @yield('scripts')
</body>

</html>
