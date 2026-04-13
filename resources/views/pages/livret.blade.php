@extends('layouts.front')

@section('content')

    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">{{ $page->title }}</h1>
    </div>

    <div class="bg-gray-900 py-8">
        <div id="flipbook-container" class="mx-auto max-w-7xl px-4" data-pdf-url="{{ asset('Concours FVSP 2026 - Livret complet.pdf') }}">

            <div id="flipbook-loading" class="flex items-center justify-center py-20 text-white">
                <svg class="mr-3 size-6 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Chargement du livret...
            </div>

            <div id="flipbook-viewer" class="hidden">
                <div id="flipbook-app" class="mx-auto"></div>

                <div class="mt-6 flex items-center justify-center gap-4">
                    <button id="flipbook-prev" class="flex items-center gap-2 rounded-lg bg-white/10 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-white/20">
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Précédent
                    </button>
                    <button id="flipbook-zoom" class="flex items-center gap-2 rounded-lg bg-white/10 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-white/20">
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Zoom
                    </button>
                    <button id="flipbook-next" class="flex items-center gap-2 rounded-lg bg-white/10 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-white/20">
                        Suivant
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    @foreach ($page->content as $block)
        @includeIf('blocks.' . $block['type'], ['block' => (object) $block['data']])
    @endforeach

@endsection

@section('bottom-scripts')
    @vite('resources/js/flipbook.js')
@endsection
