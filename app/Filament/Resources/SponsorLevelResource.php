<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SponsorLevel;
use Filament\Resources\Resource;
use App\Enums\SponsorLevelColors;
use App\Filament\Clusters\Sponsoring;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SponsorLevelResource\Pages;
use App\Filament\Resources\SponsorLevelResource\RelationManagers;

class SponsorLevelResource extends Resource
{
    protected static ?string $model = SponsorLevel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Sponsoring::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('sponsor_level.name'))
                            ->required()
                            ->maxLength(255)
                            ->default(null),

                        Forms\Components\Select::make('color')
                            ->label(__('sponsor_level.color'))
                            ->required()
                            ->options(SponsorLevelColors::class)
                            ->default(SponsorLevelColors::HOSE_25),

                        Forms\Components\TextInput::make('price')
                            ->label(__('sponsor_level.price'))
                            ->numeric()
                            ->required()
                            ->default(null)
                            ->prefix('CHF'),

                        Forms\Components\Repeater::make('benefits')
                            ->label(__('sponsor_level.benefits'))
                            ->simple(
                                Forms\Components\TextInput::make('benefit')
                                    ->label(__('sponsor_level.benefit'))
                                    ->required()
                                    ->maxLength(255),
                            ),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('color')
                    ->searchable()
                    ->badge(),

                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSponsorLevels::route('/'),
            'create' => Pages\CreateSponsorLevel::route('/create'),
            'edit' => Pages\EditSponsorLevel::route('/{record}/edit'),
        ];
    }
}
