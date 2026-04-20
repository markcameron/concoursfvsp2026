@extends('layouts.diaporama')

@section('content')
    <div class="flex h-screen flex-col">

        {{-- Top bar --}}
        <div class="flex-none flex items-center border-b border-white/10 bg-black/90 px-4 py-3">
            <a href="{{ route('diaporama') }}" class="text-sm text-white/50 transition hover:text-white">
                ← Retour
            </a>
            <h1 class="flex-1 text-center text-sm font-semibold text-white">Soumettre une photo</h1>
            {{-- spacer to balance the back link --}}
            <span class="w-14"></span>
        </div>

        {{-- Scrollable form area --}}
        <div class="flex-1 overflow-y-auto px-4 py-8">
            <div class="mx-auto max-w-lg">
                <p class="mb-6 text-center text-sm text-white/50">Partagez un moment du Concours FVSP 2026. Votre photo sera visible après validation par notre équipe.</p>

                @if (session('success'))
                    <div class="mb-6 rounded-lg bg-emerald-500/20 px-4 py-3 text-sm text-emerald-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-lg bg-red-500/20 px-4 py-3 text-sm text-red-300">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->has('cf-turnstile-response'))
                    <div class="mb-6 rounded-lg bg-red-500/20 px-4 py-3 text-sm text-red-300">
                        {{ $errors->first('cf-turnstile-response') }}
                    </div>
                @endif

                <form action="{{ route('diaporama.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-white/70">Nom & Prénom</label>
                        <div class="mt-2">
                            <input
                                id="name" type="text" name="name" required
                                value="{{ old('name') }}"
                                class="block w-full rounded-lg bg-white/10 px-3 py-2.5 text-sm font-medium text-white outline outline-1 -outline-offset-1 outline-white/20 placeholder:text-white/30 focus:bg-white/15 focus:outline-white/50 focus:outline-2 focus:-outline-offset-2"
                            />
                        </div>
                        @if ($errors->has('name'))
                            <p class="mt-1.5 text-xs text-red-400">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="caption" class="block text-sm font-semibold text-white/70">
                            Légende <span class="font-normal text-white/30">(optionnel)</span>
                        </label>
                        <div class="mt-2">
                            <input
                                id="caption" type="text" name="caption"
                                value="{{ old('caption') }}"
                                placeholder="Décrivez votre photo en quelques mots…"
                                class="block w-full rounded-lg bg-white/10 px-3 py-2.5 text-sm font-medium text-white outline outline-1 -outline-offset-1 outline-white/20 placeholder:text-white/30 focus:bg-white/15 focus:outline-white/50 focus:outline-2 focus:-outline-offset-2"
                            />
                        </div>
                        @if ($errors->has('caption'))
                            <p class="mt-1.5 text-xs text-red-400">{{ $errors->first('caption') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-semibold text-white/70">Photo</label>
                        <div class="mt-2">
                            <input
                                id="photo" type="file" name="photo" required
                                accept="image/jpeg,image/png,image/webp"
                                class="block w-full rounded-lg bg-white/10 px-3 py-2.5 text-sm text-white/70 outline outline-1 -outline-offset-1 outline-white/20 file:mr-3 file:rounded-full file:border-0 file:bg-white/20 file:px-3 file:py-1 file:text-xs file:font-semibold file:text-white hover:file:bg-white/30"
                            />
                        </div>
                        <p class="mt-1.5 text-xs text-white/30">JPG, PNG ou WebP · max 10 Mo</p>
                        @if ($errors->has('photo'))
                            <p class="mt-1.5 text-xs text-red-400">{{ $errors->first('photo') }}</p>
                        @endif
                    </div>

                    <div class="mt-2 text-center">
                        <x-turnstile data-theme="dark" />
                    </div>

                    <div class="mt-4 text-center">
                        <button type="submit" class="rounded-full bg-white px-8 py-2.5 text-sm font-semibold text-black transition hover:bg-white/90">
                            Envoyer ma photo
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('top-scripts')
    @turnstileScripts()
@endsection
