<div class="mx-auto max-w-7xl px-4 py-10">

    <nav class="mb-6 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('photos.index') }}" wire:navigate class="hover:text-gray-700 hover:underline">Galerie</a>
        <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <span class="text-gray-800 font-medium">{{ $album->title }}</span>
    </nav>

    <h1 class="font-display text-theme-blue mb-1 text-3xl font-semibold">{{ $album->title }}</h1>
    @if ($album->description)
        <p class="mb-8 text-gray-500">{{ $album->description }}</p>
    @else
        <div class="mb-8"></div>
    @endif

    @if ($photos->isEmpty())
        <p class="py-16 text-center text-gray-400">Cet album ne contient pas encore de photos.</p>
    @else
        <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($photos as $photo)
                <a href="{{ route('photos.photo', [$album, $photo]) }}" wire:navigate
                   class="group aspect-square overflow-hidden rounded-lg bg-gray-100">
                    @if ($photo->hasMedia('photo'))
                        <img src="{{ $photo->getFirstMediaUrl('photo', 'thumb') }}"
                             alt="{{ $photo->title ?? '' }}"
                             class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                    @else
                        <div class="flex h-full items-center justify-center text-gray-300">
                            <svg class="size-10" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

</div>
