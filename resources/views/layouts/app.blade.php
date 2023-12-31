<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Efleurlasting</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('Assets/Logo/logo_image_efleurlasting.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @vite(['resources/sass/app.scss'])

    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('Assets/Logo/logo_image_efleurlasting.png') }}" alt="Logo Image Efleurlasting"
                        class="img-fluid" style="width: 50px; height: auto;">
                    <img src="{{ asset('Assets/Logo/logo_title_efleurlasting.png') }}" alt="Logo Title Efleurlasting"
                        class="img-fluid" style="width: 150px; height: auto;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav gap-3 ms-5">
                        <li class="nav-item {{ request()->routeIs('products') ? 'active-link' : '' }}">
                            <a class="nav-link p-0 text-black" href="{{ route('products') }}">Products</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('categories') ? 'active-link' : '' }}">
                            <a class="nav-link p-0 text-black" href="{{ route('categories') }}">Categories</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('about') ? 'active-link' : '' }}">
                            <a class="nav-link p-0 text-black" href="{{ route('about') }}">About</a>
                        </li>
                        @auth
                            @if (Auth::user()->isUser())
                                <li class="nav-item">
                                    <a class="nav-link p-0 text-black" href="{{ route('cart', Auth::user()) }}">Cart</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        @auth
                            @if (Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.setting') }}">Settings</a>
                                </li>
                            @endif
                        @endauth

                        @auth
                            @if (Auth::user()->isUser())
                                <li class="nav-item">
                                    @php($user = Auth::user())
                                    @if ($user->profile_image)
                                        <a class="nav-link" href="{{ route('user.setting') }}">
                                            <img src="{{ asset($user->profile_image) }}" alt=""
                                                style="width: 35px; height: 35px; overflow: hidden; object-fit:cover; object-position: center; border-radius: 50%"
                                                class="img-fluid">
                                        </a>
                                    @else
                                        <a class="nav-link" href="{{ route('user.setting') }}">
                                            <img src="{{ asset('Assets/Icons/profile.png') }}" alt=""
                                                style="width: 35px; height: 35px; overflow: hidden; object-fit:cover; object-position: center; border-radius: 50%"
                                                class="img-fluid">
                                        </a>
                                    @endif
                                </li>
                            @endif
                        @endauth
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
                                    @if (Auth::user()->isUser())
                                        <a class="dropdown-item" href="{{ route('user.setting') }}">
                                            Profile
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <main>
            @yield('content')
        </main>

        <footer class="w-100 bg-white px-5 pb-3 pt-3 @unless (request()->routeIs(['home', 'about', 'products', 'category.show', 'categories'])) d-none @endunless">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('Assets/Logo/logo.png') }}" style="max-width: 250px" alt="">
                <p>&#169; Efleurlasting. All Right Reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    @livewireScripts
</body>

</html>
