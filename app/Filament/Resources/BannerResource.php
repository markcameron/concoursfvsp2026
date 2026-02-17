<?php

namespace App\Filament\Resources;

use App\Enums\BannerColor;
use App\Filament\Clusters\Settings;
use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $cluster = Settings::class;

    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $modelLabel = 'Bannière';

    protected static ?string $pluralModelLabel = 'Bannières';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Message')
                            ->required()
                            ->rows(3),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('link')
                                    ->label('Lien (optionnel)'),

                                Forms\Components\TextInput::make('link_text')
                                    ->label('Texte du lien')
                                    ->default('En savoir plus'),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('color')
                                    ->label('Couleur')
                                    ->options(BannerColor::class)
                                    ->default(BannerColor::BLUE)
                                    ->required(),

                                Forms\Components\Toggle::make('open_in_new_tab')
                                    ->label('Ouvrir dans un nouvel onglet'),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DateTimePicker::make('starts_at')
                                    ->label('Début d\'affichage')
                                    ->timezone('Europe/Zurich'),

                                Forms\Components\DateTimePicker::make('ends_at')
                                    ->label('Fin d\'affichage')
                                    ->timezone('Europe/Zurich'),
                            ]),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->helperText('Une seule bannière peut être active à la fois'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('color')
                    ->label('Couleur')
                    ->badge()
                    ->color(fn (BannerColor $state): string => $state->getColor()),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actif')
                    ->sortable()
                    ->updateStateUsing(function ($record, $state) {
                        if ($state) {
                            Banner::where('id', '!=', $record->id)->update(['is_active' => false]);
                        }
                        $record->update(['is_active' => $state]);
                    }),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Début')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->label('Fin')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Statut')
                    ->options([
                        true => 'Actif',
                        false => 'Inactif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
