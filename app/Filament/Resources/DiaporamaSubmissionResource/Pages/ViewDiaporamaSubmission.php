<?php

namespace App\Filament\Resources\DiaporamaSubmissionResource\Pages;

use App\Filament\Resources\DiaporamaSubmissionResource;
use App\Models\DiaporamaSubmission;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDiaporamaSubmission extends ViewRecord
{
    protected static string $resource = DiaporamaSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->label('Approuver')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(fn(DiaporamaSubmission $record) => $record->update(['approved_at' => now()]))
                ->visible(fn(DiaporamaSubmission $record) => $record->approved_at === null),

            Actions\Action::make('unapprove')
                ->label('Retirer')
                ->icon('heroicon-o-x-circle')
                ->color('warning')
                ->action(fn(DiaporamaSubmission $record) => $record->update(['approved_at' => null]))
                ->visible(fn(DiaporamaSubmission $record) => $record->approved_at !== null),

            Actions\DeleteAction::make(),
        ];
    }
}
