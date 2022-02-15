<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.tag_head')

    <!-- Scripts -->
    <script src="{{ asset('js/host.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/host.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        {{-- Navbar --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand px-3 rounded border-0 bg-white shadow-none fs-2" href="{{ url('/') }}">
                    {{ config('app.name', 'BoolBnB') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            @auth
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                                                                                                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endauth

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Aside/Dashboard --}}
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">
                            <h3 class="text-primary">
                                <i class="fas fa-tachometer-alt    "></i>
                                Dashboard
                            </h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <h4 class="text-primary">
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <h4 class="text-primary">
                                <i class="fas fa-thumbtack"></i>
                                Posts
                            </h4>

                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <h4 class="text-primary">
                                <i class="fas fa-bookmark    "></i>
                                Categories
                            </h4>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <h4 class="text-primary">
                                <i class="fas fa-tags    "></i>
                                Tags
                            </h4>

                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <h4 class="text-primary">
                                <i class="fas fa-tags    "></i>
                                Messages
                            </h4>

                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
