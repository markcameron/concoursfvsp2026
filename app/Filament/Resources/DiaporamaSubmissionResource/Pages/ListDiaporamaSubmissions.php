<?php

namespace App\Filament\Resources\DiaporamaSubmissionResource\Pages;

use App\Filament\Resources\DiaporamaSubmissionResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDiaporamaSubmissions extends ListRecords
{
    protected static string $resource = DiaporamaSubmissionResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toutes'),

            'pending' => Tab::make('En attente')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNull('approved_at')),

            'approved' => Tab::make('Approuvées')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('approved_at')),

            'reported' => Tab::make('Signalées')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('reports')),

            'downvoted' => Tab::make('Beaucoup de 👎')
                ->modifyQueryUsing(
                    fn(Builder $query) => $query
                    ->whereHas('votes', fn(Builder $q) => $q->where('vote', 'down'))
                    ->orderByDesc('downvotes_count'),
                ),
        ];
    }
}
