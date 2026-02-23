@php
    use App\Enums\SponsorLevelColors;
@endphp

@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Nos soutiens communaux</h1>
    </div>

    @if ($sponsorsWithPhotos)
        <section class="section-spacing container mx-auto px-4">
            <h2 class="section-title-plain mb-12 text-center">Les communes de Terre Sainte</h2>
            <section class="container mx-auto px-4">
                <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-8 sm:gap-16 lg:gap-20">
                    @foreach ($sponsorsWithPhotos as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="flex h-24 items-center justify-center">
                            <img src="{{ $sponsor->getFirstMediaUrl('logo', 'logo_small') }}" alt="{{ $sponsor->name }} logo" class="max-h-full max-w-full object-contain">
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif

    @if ($sponsorsWithoutPhotos)
        <section class="section-spacing container mx-auto px-4">
            <section class="container mx-auto px-4 flex justify-center space-between">
                <div class="md:max-w-(--breakpoint-md) grid grid-cols-2 gap-x-20 gap-y-4 sm:grid-cols-3 text-xl">
                    @foreach ($sponsorsWithoutPhotos as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="font-semibold text-theme-blue">
                            {{ $sponsor->name }}
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif

@endsection
