@extends('layouts.plain')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="grid grid-flow-col grid-rows-3 gap-x-48 gap-y-10">

            <div class="row-span-3 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" width="300" height="300" alt="Logo FVSP Terre-Sainte 2026">
            </div>

            <div class="col-span-2 flex justify-center items-center text-center">
                <div class="text-7xl font-semibold uppercase text-theme-red">On compte sur vous!</div>
            </div>

            <div class="col-span-2 row-span-2 flex justify-center items-center text-center">
                <div class="grid w-max shrink-0 grid-cols-2 justify-items-center gap-3 sm:grid-cols-4">
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="days" class="bg-theme-blue px-6 py-6 text-6xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-lg shadow-[0_0_60px_rgba(255,255,255,0.12)]">jours</div>
                    </div>
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="hours" class="bg-theme-blue px-6 py-6 text-6xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-lg shadow-[0_0_60px_rgba(255,255,255,0.12)]">heures</div>
                    </div>
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="minutes" class="bg-theme-blue px-6 py-6 text-6xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-lg shadow-[0_0_60px_rgba(255,255,255,0.12)]">minutes</div>
                    </div>
                    <div class="font-display min-w-[110px] overflow-hidden rounded-[12px] text-center font-semibold text-white shadow-[-3px_3px_8px_rgba(0,0,0,0.25)]">
                        <div id="seconds" class="bg-theme-blue px-6 py-6 text-6xl tabular-nums">00</div>
                        <div class="bg-theme-blue px-2 py-2 text-lg shadow-[0_0_60px_rgba(255,255,255,0.12)]">secondes</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
