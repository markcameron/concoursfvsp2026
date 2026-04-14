@extends('layouts.front')

@section('content')
    <div class="bg-linear-to-b from-[#0C75DF]/12 to-blue-[#0C75DF]/0">
        <x-marquee />
        <div class="md:max-w-(--breakpoint-md) pt-18 container mx-auto px-4 pb-24">

            <div class="mb-14 text-balance text-center">
                <h1 class="font-display text-theme-blue mb-1 text-4xl font-semibold">CONCOURS FVSP 2026</h1>
                <div class="font-display text-theme-red mb-8 text-xl font-semibold">les 8 et 9 mai à Coppet</div>
                <p class="mt-6 text-lg font-medium text-gray-500">Il s’agit d’un événement d’envergure qui nécessite une organisation rigoureuse et un <strong>investissement financier conséquent</strong> afin de garantir, la qualité des infrastructures, la sécurité des participants et le bon déroulement
                    de la manifestation et que si vous souhaitez soutenir cet événement unique</p>
                <p class="mt-6 text-lg font-medium font-semibold text-gray-500">Vous pouvez nous aider en faisant un don :</p>

                <div class="lg:max-w-(--breakpoint-lg) container mx-auto my-12 px-4">
                    <h2 class="text-theme-red font-display mb-6 text-xl font-semibold uppercase">Faire un don</h2>
                    <div class="mb-10">

                        <div class="">
                            <div class="mx-auto flex max-w-xl flex-col items-center gap-6">
                                <h2 class="max-w-2xl text-lg tracking-tight text-gray-500">
                                    Ou scannez le QR code pour faire un don et participer à cette aventure humaine
                                </h2>
                                <div class="mt-0 flex items-center gap-x-6">
                                    <a href="{{ route('pages.donations') }}" class="shadow-xs bg-theme-blue rounded-md px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                        Faire un don
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <p class="mt-6 text-lg font-medium text-gray-500">Merci pour votre soutien et votre engagement à nos côtés !</p>

                <p class="mt-12 text-lg font-medium text-gray-500">En attendant plus d'informations sur l'événement, prenez un moment pour regarder la vidéo de présentation de notre magnifique région !</p>
            </div>
            <div class="overflow-hidden rounded-[12px]">
                <iframe width="560" height="315" class="aspect-video h-auto w-full" src="https://www.youtube-nocookie.com/embed/jsXaugt-1O0?si=4coLe0FAc7l2DOcu?privacy_mode=1" title="YouTube video player" allow="" referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-24 px-4">
        <div class="before:bg-theme-light-blue relative max-w-xs p-4 before:absolute before:bottom-0 before:left-[-50vw] before:right-0 before:top-0 before:rounded-r-[24px] sm:max-w-xl lg:max-w-4xl">
            <div class="relative items-center gap-x-8 lg:flex">
                <p class="py-4 text-xl font-semibold text-gray-600">Restez à l'écoute pour plus de détails sur l'événement</p>
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

    <x-programme />

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
