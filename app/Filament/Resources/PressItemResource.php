<?php

namespace App\Filament\Resources;

use App\Enums\PressItemType;
use App\Filament\Resources\PressItemResource\Pages;
use App\Models\PressItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PressItemResource extends Resource
{
    protected static ?string $model = PressItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $modelLabel = 'Article de presse';

    protected static ?string $pluralModelLabel = 'Revue de presse';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('source')
                            ->label('Source')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nom du média ou de la publication (ex: 24 Heures, RTS, Instagram)'),

                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->required()
                            ->url()
                            ->maxLength(2048),

                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options(PressItemType::class)
                            ->required()
                            ->default(PressItemType::Article),

                        Forms\Components\Toggle::make('active')
                            ->label('Visible sur le site')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('source')
                    ->label('Source')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge(),

                Tables\Columns\ToggleColumn::make('active')
                    ->label('Visible'),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPressItems::route('/'),
            'create' => Pages\CreatePressItem::route('/create'),
            'edit' => Pages\EditPressItem::route('/{record}/edit'),
        ];
    }
}
