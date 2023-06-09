<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'alias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label(__('fields.first_name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label(__('fields.last_name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alias')
                    ->label(__('fields.alias'))
                    ->required()
                    ->maxLength(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->label(__('fields.first_name'))->searchable(),
                Tables\Columns\TextColumn::make('last_name')->label(__('fields.last_name'))->searchable(),
                Tables\Columns\TextColumn::make('alias')->label(__('fields.alias'))->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
