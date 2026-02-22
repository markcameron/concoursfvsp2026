<?php

namespace App\Filament\Resources;

use App\Enums\SponsorType;
use App\Filament\Clusters\Sponsoring;
use App\Filament\Resources\SponsorResource\Pages;
use App\Models\Sponsor;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SponsorResource extends Resource
{
    protected static ?string $model = Sponsor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $cluster = Sponsoring::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('fields.name'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('url')
                            ->label(__('fields.url'))
                            ->url()
                            ->maxLength(255),

                        Forms\Components\Select::make('sponsor_level_id')
                            ->label(__('fields.sponsor_level'))
                            ->relationship('sponsorLevel', 'name')
                            ->nullable(),

                        Forms\Components\Select::make('type')
                            ->label(__('fields.type'))
                            ->required()
                            ->options(SponsorType::class),

                        Forms\Components\Toggle::make('active')
                            ->label(__('fields.active'))
                            ->default(true),

                        SpatieMediaLibraryFileUpload::make('logo')
                            ->label(__('fields.logo'))
                            ->collection('logo')
                            ->conversion('logo_small')
                            ->visibility('public'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('fields.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label(__('fields.type'))
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sponsorLevel.name')
                    ->label(__('fields.sponsor_level'))
                    ->searchable()
                    ->sortable(),

                SpatieMediaLibraryImageColumn::make('logo')
                    ->label(__('fields.logo'))
                    ->conversion('logo_small')
                    ->height(62)
                    ->grow(false),

                ToggleColumn::make('active')
                    ->label(__('fields.active')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('fields.type'))
                    ->options(SponsorType::class),
            ])
            // ->groups([
            //     Tables\Grouping\Group::make('type')
            //         ->label(__('fields.type'))
            //         ->collapsible(),
            // ])
            // ->defaultGroup('type')
            ->reorderable('sort')
            ->defaultSort('sort', 'asc')
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
            'index' => Pages\ListSponsors::route('/'),
            'create' => Pages\CreateSponsor::route('/create'),
            'edit' => Pages\EditSponsor::route('/{record}/edit'),
        ];
    }
}
