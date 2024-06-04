<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Committee;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\CommitteeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommitteeResource\RelationManagers;
use App\Filament\Resources\CommitteeResource\RelationManagers\TasksRelationManager;
use App\Filament\Resources\CommitteeResource\RelationManagers\UsersRelationManager;

class CommitteeResource extends Resource
{
    protected static ?string $model = Committee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Commission';

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->name;
    }

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

                        Forms\Components\TextInput::make('email')
                            ->label(__('fields.email'))
                            ->email()
                            ->maxLength(255),

                        Forms\Components\Select::make('color')
                            ->label(__('fields.color'))
                            ->options(fn () => (new Committee())->colors())
                            ->searchable()
                            ->allowHtml(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([

                    Tables\Columns\Layout\Stack::make([

                        Tables\Columns\TextColumn::make('name')
                            ->label(__('fields.name'))
                            ->html()
                            ->weight('medium')
                            ->searchable()
                            ->sortable(),

                        Tables\Columns\TextColumn::make('email')
                            ->label(__('fields.email'))
                            ->searchable()
                            ->sortable(),

                    ]),

                    Tables\Columns\TextColumn::make('name')
                        ->label(__('fields.name'))
                        ->formatStateUsing(fn (Model $model, string $state): string => $model->badge())
                        ->html()
                        ->searchable()
                        ->sortable()
                        ->alignCenter(),

                    Tables\Columns\TextColumn::make('member_count')
                        ->label(__('fields.member_count'))
                        ->badge()
                        ->color(static fn ($state): string => $state ? 'success' : 'danger')
                        ->alignCenter(),

                    // Tables\Columns\TextColumn::make('created_at')
                    //     ->label(__('fields.created_at'))
                    //     ->dateTime()
                    //     ->sortable()
                    //     ->toggleable(isToggledHiddenByDefault: true),

                    // Tables\Columns\TextColumn::make('updated_at')
                    //     ->label(__('fields.updated_at'))
                    //     ->dateTime()
                    //     ->sortable()
                    //     ->toggleable(isToggledHiddenByDefault: true),

                    // Tables\Columns\TextColumn::make('deleted_at')
                    //     ->label(__('fields.deleted_at'))
                    //     ->dateTime()
                    //     ->sortable()
                    //     ->toggleable(isToggledHiddenByDefault: true),
                ]),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('name', 'asc')
            ->paginated(false);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\TextEntry::make('name')
                                        ->formatStateUsing(fn (Model $model, string $state): string => $model->badge())
                                        ->html(),

                                    Components\TextEntry::make('email')
                                        ->formatStateUsing(fn (string $state): string => '<b><a href="mailto:' . $state . '">' . $state . '</a></b>')
                                        ->html()
                                        ->color('primary'),
                                ]),
                        ])->from('lg'),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TasksRelationManager::class,
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommittees::route('/'),
            'create' => Pages\CreateCommittee::route('/create'),
            'view' => Pages\ViewCommittee::route('/{record}'),
            'edit' => Pages\EditCommittee::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return CommitteeResource::getUrl('view', ['record' => $record]);
    }
}
