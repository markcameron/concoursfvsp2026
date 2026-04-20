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
                ->action(fn(DiaporamaSubmission $record) => $record->update(['status' => 'approved']))
                ->visible(fn(DiaporamaSubmission $record) => $record->status !== 'approved'),

            Actions\Action::make('reject')
                ->label('Rejeter')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->action(fn(DiaporamaSubmission $record) => $record->update(['status' => 'rejected']))
                ->visible(fn(DiaporamaSubmission $record) => $record->status !== 'rejected'),

            Actions\DeleteAction::make(),
        ];
    }
}
