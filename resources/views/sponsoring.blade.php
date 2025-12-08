@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Sponsoring</h1>
    </div>

    <section class="section-spacing container mx-auto px-4">
        <h2 class="section-title mb-12 text-center">Devenez Sponsor</h2>
        <div class="grid items-start gap-8 lg:grid-cols-4">

            @foreach ($sponsorLevels as $level)
                <div class="flex w-full flex-col items-center rounded-[32px] bg-{{ $level->color }}-100 p-8 shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                    <h3 class="font-display text-theme-{{ $level->color }} text-center text-2xl font-semibold uppercase">{{ $level->name }}</h3>
                    <img src="{{ asset('images/hose-' . $level->color . '.svg') }}" class="my-8 drop-shadow-[5px_7px_26px_rgba(0,0,0,0.2)]" width="176" height="176" alt="">
                    <div class="text-theme-{{ $level->color }} text-center text-4xl font-bold uppercase">CHF {{ number_format($level->price, 0, '', '’') }}.-</div>
                    <ul class="list-checkmark list-checkmark--{{ $level->color }} my-6 space-y-2 font-medium text-gray-600">
                        @foreach ($level->benefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                    <div class="w-full">
                        <a href="{{ route('sponsor.info') }}" class="btn text-theme-blue w-full bg-white">Sponsoriser</a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
