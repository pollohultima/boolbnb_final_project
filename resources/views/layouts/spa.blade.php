<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.tag_head')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- footer style -->
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        {{-- Navbar --}}
        @include('partials.header_spa')

        <main class="py-4">
            @yield('content')
        </main>

        <!-- footer -->
        @include('partials.footer_spa')
    </div>
</body>

</html>
