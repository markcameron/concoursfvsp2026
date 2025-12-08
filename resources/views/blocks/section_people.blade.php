<div class="container mx-auto px-4 my-16">
    <h2 class="font-semibold sm:text-lg lg:text-3xl text-center border-b-2 border-theme-red text-theme-red uppercase mb-12"><span>{{ $block->title }}</span></h2>

    <div class="xs:grid-cols-[repeat(auto-fit,_49%)] lg:gap-y-18 grid gap-x-2 gap-y-8 sm:grid-cols-[repeat(auto-fit,_33%)] md:grid-cols-[repeat(auto-fit,_24%)] lg:grid-cols-[repeat(auto-fit,_19%)] justify-center">
        @foreach ($block->people as $person)
            <figure>
                <img src="{{ \Storage::disk('public')->url($person['photo']) }}" width="270" height="410" alt="" class="aspect-contain mx-auto block rounded-sm px-5">
                <figcaption class="mt-4 text-center text-gray-900">
                    <div class="font-semibold sm:text-lg lg:text-xl">{{ mb_strtoupper($person['last_name']) }} {{ $person['first_name'] }}</div>
                    <div class="">{{ $person['role'] }}</div>
                </figcaption>
            </figure>
        @endforeach

    </div>
</div>
