<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiaporamaSubmissionResource\Pages;
use App\Filament\Resources\DiaporamaSubmissionResource\RelationManagers;
use App\Models\DiaporamaSubmission;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DiaporamaSubmissionResource extends Resource
{
    protected static ?string $model = DiaporamaSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $modelLabel = 'Photo';

    protected static ?string $pluralModelLabel = 'Diaporama';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount([
                'votes as upvotes_count' => fn(Builder $q) => $q->where('vote', 'up'),
                'votes as downvotes_count' => fn(Builder $q) => $q->where('vote', 'down'),
                'reports as reports_count',
            ])
            ->latest();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('caption')
                            ->label('Légende')
                            ->nullable()
                            ->maxLength(255),

                        SpatieMediaLibraryFileUpload::make('photo')
                            ->label('Photo')
                            ->collection('photo')
                            ->visibility('public'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('photo')
                            ->label('Photo')
                            ->collection('photo')
                            ->conversion('display')
                            ->hiddenLabel()
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom'),

                        Infolists\Components\TextEntry::make('caption')
                            ->label('Légende')
                            ->placeholder('—'),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Statut')
                            ->badge()
                            ->formatStateUsing(fn(string $state) => match ($state) {
                                'pending' => 'En attente',
                                'flagged' => 'Signalée',
                                'rejected' => 'Rejetée',
                                'approved' => 'Approuvée',
                            })
                            ->color(fn(string $state) => match ($state) {
                                'pending' => 'gray',
                                'flagged' => 'warning',
                                'rejected' => 'danger',
                                'approved' => 'success',
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Soumis le')
                            ->dateTime(),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Scores de modération')
                    ->schema([
                        Infolists\Components\TextEntry::make('moderation_scores_display')
                            ->hiddenLabel()
                            ->html()
                            ->columnSpanFull()
                            ->getStateUsing(function (DiaporamaSubmission $record): string {
                                $scores = $record->moderation_scores;

                                if (empty($scores)) {
                                    return 'Aucune analyse disponible.';
                                }

                                $labels = [
                                    'sexual' => 'Contenu sexuel',
                                    'sexual/minors' => 'Contenu sexuel (mineurs)',
                                    'violence' => 'Violence',
                                    'violence/graphic' => 'Violence graphique',
                                    'hate' => 'Haine',
                                    'hate/threatening' => 'Haine menaçante',
                                    'harassment' => 'Harcèlement',
                                    'harassment/threatening' => 'Harcèlement menaçant',
                                    'self-harm' => 'Automutilation',
                                    'self-harm/intent' => 'Automutilation (intention)',
                                    'self-harm/instructions' => 'Automutilation (instructions)',
                                    'illicit' => 'Contenu illicite',
                                    'illicit/violent' => 'Contenu illicite violent',
                                ];

                                $rows = '';
                                foreach ($labels as $key => $label) {
                                    $score = $scores[$key] ?? null;
                                    if ($score === null) {
                                        continue;
                                    }
                                    $pct = number_format($score * 100, 1);
                                    $width = min((int) round($score * 100), 100);
                                    $colour = match (true) {
                                        $score >= 0.7 => '#ef4444',
                                        $score >= 0.3 => '#f59e0b',
                                        default => '#22c55e',
                                    };
                                    $rows .= "<div style='margin-bottom:6px'>"
                                        . "<div style='display:flex;justify-content:space-between;font-size:0.8rem;margin-bottom:2px'>"
                                        . "<span>{$label}</span><span>{$pct}%</span></div>"
                                        . "<div style='background:#e5e7eb;border-radius:4px;height:6px'>"
                                        . "<div style='width:{$width}%;background:{$colour};border-radius:4px;height:6px'></div>"
                                        . "</div></div>";
                                }

                                return $rows;
                            }),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->visible(fn(DiaporamaSubmission $record) => ! empty($record->moderation_scores)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('photo')
                    ->label('Photo')
                    ->collection('photo')
                    ->conversion('thumb')
                    ->height(64)
                    ->grow(false),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('caption')
                    ->label('Légende')
                    ->limit(40)
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => match ($state) {
                        'pending' => 'En attente',
                        'flagged' => 'Signalée',
                        'rejected' => 'Rejetée',
                        'approved' => 'Approuvée',
                    })
                    ->color(fn(string $state) => match ($state) {
                        'pending' => 'gray',
                        'flagged' => 'warning',
                        'rejected' => 'danger',
                        'approved' => 'success',
                    }),

                Tables\Columns\TextColumn::make('upvotes_count')
                    ->label('👍')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('downvotes_count')
                    ->label('👎')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('reports_count')
                    ->label('Signalements')
                    ->sortable()
                    ->alignCenter()
                    ->color(fn($state) => $state > 0 ? 'danger' : null),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Soumis le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn(DiaporamaSubmission $record) => $record->update(['status' => 'approved']))
                    ->visible(fn(DiaporamaSubmission $record) => $record->status !== 'approved'),

                Tables\Actions\Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn(DiaporamaSubmission $record) => $record->update(['status' => 'rejected']))
                    ->visible(fn(DiaporamaSubmission $record) => $record->status !== 'rejected'),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ReportsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiaporamaSubmissions::route('/'),
            'view' => Pages\ViewDiaporamaSubmission::route('/{record}'),
        ];
    }
}
