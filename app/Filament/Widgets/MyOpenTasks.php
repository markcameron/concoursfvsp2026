<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class MyOpenTasks extends BaseWidget
{
    protected static ?string $heading = 'Mes tâches';

    protected static ?int $sort = 2;

    protected function getTableQuery(): Builder
    {
        return TaskResource::getEloquentQuery()
            ->whereHas('users', fn($q) => $q->where('user_id', auth()->user()->id));
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\Layout\Split::make([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->weight('semibold')
                        ->label(__('fields.name')),
                    Tables\Columns\TextColumn::make('status')
                        ->label(__('fields.status'))
                        ->badge(),
                ]),
                Tables\Columns\TextColumn::make('committees')
                    ->label(__('fields.committees'))
                    ->formatStateUsing(fn(Task $record): string => $record->committees->map(fn($committee) => $committee->badge())->implode(''))
                    ->html()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label(__('fields.deadline'))
                    ->badge()
                    ->color(fn(Task $task) => $task->deadlineColor())
                    ->date()
                    ->alignEnd(),
            ]),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(Task $record): string => TaskResource::getUrl('view', ['record' => $record]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
