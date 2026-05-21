@extends('layouts.front')

@section('content')
    <div class="bg-linear-to-b from-[#0C75DF]/12 to-blue-[#0C75DF]/0">
        <x-marquee />
        <div class="md:max-w-(--breakpoint-md) pt-18 container mx-auto px-4 pb-24">

            <div class="text-balance text-center">
                <h1 class="font-display text-theme-blue mb-1 text-4xl font-semibold">CONCOURS FVSP 2026</h1>
                <div class="font-display text-theme-red mb-6 text-xl font-semibold">les 8 et 9 mai à Coppet</div>
                <p class="mx-auto max-w-xl text-lg text-gray-600">Un grand merci à toutes et à tous pour votre participation, votre investissement et votre présence à cet événement. Votre engagement a rendu ce concours inoubliable !</p>
                <p class="mt-4 text-lg font-medium text-gray-700">À l'année prochaine à Chamberonne ! <a href="https://fvsp27.ch/" target="_blank" class="text-theme-blue hover:underline">fvsp27.ch</a></p>
            </div>

        </div>
    </div>

    @if (!$hideCountdown)
    <div class="container mx-auto mb-24 px-4" id="countdown">
        <div class="before:bg-theme-light-blue relative max-w-xs p-4 before:absolute before:bottom-0 before:left-[-50vw] before:right-0 before:top-0 before:rounded-r-[24px] sm:max-w-xl lg:max-w-4xl">
            <div class="relative items-center gap-x-8 lg:flex">
                <p class="py-4 text-xl font-semibold text-gray-600">Le concours démarre dans :</p>
                <div class="grid w-max shrink-0 grid-cols-2 justify-items-center gap-3 sm:grid-cols-4">
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="days" class="bg-theme-blue px-2 py-4 text-3xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-sm shadow-[0_0_60px_rgba(255,255,255,0.12)]">jours</div>
                    </div>
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="hours" class="bg-theme-blue px-2 py-4 text-3xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-sm shadow-[0_0_60px_rgba(255,255,255,0.12)]">heures</div>
                    </div>
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="minutes" class="bg-theme-blue px-2 py-4 text-3xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-sm shadow-[0_0_60px_rgba(255,255,255,0.12)]">minutes</div>
                    </div>
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="seconds" class="bg-theme-blue px-2 py-4 text-3xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-sm shadow-[0_0_60px_rgba(255,255,255,0.12)]">secondes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container mx-auto mb-24 px-4">
        <div class="flex justify-center">
            <a href="{{ route('photos.index') }}" class="shadow-xs bg-theme-blue flex w-full items-center gap-4 rounded-xl px-6 py-5 text-white transition hover:bg-blue-600 sm:w-1/2">
                <svg class="size-8 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <div>
                    <p class="text-sm font-medium opacity-80">Photos du concours</p>
                    <p class="text-lg font-semibold">Voir la galerie photos</p>
                </div>
            </a>
        </div>
    </div>

    @if ($pressItems->isNotEmpty())
    <section class="container mx-auto mb-24 px-4">
        <h2 class="font-display text-theme-blue mb-6 text-2xl font-semibold">Revue de presse</h2>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($pressItems as $item)
                <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer"
                   class="group flex flex-col gap-3 rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">{{ $item->source }}</span>
                        @php $color = match($item->type->getColor()) { 'info' => 'text-blue-500', 'danger' => 'text-red-500', 'warning' => 'text-amber-500', 'success' => 'text-green-500', default => 'text-gray-400' }; @endphp
                        <x-dynamic-component :component="$item->type->getIcon()" class="size-5 {{ $color }}" />
                    </div>
                    <p class="flex-1 font-medium text-gray-800 group-hover:text-theme-blue transition-colors leading-snug">{{ $item->title }}</p>
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        <svg class="size-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        {{ parse_url($item->url, PHP_URL_HOST) }}
                    </span>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <div class="bg-linear-to-b from-[#0C75DF]/12 to-blue-[#0C75DF]/0">
        <div class="md:max-w-(--breakpoint-md) pt-18 container mx-auto px-4 pb-24">
            <div class="overflow-hidden rounded-[12px]">
                <iframe width="560" height="315" class="aspect-video h-auto w-full" src="https://www.youtube-nocookie.com/embed/jsXaugt-1O0?si=4coLe0FAc7l2DOcu?privacy_mode=1" title="YouTube video player" allow="" referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>

    @if ($showSponsorListHomepage)
        <section class="section-spacing container mx-auto px-4">
            <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-8 sm:gap-16 lg:gap-20">
                @foreach ($sponsors as $sponsor)
                    <a href="{{ $sponsor->url }}" target="_blank" class="flex h-24 items-center justify-center">
                        <img src="{{ $sponsor->getImageUrl('logo', 'logo_large') }}" alt="{{ $sponsor->name }} logo" class="max-h-full max-w-full object-contain">
                    </a>
                @endforeach
            </div>
        </section>
    @endif

@endsection
