@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Soumettre une photo</h1>
    </div>

    <div class="lg:max-w-(--breakpoint-xs) section-spacing container mx-auto px-4">
        <p class="text-center text-lg font-medium text-gray-600">Partagez un moment du Concours FVSP 2026 en soumettant une photo. Elle sera visible dans le diaporama après validation par notre équipe.</p>

        @if (session('success'))
            <div class="mt-6 rounded-[8px] bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-6 rounded-[8px] bg-red-50 p-4 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('cf-turnstile-response'))
            <div class="mt-6 rounded-[8px] bg-red-50 p-4 text-red-800">
                {{ $errors->first('cf-turnstile-response') }}
            </div>
        @endif

        <form action="{{ route('diaporama.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 grid gap-y-5">
            @csrf

            <div>
                <label for="name" class="block font-semibold text-gray-600">Nom & Prénom</label>
                <div class="mt-2">
                    <input id="name" type="text" name="name" required value="{{ old('name') }}" class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
                @if ($errors->has('name'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div>
                <label for="caption" class="block font-semibold text-gray-600">Légende <span class="font-normal text-gray-400">(optionnel)</span></label>
                <div class="mt-2">
                    <input id="caption" type="text" name="caption" value="{{ old('caption') }}" placeholder="Décrivez votre photo en quelques mots…" class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
                @if ($errors->has('caption'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('caption') }}</p>
                @endif
            </div>

            <div>
                <label for="photo" class="block font-semibold text-gray-600">Photo</label>
                <div class="mt-2">
                    <input id="photo" type="file" name="photo" required accept="image/jpeg,image/png,image/webp" class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-2 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
                <p class="mt-1 text-xs text-gray-400">Formats acceptés : JPG, PNG, WebP. Taille maximale : 10 Mo.</p>
                @if ($errors->has('photo'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('photo') }}</p>
                @endif
            </div>

            <div class="mt-4 text-center">
                <x-turnstile data-theme="light" />
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="btn bg-theme-blue text-white">Envoyer ma photo</button>
            </div>
        </form>
    </div>
@endsection

@section('top-scripts')
    @turnstileScripts()
@endsection
