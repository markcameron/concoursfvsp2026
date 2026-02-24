<div class="lg:max-w-(--breakpoint-xs) section-spacing container mx-auto px-4">
    <div class="text-center text-lg font-medium text-gray-600 flex flex-col gap-y-2">
        {!! \Str::of($block->body)->markdown() !!}
    </div>
</div>
