@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Diaporama</h1>
    </div>

    <div class="section-spacing container mx-auto px-4">
        @if ($submission === null)
            <div class="mx-auto max-w-lg text-center">
                <p class="text-lg text-gray-600">Aucune photo n'est disponible pour le moment. Soyez le premier à en soumettre une !</p>
                <div class="mt-8">
                    <a href="{{ route('diaporama.submit') }}" class="btn bg-theme-blue text-white">Soumettre une photo</a>
                </div>
            </div>
        @else
            <div class="mx-auto max-w-3xl">
                {{-- Photo --}}
                <div class="overflow-hidden rounded-[12px] shadow-lg">
                    <img
                        src="{{ $submission->getFirstMediaUrl('photo', 'display') }}"
                        alt="{{ $submission->caption ?? 'Photo de ' . $submission->name }}"
                        class="w-full object-cover"
                    />
                </div>

                {{-- Submitter info --}}
                <div class="mt-4 text-center">
                    <p class="font-semibold text-gray-800">{{ $submission->name }}</p>
                    @if ($submission->caption)
                        <p class="mt-1 text-gray-600 italic">{{ $submission->caption }}</p>
                    @endif
                </div>

                {{-- Votes --}}
                <div class="mt-6 flex items-center justify-center gap-4">
                    <form action="{{ route('diaporama.vote', $submission) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="up" />
                        <button type="submit" class="flex items-center gap-2 rounded-full px-5 py-2.5 font-semibold transition {{ $userVote === 'up' ? 'bg-theme-green text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            <span class="text-xl">👍</span>
                            <span>{{ $submission->upvotes_count }}</span>
                        </button>
                    </form>

                    <form action="{{ route('diaporama.vote', $submission) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="down" />
                        <button type="submit" class="flex items-center gap-2 rounded-full px-5 py-2.5 font-semibold transition {{ $userVote === 'down' ? 'bg-theme-red text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            <span class="text-xl">👎</span>
                            <span>{{ $submission->downvotes_count }}</span>
                        </button>
                    </form>
                </div>

                {{-- Report --}}
                <div class="mt-4 text-center">
                    @if (session('reported'))
                        <p class="text-sm text-gray-500">Merci, ce signalement a été enregistré.</p>
                    @else
                        <form action="{{ route('diaporama.report', $submission) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-400 underline hover:text-gray-600">Signaler cette photo</button>
                        </form>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="mt-10 flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <a href="{{ route('diaporama') }}" class="btn bg-theme-blue text-white">Voir une autre photo</a>
                    <a href="{{ route('diaporama.submit') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">Soumettre une photo</a>
                </div>
            </div>
        @endif
    </div>
@endsection
