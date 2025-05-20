@extends('layouts.front')

@section('content')
    <div class="bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <p class="text-base/7 font-semibold text-red-500">À Terre-Sainte le 8-9 mai</p>
            <h2 class="mt-2 text-5xl font-semibold tracking-tight text-blue-800 sm:text-7xl">Concours FVSP 2026</h2>
            <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">L'assemblé generale de la Fédération Vaudoise des Sapeurs Pompiers 2026 et son concours se déroulera à Terre-Sainte.L'assemblée générale de la Fédération Vaudoise des Sapeurs Pompiers et son concours se déroule à Terre-Sainte en 2026. Prenez un moment pour regarder la vidéo de présentation de notre magnifique région en attendant plus d'informations sur l'événement.</p>
        </div>
    </div>

    <div class="flex h-screen w-full flex-col items-center justify-center text-white">

        <div class="container mx-auto">
            <div class="mb-8 flex w-full justify-center">
                <iframe class="aspect-video w-full" src="https://www.youtube.com/embed/jsXaugt-1O0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>

        <p class="text-md text-slate-700 sm:text-xl">Rester à l'écoute pour plus de détails sur l'événement</p>

        <div class="mt-10 grid grid-cols-2 gap-10 sm:grid-cols-2 lg:mt-20 lg:grid-cols-4">

            <div class="border bg-transparent text-center text-slate-700">
                <p class="px-10 py-5 text-2xl sm:text-5xl" id="days">00</p>
                <hr>
                <p class="px-10 py-5">jours</p>
            </div>

            <div class="border bg-transparent text-center text-slate-700">
                <p class="px-10 py-5 text-2xl sm:text-5xl" id="hours">00</p>
                <hr>
                <p class="px-10 py-5">heures</p>
            </div>

            <div class="border bg-transparent text-center text-slate-700">
                <p class="px-10 py-5 text-2xl sm:text-5xl" id="minutes">00</p>
                <hr>
                <p class="px-10 py-5">minutes</p>
            </div>
            <div class="border bg-transparent text-center text-slate-700">
                <p class="px-10 py-5 text-2xl sm:text-5xl" id="seconds">00</p>
                <hr>
                <p class="px-10 py-5">secs</p>
            </div>
        </div>

    </div>
@endsection
