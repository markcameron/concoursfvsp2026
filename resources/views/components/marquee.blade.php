@if ($showMarqueeHomepage)
    <div class="pt-12">
        <div class="marquee">
            <div class="marquee__group">
                @foreach ($sponsors as $sponsor)
                    <a href="{{ $sponsor->url }}" target="_blank">
                        <img src="{{ $sponsor->getImageUrl('logo', 'logo_large') }}" alt="{{ $sponsor->name }} logo" class="h-16">
                    </a>
                @endforeach
            </div>
            <div aria-hidden="true" class="marquee__group">
                @foreach ($sponsors as $sponsor)
                    <a href="{{ $sponsor->url }}" target="_blank">
                        <img src="{{ $sponsor->getImageUrl('logo', 'logo_large') }}" alt="{{ $sponsor->name }} logo" class="h-16">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
