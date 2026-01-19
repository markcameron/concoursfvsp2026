<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FVSP Terre Sainte 2026</title>

    <meta name="robots" content="noindex">

    @vite(['resources/css/app.css', 'resources/js/countdown.js'])

    @yield('top-scripts')

</head>

<body>

    <main>

        @yield('content')

    </main>

    @yield('bottom-scripts')

</body>

</html>
