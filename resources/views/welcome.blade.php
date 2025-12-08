@extends('layouts.front')

@section('content')
    <div class="bg-linear-to-b from-[#0C75DF]/12 to-blue-[#0C75DF]/0">
        <div class="md:max-w-(--breakpoint-md) pt-18 container mx-auto px-4 pb-24">
            <div class="mb-14 text-balance text-center">
                <h1 class="font-display text-theme-blue mb-1 text-4xl font-semibold">CONCOURS FVSP 2026</h1>
                <div class="font-display text-theme-red mb-8 text-xl font-semibold">les 8 et 9 mai à Terre-sainte</div>
                <p class="text-lg font-medium text-gray-500">En attendant plus d'informations sur l'événement, prenez un moment pour regarder la vidéo de présentation de notre magnifique région !</p>
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

    @if ($programBlock)
        <section class="bg-theme-light-blue py-14">
            <div class="lg:max-w-(--breakpoint-lg) container mx-auto px-4">
                <h2 class="section-title mb-12 text-center">{!! $programBlock['data']['title'] !!}</h2>
                <div class="grid items-start gap-8 lg:grid-cols-2">
                    <div class="overflow-hidden rounded-[16px] shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                        <div class="bg-theme-red px-6 py-3">
                            <h3 class="font-display text-xl font-semibold uppercase text-white">Vendredi 8 mai</h3>
                        </div>
                        <ul class="divide-y divide-gray-200 bg-white px-6 py-2 text-lg font-medium text-gray-600">
                            @foreach ($programBlock['data']['friday'] as $event)
                                @if ($event['time'])
                                    <li class="flex gap-x-6 py-3">
                                        <time class="w-[60px]" datetime="{{ $event['time'] }}">{{ \Carbon\Carbon::parse($event['time'])->format('H\hi') }}</time>
                                        <span class="flex-1">{{ $event['title'] }}</span>
                                    </li>
                                @else
                                    <li class="flex gap-x-6 py-3">
                                        <span class="flex-1 italic text-light-gray">{{ $event['title'] }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="overflow-hidden rounded-[16px] shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                        <div class="bg-theme-red px-6 py-3">
                            <h3 class="font-display text-xl font-semibold uppercase text-white">Samedi 9 mai</h3>
                        </div>
                        <ul class="divide-y divide-gray-200 bg-white px-6 py-2 text-lg font-medium text-gray-600">
                            @foreach ($programBlock['data']['saturday'] as $event)
                                @if ($event['time'])
                                    <li class="flex gap-x-6 py-3">
                                        <time class="w-[60px]" datetime="{{ $event['time'] }}">{{ \Carbon\Carbon::parse($event['time'])->format('H\hi') }}</time>
                                        <span class="flex-1">{{ $event['title'] }}</span>
                                    </li>
                                @else
                                    <li class="flex gap-x-6 py-3">
                                        <span class="flex-1 italic text-light-gray">{{ $event['title'] }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </section>
    @endif

@endsection
