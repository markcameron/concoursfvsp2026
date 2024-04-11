<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Actions;
use Filament\Forms\Form;
use App\Models\Committee;
use Filament\Tables\Table;
use App\Services\UserService;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Support\Collection;
use App\Filament\Imports\UserImporter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'Utilisateur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
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
                        Forms\Components\TextInput::make('email')
                            ->label(__('fields.email'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label(__('fields.email_verified_at'))
                            ->timezone('Europe/Zurich')
                            ->hiddenOn(['edit', 'create']),
                        Forms\Components\Select::make('roles')
                            ->label(__('fields.roles'))
                            ->multiple()
                            ->relationship('roles', 'name'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([

                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('full_name')
                            ->label(__('fields.full_name'))
                            ->searchable()
                            ->sortable()
                            ->weight('medium')
                            ->alignLeft(),

                        Tables\Columns\TextColumn::make('email')
                            ->label(__('fields.email'))
                            ->searchable()
                            ->color('gray')
                            ->alignLeft(),
                    ]),

                    Tables\Columns\TextColumn::make('alias')
                        ->label(__('fields.alias'))
                        ->badge()
                        ->searchable(),

                    Tables\Columns\TextColumn::make('committees.name')
                        ->label(__('fields.committees'))
                        ->limitList(3)
                        ->badge()
                        ->color(fn (string $state) => Color::all()[Committee::where('name', $state)->first()->color]),
                ]),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(UserImporter::class)
                    ->visible(fn () => auth()->user()->hasRole('Super Admin')),
            ])
            ->actions([
                Tables\Actions\Action::make('E-mail')
                    ->iconButton()
                    ->icon('heroicon-o-envelope')
                    ->url(fn (User $record) => 'mailto:'. $record->email),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\BulkAction::make('informAccountCreated')
                        ->action(fn (Collection $collection) => $collection->each(
                            fn (User $user) => resolve(UserService::class)->informAccountCreated($user)
                        ))
                        ->visible(fn () => auth()->user()->can('create-user'))
                        ->deselectRecordsAfterCompletion(),
                ])
            ])
            ->defaultSort('last_name', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
