@if ($showBlock)
    <section class="bg-theme-light-blue py-14">
        <div class="lg:max-w-(--breakpoint-lg) container mx-auto px-4">
            <h2 class="section-title mb-12 text-center">{!! $programBlock['data']['title'] !!}</h2>
            <div class="grid items-start gap-8 lg:grid-cols-2">
                <div class="overflow-hidden rounded-[16px] shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                    <div class="bg-theme-red px-6 py-3">
                        <h3 class="font-display text-xl font-semibold uppercase text-white">Vendredi 8 mai</h3>
                    </div>
                    <ul class="divide-y divide-gray-200 bg-white px-6 py-2 text-lg font-medium text-gray-600">
                        @foreach ($programBlock['data']['friday'] as $event)
                            @if ($event['time'])
                                <li class="flex gap-x-6 py-3">
                                    <time class="w-[60px]" datetime="{{ $event['time'] }}">{{ \Carbon\Carbon::parse($event['time'])->format('H\hi') }}</time>
                                    <span class="flex-1">{{ $event['title'] }}</span>
                                </li>
                            @else
                                <li class="flex gap-x-6 py-3">
                                    <span class="text-light-gray flex-1 italic">{{ $event['title'] }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="overflow-hidden rounded-[16px] shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                    <div class="bg-theme-red px-6 py-3">
                        <h3 class="font-display text-xl font-semibold uppercase text-white">Samedi 9 mai</h3>
                    </div>
                    <ul class="divide-y divide-gray-200 bg-white px-6 py-2 text-lg font-medium text-gray-600">
                        @foreach ($programBlock['data']['saturday'] as $event)
                            @if ($event['time'])
                                <li class="flex gap-x-6 py-3">
                                    <time class="w-[60px]" datetime="{{ $event['time'] }}">{{ \Carbon\Carbon::parse($event['time'])->format('H\hi') }}</time>
                                    <span class="flex-1">{{ $event['title'] }}</span>
                                </li>
                            @else
                                <li class="flex gap-x-6 py-3">
                                    <span class="text-light-gray flex-1 italic">{{ $event['title'] }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </section>
@endif
