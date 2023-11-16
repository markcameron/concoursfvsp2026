<?php

namespace App\Filament\Resources;

use App\Enums\StatusTask;
use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Filament\Resources\TaskResource\RelationManagers\UsersRelationManager;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Tâche';

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
                        Forms\Components\Select::make('status')
                            ->label(__('fields.status'))
                            ->default('pending')
                            ->options(__('fields.status_task'))
                            ->required(),
                        Forms\Components\DateTimePicker::make('deadline')
                            ->label(__('fields.deadline')),
                        Forms\Components\MarkdownEditor::make('description')
                            ->label(__('fields.description'))
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('fields.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('fields.status'))
                    ->badge()
                    ->color(fn (StatusTask $state) => $state->color())
                    ->formatStateUsing(fn (StatusTask $state): string => $state->label())
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label(__('fields.deadline'))
                    ->badge()
                    ->color(fn (Task $task) => $task->deadlineColor())
                    ->date()
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(4)
                                ->schema([
                                    Components\TextEntry::make('name')
                                        ->label(__('fields.name')),
                                    Components\Group::make([
                                    ]),
                                    Components\TextEntry::make('deadline')
                                        ->label(__('fields.deadline'))
                                        ->badge()
                                        ->date()
                                        ->color(fn (Task $task) => $task->deadlineColor()),
                                    Components\TextEntry::make('status')
                                        ->label(__('fields.status'))
                                        ->badge()
                                        ->color(fn (StatusTask $state) => $state->color())
                                        ->formatStateUsing(fn (StatusTask $state): string => $state->label()),
                                ]),
                        ])->from('lg'),
                    ]),
                Components\Section::make(__('fields.description'))
                    ->schema([
                        Components\TextEntry::make('description')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
