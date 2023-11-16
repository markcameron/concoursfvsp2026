<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\Event;
use App\Filament\Resources\EventResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class MyUpcomingEvents extends BaseWidget
{
    protected static ?string $heading = 'Mes convocations';

    protected static ?int $sort = 1;

    protected function getTableQuery(): Builder
    {
        return EventResource::getEloquentQuery()
            ->whereHas('users', fn ($q) => $q->where('user_id', auth()->user()->id));
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\Layout\Split::make([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->weight('medium')
                        ->label(__('fields.name')),
                    Tables\Columns\TextColumn::make('started_at')
                        ->formatStateUsing(fn (Event $record) => $record->date),
                ]),
                Tables\Columns\TextColumn::make('participant_count')
                    ->badge()
                    ->prefix('Convoquées : ')
                    ->color(static fn ($state): string => $state > 1 ? 'success' : 'danger')
                    ->alignEnd(),
            ])
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Event $record): string => EventResource::getUrl('edit', ['record' => $record]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
