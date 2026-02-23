@php
use App\Enums\SponsorLevelColors;
@endphp

@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Sponsors</h1>
    </div>

    @if ($sponsorsByLevel?->get(4))
        <section class="section-spacing container mx-auto px-4">
            <h2 class="section-title-plain mb-12 text-center border-b-2 border-theme-{{ SponsorLevelColors::HOSE_75->getColor() }} text-theme-{{ SponsorLevelColors::HOSE_75->getColor() }}">Sponsors Tuyau 75mm</h2>
            <section class="container mx-auto px-4">
                <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-8 sm:gap-16 lg:gap-20">
                    @foreach ($sponsorsByLevel?->get(4) as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="flex h-32 items-center justify-center">
                            <img src="{{ $sponsor->getFirstMediaUrl('logo', 'logo_75') }}" alt="{{ $sponsor->name }} logo" class="max-h-full max-w-full object-contain h-32">
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif

    @if ($sponsorsByLevel?->get(3))
        <section class="section-spacing container mx-auto px-4">
            <h2 class="section-title-plain mb-12 text-center border-b-2 border-theme-{{ SponsorLevelColors::HOSE_55->getColor() }} text-theme-{{ SponsorLevelColors::HOSE_55->getColor() }}">Sponsors Tuyau 55mm</h2>
            <section class="container mx-auto px-4">
                <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-8 sm:gap-16 lg:gap-20">
                    @foreach ($sponsorsByLevel?->get(3) as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="flex h-20 items-center justify-center">
                            <img src="{{ $sponsor->getFirstMediaUrl('logo', 'logo_55') }}" alt="{{ $sponsor->name }} logo" class="max-h-full max-w-full object-contain h-20">
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif

    @if ($sponsorsByLevel?->get(2))
        <section class="section-spacing container mx-auto px-4">
            <h2 class="section-title-plain mb-12 text-center border-b-2 border-theme-{{ SponsorLevelColors::HOSE_40->getColor() }} text-theme-{{ SponsorLevelColors::HOSE_40->getColor() }}">Sponsors Tuyau 40mm</h2>
            <section class="container mx-auto px-4">
                <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-8 sm:gap-16 lg:gap-20">
                    @foreach ($sponsorsByLevel?->get(2) as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="flex h-15 items-center justify-center">
                            <img src="{{ $sponsor->getFirstMediaUrl('logo', 'logo_40') }}" alt="{{ $sponsor->name }} logo" class="max-h-full max-w-full object-contain h-15">
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif

    @if ($sponsorsByLevel?->get(1))
        <section class="section-spacing container mx-auto px-4">
            <h2 class="section-title-plain mb-12 text-center border-b-2 border-theme-{{ SponsorLevelColors::HOSE_25->getColor() }} text-theme-{{ SponsorLevelColors::HOSE_25->getColor() }}">Sponsors Tuyau 25mm</h2>
            <section class="container mx-auto px-4">
                <div class="sponsors-logo-sizing xs:gap-12 mt-3 flex flex-wrap items-center justify-center gap-8 sm:gap-16 lg:gap-20">
                    @foreach ($sponsorsByLevel?->get(1) as $sponsor)
                        <a href="{{ $sponsor->url }}" target="_blank" class="flex h-12 items-center justify-center">
                            <img src="{{ $sponsor->getFirstMediaUrl('logo', 'logo_25') }}" alt="{{ $sponsor->name }} logo" class="max-h-full max-w-full object-contain h-12">
                        </a>
                    @endforeach
                </div>
            </section>
        </section>
    @endif
@endsection
