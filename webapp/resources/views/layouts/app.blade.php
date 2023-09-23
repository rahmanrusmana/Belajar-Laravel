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
</head>

<body>
    <!-- component -->
    <div class="h-screen w-full bg-white relative flex overflow-hidden">

        <!-- Sidebar -->
        <aside class="h-full w-16 flex flex-col space-y-5 items-center justify-center relative bg-gray-800 text-white">
            <!-- Profile -->
            <div
                class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                <a href="{{ url('/') }}">
                    <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                </a>
            </div>

            @if (Auth::check())
                <div
                    class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                    <a href="{{ url('/home') }}">
                        <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="12" cy="13" r="2" />
                            <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                            <path d="M6.4 20a9 9 0 1 1 11.2 0Z" />
                        </svg>
                    </a>
                </div>

                @role('admin')
                    <div class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                        <a class="" href="{{ route('authors.index') }}">
                            <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                            </svg>
                        </a>
                    </div>

                    <div
                        class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                        <a class="" href="{{ route('books.index') }}">
                            <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" />
                                <line x1="13" y1="8" x2="15" y2="8" />
                                <line x1="13" y1="12" x2="15" y2="12" />
                            </svg>
                        </a>
                    </div>

                    <div
                        class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                        <a class="" href="{{ route('members.index') }}">
                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                    </div>

                    <div
                        class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                        <a class="" href="{{ route('statistics.index') }}">
                            <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M8 13.5v-8a1.5 1.5 0 0 1 3 0v6.5m0 -6.5v-2a1.5 1.5 0 0 1 3 0v8.5m0 -6.5a1.5 1.5 0 0 1 3 0v6.5m0 -4.5a1.5 1.5 0 0 1 3 0v8.5a6 6 0 0 1 -6 6h-2a7 6 0 0 1 -5 -3l-2.7 -5.25a1.4 1.4 0 0 1 2.75 -2l.9 1.75" />
                            </svg>
                        </a>
                    </div>
                @endrole

                <div
                    class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                    <a href="{{ url('/settings/password') }}">
                        <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </a>
                </div>

                <div
                    class="h-10 w-10 flex items-center justify-center rounded-lg cursor-pointer hover:text-gray-800 hover:bg-gray-500  hover:duration-300 hover:ease-linear focus:bg-gray-500">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path
                                d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 12h14l-3 -3m0 6l3 -3" />
                        </svg>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endif


        </aside>


        {{-- Login & Register --}}
        <div class="w-full h-full flex flex-col justify-between">
            <!-- Header -->
            <header class="h-16 w-full flex items-center relative justify-end px-5 space-x-10 bg-gray-800">
                <!-- Informação -->
                <div class="flex flex-shrink-0 items-center space-x-4 text-white">

                    <!-- Texto -->
                    <div class="flex flex-col items-end ">
                        @guest
                            <div class="flex">
                                @if (Route::has('login'))
                                    <a class="w-1/2 text-white font-bold" href="{{ route('login') }}">
                                        Login
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="w-1/2 text-white font-bold" href="{{ route('register') }}">
                                        Register
                                    </a>
                                @endif
                            </div>
                        @else
                            <!-- Nome -->
                            <div class="flex">
                                <div class="">
                                    <div class="text-md font-medium ">{{ Auth::user()->name }}</div>
                                    <!-- Título -->
                                    <div class="text-sm font-regular">{{ Auth::user()->email }}</div>
                                </div>


                                <!-- Foto -->
                                <div class="">
                                    <div
                                        class="h-10 w-10 rounded-full cursor-pointer bg-gray-200 border-2 border-blue-400 ">
                                        <a href="{{ url('/settings/profile') }}"><img
                                                src="https://i.pinimg.com/originals/c6/e9/ed/c6e9ed167165ca99c4d428426e256fae.png"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>

                        @endguest
                    </div>


                </div>
            </header>



            <!-- Main -->
            <main class="max-w-full h-full flex relative overflow-y-hidden">
                <!-- Container -->
                <div
                    class="h-full w-full m-4  items-start justify-start rounded-tl grid-flow-col auto-cols-max gap-4 overflow-y-scroll">
                    <!-- Container -->

                    <main class="py-4">
                        @include('layouts._flash')
                        @yield('content')
                    </main>
                </div>
            </main>
        </div>

    </div>
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
