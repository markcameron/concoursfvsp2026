<?php

namespace App\Filament\Resources\PhotoAlbumResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $title = 'Photos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('photo')
                    ->label('Photo')
                    ->collection('photo')
                    ->disk('gallery')
                    ->visibility('public')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(20480)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\TextInput::make('photographer_name')
                    ->label('Photographe')
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordre')
                    ->integer()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->withCount([
                'votes as upvotes_count' => fn(Builder $q) => $q->where('vote', 'up'),
                'votes as downvotes_count' => fn(Builder $q) => $q->where('vote', 'down'),
            ]))
            ->defaultSort('sort_order')
            ->columns([
                SpatieMediaLibraryImageColumn::make('photo')
                    ->label('')
                    ->collection('photo')
                    ->conversion('thumb')
                    ->height(60)
                    ->width(80),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('photographer_name')
                    ->label('Photographe')
                    ->searchable(),

                Tables\Columns\TextColumn::make('upvotes_count')
                    ->label('👍')
                    ->sortable(),

                Tables\Columns\TextColumn::make('downvotes_count')
                    ->label('👎')
                    ->sortable(),

                Tables\Columns\TextColumn::make('display_count')
                    ->label('Vues')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
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
}
