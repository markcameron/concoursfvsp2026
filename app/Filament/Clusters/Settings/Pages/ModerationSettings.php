<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Models\ModerationSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ModerationSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static string $view = 'filament.clusters.settings.pages.moderation-settings';

    protected static ?string $title = 'Modération des photos';

    protected static ?string $cluster = Settings::class;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(ModerationSetting::current()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contenu sexuel')
                    ->schema([
                        Forms\Components\TextInput::make('sexual_minors_reject')
                            ->label('Mineurs — seuil de rejet auto')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00')
                            ->helperText('Tolérance zéro recommandée (ex: 0.20)'),
                        Forms\Components\TextInput::make('sexual_review')
                            ->label('Seuil de révision manuelle')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                        Forms\Components\TextInput::make('sexual_reject')
                            ->label('Seuil de rejet automatique')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Violence')
                    ->schema([
                        Forms\Components\TextInput::make('violence_review')
                            ->label('Seuil de révision manuelle')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                        Forms\Components\TextInput::make('violence_reject')
                            ->label('Seuil de rejet automatique')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Haine')
                    ->schema([
                        Forms\Components\TextInput::make('hate_review')
                            ->label('Seuil de révision manuelle')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                        Forms\Components\TextInput::make('hate_reject')
                            ->label('Seuil de rejet automatique')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Harcèlement')
                    ->schema([
                        Forms\Components\TextInput::make('harassment_review')
                            ->label('Seuil de révision manuelle')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                        Forms\Components\TextInput::make('harassment_reject')
                            ->label('Seuil de rejet automatique')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Automutilation')
                    ->schema([
                        Forms\Components\TextInput::make('self_harm_review')
                            ->label('Seuil de révision manuelle')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                        Forms\Components\TextInput::make('self_harm_reject')
                            ->label('Seuil de rejet automatique')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Contenu illicite')
                    ->schema([
                        Forms\Components\TextInput::make('illicit_review')
                            ->label('Seuil de révision manuelle')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                        Forms\Components\TextInput::make('illicit_reject')
                            ->label('Seuil de rejet automatique')
                            ->numeric()->minValue(0)->maxValue(1)->step(0.01)
                            ->suffix('/ 1.00'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        ModerationSetting::current()->update($this->form->getState());

        Notification::make()
            ->title('Paramètres de modération sauvegardés')
            ->success()
            ->send();
    }
}
