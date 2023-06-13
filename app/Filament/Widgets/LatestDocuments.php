<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\Document;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DocumentResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestDocuments extends BaseWidget
{
    protected static ?string $heading = 'Documents récents';

    protected static ?int $sort = 2;

    public function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 5;
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableQuery(): Builder
    {
        return DocumentResource::getEloquentQuery()->take(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\Layout\Split::make([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->weight('medium')
                        ->label(__('fields.name')),
                    Tables\Columns\TextColumn::make('created_at')->dateTime("d M Y"),
                ])
            ])
        ];
    }

    // protected function getTableActions(): array
    // {
    //     return [
    //         Tables\Actions\Action::make('voir')
    //             ->url(fn (Document $record): string => DocumentResource::getUrl('edit', ['record' => $record])),
    //     ];
    // }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Document $record): string => DocumentResource::getUrl('edit', ['record' => $record]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
