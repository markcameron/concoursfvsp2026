<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Spatie\Tags\Tag;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Forms\Components\SpatieTagsInput;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventResource\RelationManagers\UsersRelationManager;
use App\Filament\Resources\EventResource\RelationManagers\DocumentsRelationManager;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Événement';

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
{
    return [
        'Date' => $record->date,
    ];
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('fields.name'))
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('description')
                                    ->label(__('fields.description'))
                                    ->required()
                                    ->maxLength(65535),

                                Forms\Components\DateTimePicker::make('started_at')
                                    ->label(__('fields.started_at'))
                                    ->required()
                                    ->timezone('Europe/Zurich'),

                                Forms\Components\DateTimePicker::make('ended_at')
                                    ->label(__('fields.ended_at'))
                                    ->required()
                                    ->timezone('Europe/Zurich'),
                            ])
                    ])->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                SpatieTagsInput::make('tags')
                                    ->label(__('fields.tags'))
                                    ->type('events'),
                            ]),
                    ])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('fields.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label(__('fields.description'))
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\TextColumn::make('started_at')
                    ->label(__('fields.when'))
                    ->formatStateUsing(fn (Event $record) => $record->date)
                    ->sortable(),

                SpatieTagsColumn::make('tags')->type('events'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('fields.deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tags')
                    ->multiple()
                    ->options(Tag::getWithType('events')->pluck('name', 'name'))
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['values'], function (Builder $query, $data): Builder {
                            return $query->withAnyTags(array_values($data), 'events');
                        });
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            DocumentsRelationManager::class,
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
