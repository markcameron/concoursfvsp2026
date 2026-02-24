<?php

namespace App\Filament\Resources;

use App\Enums\VariableType;
use App\Filament\Clusters\Settings;
use App\Filament\Resources\VariableResource\Pages;
use App\Models\Variable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VariableResource extends Resource
{
    protected static ?string $cluster = Settings::class;

    protected static ?string $model = Variable::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';

    protected static ?string $modelLabel = 'Variable';

    protected static ?string $pluralModelLabel = 'Variables';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Clé')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->alphaDash()
                            ->helperText('Utilisez des tirets pour les espaces (ex: mon_parametre)'),

                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->required()
                            ->options(VariableType::class)
                            ->live(),

                        Forms\Components\TextInput::make('value')
                            ->label('Valeur')
                            ->visible(fn(Forms\Get $get) => $get('type') !== VariableType::TEXT && $get('type') !== null)
                            ->visible(fn(Forms\Get $get) => $get('type') !== VariableType::BOOL)
                            ->numeric(fn(Forms\Get $get) => $get('type') === VariableType::INT)
                            ->required(fn(Forms\Get $get) => $get('type') !== VariableType::TEXT),

                        Forms\Components\Toggle::make('value')
                            ->label('Valeur')
                            ->visible(fn(Forms\Get $get) => $get('type') === VariableType::BOOL)
                            ->required(fn(Forms\Get $get) => $get('type') === VariableType::BOOL),

                        Forms\Components\Textarea::make('value')
                            ->label('Valeur')
                            ->visible(fn(Forms\Get $get) => $get('type') === VariableType::TEXT)
                            ->required(fn(Forms\Get $get) => $get('type') === VariableType::TEXT)
                            ->rows(3),

                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->nullable(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Clé')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Valeur')
                    ->limit(50)
                    ->formatStateUsing(fn(Variable $record): string => match ($record->type) {
                        VariableType::BOOL => $record->value ? 'Oui' : 'Non',
                        default => (string) $record->value,
                    }),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options(VariableType::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('key');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVariables::route('/'),
            'create' => Pages\CreateVariable::route('/create'),
            'edit' => Pages\EditVariable::route('/{record}/edit'),
        ];
    }
}
