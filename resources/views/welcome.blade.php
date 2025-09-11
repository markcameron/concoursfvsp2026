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

    <div class="container my-24 mx-auto px-4">
      <div class="relative max-w-xs sm:max-w-xl lg:max-w-4xl before:absolute before:top-0 before:bottom-0 before:right-0 before:left-[-50vw] before:bg-theme-light-blue before:rounded-r-[24px] p-4">
        <div class="relative lg:flex items-center gap-x-8">
          <p class="font-semibold text-xl text-gray-600 py-4">Restez à l'écoute pour plus de détails sur l'événement</p>
          <div class="shrink-0 w-max grid grid-cols-2 sm:grid-cols-4 justify-items-center gap-3">
            <div class="min-w-[110px] font-display font-semibold text-white text-center rounded-[12px] overflow-hidden shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
              <div id="days" class="tabular-nums text-3xl bg-theme-blue px-2 py-4">00</div>
              <div class="text-sm bg-theme-blue shadow-[0_0_60px_rgba(255,255,255,0.12)] px-2 py-2">jours</div>
            </div>
            <div class="min-w-[110px] font-display font-semibold text-white text-center rounded-[12px] overflow-hidden shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
              <div id="hours" class="tabular-nums text-3xl bg-theme-blue px-2 py-4">00</div>
              <div class="text-sm bg-theme-blue shadow-[0_0_60px_rgba(255,255,255,0.12)] px-2 py-2">heures</div>
            </div>
            <div class="min-w-[110px] font-display font-semibold text-white text-center rounded-[12px] overflow-hidden shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
              <div id="minutes" class="tabular-nums text-3xl bg-theme-blue px-2 py-4">00</div>
              <div class="text-sm bg-theme-blue shadow-[0_0_60px_rgba(255,255,255,0.12)] px-2 py-2">minutes</div>
            </div>
            <div class="min-w-[110px] font-display font-semibold text-white text-center rounded-[12px] overflow-hidden shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
              <div id="seconds" class="tabular-nums text-3xl bg-theme-blue px-2 py-4">00</div>
              <div class="text-sm bg-theme-blue shadow-[0_0_60px_rgba(255,255,255,0.12)] px-2 py-2">secondes</div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
