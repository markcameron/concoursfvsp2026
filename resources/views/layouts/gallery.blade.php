<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! seo() !!}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Matomo -->
    <script>
        var _paq = window._paq = window._paq || [];
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u = "//matomo.kram.xyz/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', '2']);
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.async = true;
            g.src = u + 'matomo.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <!-- End Matomo Code -->

</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <header class="bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
            <a href="{{ route('homepage') }}" wire:navigate class="flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-gray-800">
                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Retour au site
            </a>

            <a href="{{ route('photos.index') }}" wire:navigate class="font-display text-theme-blue text-lg font-semibold">
                Galerie photos
            </a>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts

</body>

</html>
