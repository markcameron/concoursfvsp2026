@php($banner = \App\Models\Banner::getCurrentBanner())
@if($banner)
    @php($target = $banner->open_in_new_tab ? '_blank' : '_self')
    <a href="{{ $banner->link ?? '#' }}" target="{{ $target }}" class="block w-full px-4 py-3 text-center text-white hover:opacity-90 {{ $banner->color->tailwindColor() }}">
        <span class="font-medium">
            {!! nl2br(e($banner->message)) !!}
            @if($banner->link)
                <span class="underline ml-1">{{ $banner->link_text }}</span>
            @endif
        </span>
    </a>
@endif
