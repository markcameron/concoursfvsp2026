<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QrCodeResource\Pages;
use App\Filament\Resources\QrCodeResource\Widgets\QrVisitsChart;
use App\Models\QrCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class QrCodeResource extends Resource
{
    protected static ?string $model = QrCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static ?string $modelLabel = 'Code QR';

    protected static ?string $pluralModelLabel = 'Codes QR';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('visits');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Identifiant unique utilisé dans l\'URL du QR code (ex: plan-de-fete)'),

                        Forms\Components\TextInput::make('destination')
                            ->label('Destination')
                            ->required()
                            ->helperText('URL de destination (ex: /plan-de-fete)'),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\TextEntry::make('slug')
                            ->label('Slug')
                            ->fontFamily('mono')
                            ->copyable(),

                        Components\TextEntry::make('destination')
                            ->label('Destination'),

                        Components\TextEntry::make('visits_count')
                            ->label('Total des visites'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),

                Tables\Columns\TextColumn::make('destination')
                    ->label('Destination')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('visits_count')
                    ->label('Visites')
                    ->sortable()
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordUrl(fn(QrCode $record): string => static::getUrl('view', ['record' => $record]))
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('slug');
    }

    public static function getWidgets(): array
    {
        return [
            QrVisitsChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQrCodes::route('/'),
            'create' => Pages\CreateQrCode::route('/create'),
            'view' => Pages\ViewQrCode::route('/{record}'),
            'edit' => Pages\EditQrCode::route('/{record}/edit'),
        ];
    }
}
