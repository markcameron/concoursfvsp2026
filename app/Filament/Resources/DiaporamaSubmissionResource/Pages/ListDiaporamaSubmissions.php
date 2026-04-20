<?php

namespace App\Filament\Resources\DiaporamaSubmissionResource\Pages;

use App\Filament\Resources\DiaporamaSubmissionResource;
use App\Models\DiaporamaSubmission;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDiaporamaSubmissions extends ListRecords
{
    protected static string $resource = DiaporamaSubmissionResource::class;

    public function getTabs(): array
    {
        $counts = DiaporamaSubmission::query()
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("SUM(status = 'pending') as pending")
            ->selectRaw("SUM(status = 'flagged') as flagged")
            ->selectRaw("SUM(status = 'rejected') as rejected")
            ->selectRaw("SUM(status = 'approved') as approved")
            ->selectRaw("SUM(EXISTS (SELECT 1 FROM diaporama_reports WHERE diaporama_reports.diaporama_submission_id = diaporama_submissions.id)) as reported")
            ->first();

        return [
            'all' => Tab::make('Toutes')
                ->badge($counts->total),

            'pending' => Tab::make('En attente')
                ->badge($counts->pending)
                ->badgeColor('gray')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending')),

            'flagged' => Tab::make('Signalées par IA')
                ->badge($counts->flagged)
                ->badgeColor('warning')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'flagged')),

            'rejected' => Tab::make('Rejetées')
                ->badge($counts->rejected)
                ->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'rejected')),

            'approved' => Tab::make('Approuvées')
                ->badge($counts->approved)
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'approved')),

            'reported' => Tab::make('Signalées par utilisateurs')
                ->badge($counts->reported ?: null)
                ->badgeColor('danger')
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
