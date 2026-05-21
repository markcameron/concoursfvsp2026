@extends('layouts.front')

@section('content')

    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">{{ $page->title }}</h1>
    </div>

    <div class="bg-gray-900 py-16">
        <div class="mx-auto flex max-w-sm flex-col gap-4 px-4">
            <a href="{{ asset('Résultats concours 2026.pdf') }}" download
               class="flex items-center justify-center gap-3 rounded-xl bg-white/10 px-6 py-4 text-base font-semibold text-white transition hover:bg-white/20">
                <svg class="size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Télécharger les Résultats (PDF)
            </a>
        </div>
    </div>

    @foreach ($page->content as $block)
        @includeIf('blocks.' . $block['type'], ['block' => (object) $block['data']])
    @endforeach

@endsection
