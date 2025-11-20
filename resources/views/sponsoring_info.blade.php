@extends('layouts.front')

@section('content')
    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">Comment devenir sponsor</h1>
    </div>

    @foreach ($sponsorInfo->content as $block)
        @includeIf('blocks.' . $block['type'], ['block' => (object) $block['data']])
    @endforeach

    {{-- <div class="lg:max-w-(--breakpoint-lg) section-spacing container mx-auto px-4">
        <h2 class="text-theme-red font-display mb-6 text-2xl font-semibold uppercase">Dossier de parrainage</h2>
        <div class="mb-10">

            <div class="">
                <div class="mx-auto max-w-7xl lg:flex lg:items-center lg:justify-between">
                    <h2 class="max-w-2xl text-sm font-semibold tracking-tight text-gray-900 sm:text-lg">
                        Téléchargez notre dossier de parrainage pour découvrir les opportunités de sponsoring disponibles. Vous découvrirez les différents niveaux de sponsoring, les avantages associés et comment votre entreprise peut bénéficier d'une visibilité accrue lors de notre événement. Ainsi que les informations sur l'evenement, la Fédération Vaudoise des sapeurs-pompiers, le comité d'organisation, le SDIS Terre-Saine et la région de Terre-Sainte.
                    </h2>
                    <div class="mt-10 flex items-center gap-x-6 lg:mt-0 lg:shrink-0">
                        <a href="#" class="shadow-xs rounded-md bg-theme-blue px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            Télécharger le dossier de parrainage
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="lg:max-w-(--breakpoint-lg) section-spacing container mx-auto px-4">
        <h2 class="text-theme-red font-display mb-6 text-2xl font-semibold uppercase">Formulaire de souscription</h2>
        <div class="mb-10">

            <div class="">
                <div class="mx-auto max-w-7xl lg:flex lg:items-center lg:justify-between">
                    <h2 class="max-w-2xl text-sm font-semibold tracking-tight text-gray-900 sm:text-lg">
                        Pour devenir sponsor, veuillez remplir le formulaire de souscription. Pour ce faire il suffit de télécharger le formulaire en cliquant sur le bouton ci-après, de le remplir avec vos informations et de nous le renvoyer par <a href="mailto:pub@fvsp-terre-sainte-2026.ch">email</a>. Nous vous contacterons ensuite pour finaliser votre sponsoring et discuter des prochaines étapes.
                    </h2>
                    <div class="mt-10 flex items-center gap-x-6 lg:mt-0 lg:shrink-0">
                        <a href="#" class="shadow-xs rounded-md bg-theme-blue px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            Télécharger le formulaire de souscription
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section-spacing prose prose-lg prose-theme-blue container mx-auto px-4">
        <p>Pour devenir sponsor, veuillez suivre les étapes suivantes :</p>
        <ol>
            <li>Choisissez un niveau de sponsoring qui vous convient.</li>
            <li>Remplissez le formulaire de contact avec vos informations.</li>
            <li>Nous vous contacterons pour finaliser votre sponsoring.</li>
        </ol>
    </div> --}}
@endsection
