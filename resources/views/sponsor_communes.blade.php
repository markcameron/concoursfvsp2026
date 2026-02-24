@php
    use App\Enums\SponsorLevelColors;
@endphp

@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Nos soutiens communaux</h1>
    </div>

    <section class="section-spacing container mx-auto px-4">
        <section class="container mx-auto w-48 px-4">
            <a href="https://www.terresainte.ch" target="_blank" class="flex h-48 items-center justify-center">
                <img src="{{ asset('images/logo-terre-sainte.png') }}" alt="Terre Sainte logo" class="max-h-full max-w-full object-contain">
            </a>
        </section>
    </section>

    @if ($sponsorsWithPhotos)
        <section class="section-spacing container mx-auto px-4">
            <section class="container mx-auto max-w-2xl px-4">
                <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-16 sm:gap-16 lg:gap-20">
                    @foreach ($sponsorsWithPhotos as $sponsor)
                        @if ($sponsor->getFirstMedia('logo')?->hasGeneratedConversion('logo_large'))
                            <a href="{{ $sponsor->url }}" target="_blank" class="flex flex-col items-center justify-center">
                                <img src="{{ $sponsor->getImageUrl('logo', 'logo_large') }}" alt="{{ $sponsor->name }} logo" class="max-h-[200px] max-w-full object-contain">
                                <h3 class="mt-2 text-center font-semibold">{{ $sponsor->name }}</h3>
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        </section>
    @endif

    @if ($sponsorsWithoutPhotos)
        <section class="section-spacing container mx-auto px-4">
            <section class="space-between container mx-auto flex justify-center px-4">
                <div class="md:max-w-(--breakpoint-md) grid grid-cols-1 gap-x-16 gap-y-4 text-xl sm:grid-cols-2 md:grid-cols-3">
                    @foreach ($sponsorsWithoutPhotos as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="text-theme-blue text-center font-semibold">
                            {{ $sponsor->name }}
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif

@endsection
