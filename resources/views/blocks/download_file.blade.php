<div class="lg:max-w-(--breakpoint-lg) section-spacing container mx-auto px-4">
    <h2 class="text-theme-red font-display mb-6 text-2xl font-semibold uppercase">{{ $block->title }}</h2>
    <div class="mb-10">

        <div class="">
            <div class="mx-auto max-w-7xl lg:flex lg:items-center lg:justify-between">
                <h2 class="max-w-2xl text-sm font-semibold tracking-tight text-gray-900 sm:text-lg">
                    {!! \Str::of($block->body)->markdown() !!}
                </h2>
                <div class="mt-10 flex items-center gap-x-6 lg:mt-0 lg:shrink-0">
                    <a href="{{ \Storage::disk('front')->url($block->file) }}" target="_blank" class="shadow-xs bg-theme-blue rounded-md px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        {{ $block->button_text }}
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
