<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FVSP Terre Sainte 2026</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased" style="font-family: figtree, ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'">
        <div class="w-full h-screen flex flex-col justify-center items-center text-white">
            <div class="p-5">
                <img src="{{ asset('images/logo.png') }}" alt="FVSP 2026 - Terre Sainte" class="h-100">
            </div>
            <p class="text-slate-700 text-md sm:text-xl">Rester à l'écoute pour plus de détails sur l'événement</p>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-10 mt-10 lg:mt-20">

                <div class="bg-transparent border text-center text-slate-700">
                    <p class="text-2xl sm:text-5xl px-10 py-5" id="days">00</p>
                    <hr>
                    <p class="px-10 py-5">jours</p>
                </div>

                <div class="bg-transparent border text-center text-slate-700">
                    <p class="text-2xl sm:text-5xl px-10 py-5" id="hours">00</p>
                    <hr>
                    <p class="px-10 py-5">heures</p>
                </div>

                <div class="bg-transparent border text-center text-slate-700">
                    <p class="text-2xl sm:text-5xl px-10 py-5" id="minutes">00</p>
                    <hr>
                    <p class="px-10 py-5">minutes</p>
                </div>
                <div class="bg-transparent border text-center text-slate-700">
                    <p class="text-2xl sm:text-5xl px-10 py-5" id="seconds">00</p>
                    <hr>
                    <p class="px-10 py-5">secs</p>
                </div>
            </div>

        </div>
    </body>
</html>
