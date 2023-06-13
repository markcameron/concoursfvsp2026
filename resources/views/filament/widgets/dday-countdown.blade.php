<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold tracking-tight sm:text-xl">
            Le councours commence {{ \Carbon\Carbon::parse('2026-05-08')->diffForHumans(['parts' => 4]) }}
        </h2>
    </x-filament::card>
</x-filament::widget>
