<?php

namespace App\Filament\Resources\DiaporamaSubmissionResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ModerationLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'moderationLogs';

    protected static ?string $title = 'Historique de modération';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Résultat')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => match ($state) {
                        'approved' => 'Approuvée',
                        'flagged' => 'Signalée',
                        'rejected' => 'Rejetée',
                        'error' => 'Erreur',
                    })
                    ->color(fn(string $state) => match ($state) {
                        'approved' => 'success',
                        'flagged' => 'warning',
                        'rejected' => 'danger',
                        'error' => 'gray',
                    }),

                Tables\Columns\TextColumn::make('error')
                    ->label('Erreur')
                    ->placeholder('—')
                    ->limit(80)
                    ->tooltip(fn($record) => $record->error)
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->moderationLogs()->where('status', 'error')->exists()),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }
}
