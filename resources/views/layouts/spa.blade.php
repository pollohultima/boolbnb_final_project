<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.tag_head')



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps.css'>

</head>

<body>
    <div id="app">

        {{-- Navbar --}}
        @include('partials.header_spa')

        <main>
            @yield('content')
        </main>

        <!-- footer -->
        @include('partials.footer_spa')
    </div>

</body>

</html>
