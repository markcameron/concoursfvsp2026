<div class="lg:max-w-(--breakpoint-lg) section-spacing container mx-auto px-4">
    <div class="mb-10">

        <div class="">
            <div class="mx-auto max-w-7xl lg:flex lg:items-center lg:justify-between">
                {!! \Str::of($block->body)->markdown() !!}
            </div>
        </div>

    </div>
</div>
