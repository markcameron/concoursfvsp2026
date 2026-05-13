<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoAlbumResource\Pages;
use App\Filament\Resources\PhotoAlbumResource\RelationManagers;
use App\Models\PhotoAlbum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PhotoAlbumResource extends Resource
{
    protected static ?string $model = PhotoAlbum::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $modelLabel = 'Album';

    protected static ?string $pluralModelLabel = 'Albums';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('photos');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(PhotoAlbum::class, 'slug', ignoreRecord: true),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->nullable()
                            ->maxLength(1000)
                            ->rows(3),

                        Forms\Components\Toggle::make('active')
                            ->label('Visible sur le site')
                            ->default(false),
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

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('photos_count')
                    ->label('Photos')
                    ->sortable(),

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

    public static function getRelations(): array
    {
        return [
            RelationManagers\PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotoAlbums::route('/'),
            'create' => Pages\CreatePhotoAlbum::route('/create'),
            'edit' => Pages\EditPhotoAlbum::route('/{record}/edit'),
        ];
    }
}
