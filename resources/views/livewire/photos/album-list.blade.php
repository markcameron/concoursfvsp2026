<div class="mx-auto max-w-7xl px-4 py-10">

    <h1 class="font-display text-theme-blue mb-2 text-3xl font-semibold">Galerie photos</h1>
    <p class="mb-8 text-gray-500">Albums photographiques du Concours FVSP 2026 à Coppet</p>

    @if ($albums->isEmpty())
        <p class="py-16 text-center text-gray-400">Aucun album disponible pour le moment.</p>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($albums as $album)
                @php $cover = $album->photos->first(); @endphp
                <a href="{{ route('photos.album', $album) }}" wire:navigate
                   class="group overflow-hidden rounded-xl bg-white shadow transition hover:shadow-md">
                    <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                        @if ($cover && $cover->hasMedia('photo'))
                            <img src="{{ $cover->getFirstMediaUrl('photo', 'thumb') }}"
                                 alt="{{ $cover->title ?? $album->title }}"
                                 class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                        @else
                            <div class="flex h-full items-center justify-center text-gray-300">
                                <svg class="size-16" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h2 class="font-display text-theme-blue text-lg font-semibold group-hover:underline">{{ $album->title }}</h2>
                        @if ($album->description)
                            <p class="mt-1 line-clamp-2 text-sm text-gray-500">{{ $album->description }}</p>
                        @endif
                        <p class="mt-2 text-xs text-gray-400">{{ $album->photos_count }} photo{{ $album->photos_count !== 1 ? 's' : '' }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</div>
