<?php

namespace App\Filament\Resources\CommitteeResource\RelationManagers;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\StatusTask;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $label = 'tâche';

    protected static ?string $labelPlural = 'tâches';

    protected static ?string $title = 'Tâches';

    public function form(Form $form): Form
    {
        return $form
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
                    ->label(__('fields.deadline'))
                    ->timezone('Europe/Zurich'),
                Forms\Components\MarkdownEditor::make('description')
                    ->label(__('fields.description'))
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
            ->headerActions([
                Tables\Actions\AttachAction::make()->preloadRecordSelect(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label(__('fields.view'))
                    ->url(fn (Task $record): string => route('filament.admin.resources.tasks.view', $record->id))
                    ->icon('heroicon-s-eye'),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
