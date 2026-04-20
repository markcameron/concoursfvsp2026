<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiaporamaSubmissionResource\Pages;
use App\Filament\Resources\DiaporamaSubmissionResource\RelationManagers;
use App\Models\DiaporamaSubmission;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DiaporamaSubmissionResource extends Resource
{
    protected static ?string $model = DiaporamaSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $modelLabel = 'Photo';

    protected static ?string $pluralModelLabel = 'Diaporama';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount([
                'votes as upvotes_count' => fn(Builder $q) => $q->where('vote', 'up'),
                'votes as downvotes_count' => fn(Builder $q) => $q->where('vote', 'down'),
                'reports as reports_count',
            ])
            ->latest();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('caption')
                            ->label('Légende')
                            ->nullable()
                            ->maxLength(255),

                        SpatieMediaLibraryFileUpload::make('photo')
                            ->label('Photo')
                            ->collection('photo')
                            ->visibility('public'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('photo')
                            ->label('Photo')
                            ->collection('photo')
                            ->conversion('display')
                            ->hiddenLabel()
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom'),

                        Infolists\Components\TextEntry::make('caption')
                            ->label('Légende')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('approved_at')
                            ->label('Statut')
                            ->badge()
                            ->formatStateUsing(fn($state) => $state ? 'Approuvé' : 'En attente')
                            ->color(fn($state) => $state ? 'success' : 'warning'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Soumis le')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('photo')
                    ->label('Photo')
                    ->collection('photo')
                    ->conversion('thumb')
                    ->height(64)
                    ->grow(false),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('caption')
                    ->label('Légende')
                    ->limit(40)
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Approuvé' : 'En attente')
                    ->color(fn($state) => $state ? 'success' : 'warning'),

                Tables\Columns\TextColumn::make('upvotes_count')
                    ->label('👍')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('downvotes_count')
                    ->label('👎')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('reports_count')
                    ->label('Signalements')
                    ->sortable()
                    ->alignCenter()
                    ->color(fn($state) => $state > 0 ? 'danger' : null),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Soumis le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn(DiaporamaSubmission $record) => $record->update(['approved_at' => now()]))
                    ->visible(fn(DiaporamaSubmission $record) => $record->approved_at === null),

                Tables\Actions\Action::make('unapprove')
                    ->label('Retirer')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->action(fn(DiaporamaSubmission $record) => $record->update(['approved_at' => null]))
                    ->visible(fn(DiaporamaSubmission $record) => $record->approved_at !== null),

                Tables\Actions\ViewAction::make(),
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
            RelationManagers\ReportsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiaporamaSubmissions::route('/'),
            'view' => Pages\ViewDiaporamaSubmission::route('/{record}'),
        ];
    }
}
