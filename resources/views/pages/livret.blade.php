@extends('layouts.front')

@section('content')

    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">{{ $page->title }}</h1>
    </div>

    <div class="bg-gray-900 py-16">
        <div class="mx-auto flex max-w-sm flex-col gap-4 px-4">
            <a href="{{ route('pages.livret.viewer') }}"
               class="flex items-center justify-center gap-3 rounded-xl bg-white/10 px-6 py-4 text-base font-semibold text-white transition hover:bg-white/20">
                <svg class="size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Lire le livret
            </a>

            <a href="{{ asset('Concours FVSP 2026 - Livret complet.pdf') }}" download
               class="flex items-center justify-center gap-3 rounded-xl bg-white/10 px-6 py-4 text-base font-semibold text-white transition hover:bg-white/20">
                <svg class="size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Télécharger le livret (PDF)
            </a>
        </div>
    </div>

    @foreach ($page->content as $block)
        @includeIf('blocks.' . $block['type'], ['block' => (object) $block['data']])
    @endforeach

@endsection
