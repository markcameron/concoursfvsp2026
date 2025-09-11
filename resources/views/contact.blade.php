@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Contact</h1>
    </div>
    <div class="lg:max-w-(--breakpoint-xs) section-spacing container mx-auto px-4">
        <p class="text-center text-lg font-medium text-gray-600">Pour toute question, demande d'information ou proposition de partenariat, n'hésitez pas à nous contacter.</p>

        @if (session('success'))
            <div class="mt-6 rounded-[8px] bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="mt-10 grid gap-y-5">
            @csrf

            <div>
                <label for="name" class="block font-semibold text-gray-600">Nom & Prénom</label>
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

            <div>
                <label for="phone" class="block font-semibold text-gray-600">Numéro de téléphone (optionel)</label>
                <div class="mt-2">
                    <input id="phone" type="tel" name="telephone"
                        class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="message" class="block font-semibold text-gray-600">Votre message</label>
                <div class="mt-2">
                    <textarea name="message" id="message" rows="5" required class="focus:outline-theme-blue block w-full rounded-[8px] bg-gray-50 px-3 py-3 font-medium text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:bg-white focus:outline-2 focus:-outline-offset-2 sm:text-sm/6"></textarea>
                </div>
                @if ($errors->has('message'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('message') }}</p>
                @endif
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="btn bg-theme-blue text-white">Envoyer</button>
            </div>
        </form>
    </div>
@endsection
