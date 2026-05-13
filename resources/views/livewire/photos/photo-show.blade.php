<div class="mx-auto max-w-5xl px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('photos.index') }}" wire:navigate class="hover:text-gray-700 hover:underline">Galerie</a>
        <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <a href="{{ route('photos.album', $album) }}" wire:navigate class="hover:text-gray-700 hover:underline">{{ $album->title }}</a>
        <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <span class="truncate text-gray-800 font-medium">{{ $photo->title ?? 'Photo' }}</span>
    </nav>

    {{-- Photo --}}
    <div class="group relative overflow-hidden rounded-xl bg-black shadow-lg">
        @if ($photo->hasMedia('photo'))
            <img src="{{ $photo->getFirstMediaUrl('photo', 'display') }}"
                 alt="{{ $photo->title ?? '' }}"
                 class="mx-auto max-h-[70vh] w-full object-contain">
        @endif

        @if ($prevPhoto)
            <a href="{{ route('photos.photo', [$album, $prevPhoto]) }}" wire:navigate
               class="absolute inset-y-0 left-0 flex w-1/4 items-center justify-start pl-4 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
               aria-label="Photo précédente">
                <span class="flex size-11 items-center justify-center rounded-full bg-black/50 text-white backdrop-blur-sm transition hover:bg-black/70">
                    <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </span>
            </a>
        @endif

        @if ($nextPhoto)
            <a href="{{ route('photos.photo', [$album, $nextPhoto]) }}" wire:navigate
               class="absolute inset-y-0 right-0 flex w-1/4 items-center justify-end pr-4 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
               aria-label="Photo suivante">
                <span class="flex size-11 items-center justify-center rounded-full bg-black/50 text-white backdrop-blur-sm transition hover:bg-black/70">
                    <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
            </a>
        @endif
    </div>

    {{-- Meta + actions --}}
    <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        {{-- Left: title + metadata --}}
        <div class="min-w-0">
            <dl class="flex flex-wrap gap-x-6 gap-y-1 text-sm text-gray-500">
                @if ($photo->photographer_name)
                    <div class="flex items-center gap-1">
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        <span>{{ $photo->photographer_name }}</span>
                    </div>
                @endif
                <div class="flex items-center gap-1">
                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span>{{ $photo->created_at->format('d.m.Y') }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span>{{ number_format($photo->display_count) }} vue{{ $photo->display_count !== 1 ? 's' : '' }}</span>
                </div>
            </dl>

            @if (!empty($photo->exif_data))
                @php $exif = $photo->exif_data; @endphp
                <dl class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-xs text-gray-400">
                    @if (!empty($exif['camera']))
                        <div class="flex items-center gap-1">
                            <svg class="size-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/></svg>
                            <span>{{ $exif['camera'] }}</span>
                        </div>
                    @endif
                    @if (!empty($exif['lens']))
                        <div><span class="opacity-60">Objectif</span> {{ $exif['lens'] }}</div>
                    @endif
                    @if (!empty($exif['focal_length']))
                        <div>{{ $exif['focal_length'] }}</div>
                    @endif
                    @if (!empty($exif['aperture']))
                        <div>{{ $exif['aperture'] }}</div>
                    @endif
                    @if (!empty($exif['shutter_speed']))
                        <div>{{ $exif['shutter_speed'] }}</div>
                    @endif
                    @if (!empty($exif['iso']))
                        <div>ISO {{ $exif['iso'] }}</div>
                    @endif
                    @if (!empty($exif['taken_at']))
                        <div>{{ \Carbon\Carbon::parse($exif['taken_at'])->format('d.m.Y H:i') }}</div>
                    @endif
                    @if (!empty($exif['width']) && !empty($exif['height']))
                        <div>{{ $exif['width'] }}×{{ $exif['height'] }}</div>
                    @endif
                </dl>
            @endif
        </div>

        {{-- Right: actions --}}
        <div class="flex shrink-0 items-center gap-3">
            {{-- Vote up --}}
            <button wire:click="vote('up')"
                    class="flex items-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition
                           {{ $userVote === 'up' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                <svg class="size-5" fill="{{ $userVote === 'up' ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                </svg>
                {{ $upvotes }}
            </button>

            {{-- Vote down --}}
            <button wire:click="vote('down')"
                    class="flex items-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition
                           {{ $userVote === 'down' ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600 hover:bg-red-50 hover:text-red-600' }}">
                <svg class="size-5" fill="{{ $userVote === 'down' ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.499-.96a8.957 8.957 0 0 0 1.302-4.665c0-1.194-.232-2.333-.654-3.375Z" />
                </svg>
                {{ $downvotes }}
            </button>

            {{-- Download --}}
            @if ($photo->hasMedia('photo'))
                <a href="{{ $photo->getFirstMediaUrl('photo') }}"
                   download
                   class="flex items-center gap-1.5 rounded-full bg-gray-100 px-4 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-200">
                    <svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Télécharger
                </a>
            @endif
        </div>
    </div>

    {{-- Prev / Next navigation --}}
    <div class="mt-8 flex items-center justify-between border-t border-gray-200 pt-6">
        @if ($prevPhoto)
            <a href="{{ route('photos.photo', [$album, $prevPhoto]) }}" wire:navigate
               class="flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-gray-800">
                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Photo précédente
            </a>
        @else
            <div></div>
        @endif

        @if ($nextPhoto)
            <a href="{{ route('photos.photo', [$album, $nextPhoto]) }}" wire:navigate
               class="flex items-center gap-2 text-sm font-medium text-gray-500 transition hover:text-gray-800">
                Photo suivante
                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        @else
            <div></div>
        @endif
    </div>

</div>
