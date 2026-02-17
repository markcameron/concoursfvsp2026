@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Tir au tuyau</h1>
    </div>
    <div class="lg:max-w-(--breakpoint-xs) section-spacing container mx-auto px-4">
        <h2 class="text-center text-theme-red font-display mb-6 text-2xl font-semibold uppercase">Inscrivez-vous pour participer au Tir au tuyau.</h2>

        <p class="text-center text-lg font-medium text-gray-600 mb-4">Dans le cadre du concours FVSP, nous avons le plaisir d’inviter les sociétés locales à s’inscrire à l’épreuve de tir au tuyau.</p>

        <p class="text-center text-lg font-medium text-gray-600 mb-4">Le tir débutera le <b>8 mai 2026</b> à <b>18h00</b>.</p>

        <p class="text-center text-lg font-medium text-gray-600 mb-4">Le paiement se fera sur place</p>

        <p class="text-center text-lg font-medium text-gray-600 mb-32">Vous trouverez <a href="/files/Réglement-tir-au-tuyau.pdf" class="text-theme-blue font-bold hover:underline">ici le règlement de l’épreuve</a>, que nous vous remercions de bien vouloir consulter avant votre inscription.</p>

        @if (session('success'))
            <div class="mt-6 rounded-[8px] bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('cf-turnstile-response'))
            <div class="mt-6 rounded-[8px] bg-red-50 p-4 text-red-800">
                {{ $errors->first('cf-turnstile-response') }}
            </div>
        @endif

        <form action="{{ route('tir-au-tuyau.store') }}" method="POST" class="mt-10 grid gap-y-5">
            @csrf

            <div>
                <label for="company_name" class="block font-semibold text-gray-600">Nom de la société (optionnel)</label>
                <div class="mt-2">
                    <input id="company_name" type="text" name="company_name" class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
                @if ($errors->has('company_name'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('company_name') }}</p>
                @endif
            </div>

            <div>
                <label for="name" class="block font-semibold text-gray-600">Nom / Prénom</label>
                <div class="mt-2">
                    <input id="name" type="text" name="name" required class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
                @if ($errors->has('name'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div>
                <label for="email" class="block font-semibold text-gray-600">Adresse e-mail</label>
                <div class="mt-2">
                    <input id="email" type="email" name="email" required class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
                @if ($errors->has('email'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="mt-4 text-center">
                <x-turnstile
                    data-theme="light"
                    />
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="btn bg-theme-blue text-white">S'inscrire</button>
            </div>
        </form>
    </div>
@endsection

@section('top-scripts')
    @turnstileScripts()
@endsection
