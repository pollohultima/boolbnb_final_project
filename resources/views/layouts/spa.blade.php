<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.tag_head')

    <!-- font awesome -->

    <script src="https://kit.fontawesome.com/71acfe6c9b.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        {{-- Navbar --}}
        @include('partials.header_spa')

        <main>
            @yield('content')
        </main>

        @include('partials.footer_spa')
    </div>
</body>

</html>
