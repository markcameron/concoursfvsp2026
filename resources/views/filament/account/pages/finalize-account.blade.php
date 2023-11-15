<x-filament-panels::page>
    <form wire:submit.prevent="submit">
        <x-filament::section
            heading="Renseigner votre mot de passe et corrigé vos noms si besoin"
            >
                {{ $this->form }}
        </x-filament::section>
        <div class="mt-6">
            <x-filament::button type="submit">{{ __('filament-actions::edit.single.modal.actions.save.label') }}</x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
