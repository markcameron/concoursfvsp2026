<?php

namespace App\Filament\Resources;

use App\Enums\ContactType;
use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $modelLabel = 'Message';

    protected static ?string $pluralModelLabel = 'Messages';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label(__('fields.type'))
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('company_name')
                    ->label(__('fields.company_name'))
                    ->searchable()
                    ->sortable()
                    ->visible(fn (Contact $contact) => ! empty($contact->company_name)),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('fields.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('fields.email'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('telephone')
                    ->label(__('fields.telephone'))
                    ->searchable()
                    ->visible(fn (Contact $contact) => ! empty($contact->telephone)),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('fields.message'))
                    ->limit(50)
                    ->visible(fn (Contact $contact) => ! empty($contact->message)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('fields.type'))
                    ->options(ContactType::class),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\TextEntry::make('type')
                            ->label(__('fields.type'))
                            ->badge(),

                        Components\TextEntry::make('company_name')
                            ->label(__('fields.company_name'))
                            ->visible(fn (Contact $contact) => ! empty($contact->company_name)),

                        Components\TextEntry::make('name')
                            ->label(__('fields.name')),

                        Components\TextEntry::make('email')
                            ->label(__('fields.email')),

                        Components\TextEntry::make('telephone')
                            ->label(__('fields.telephone'))
                            ->visible(fn (Contact $contact) => ! empty($contact->telephone)),
                    ])->columns(2),

                Components\Section::make(__('fields.message'))
                    ->schema([
                        Components\TextEntry::make('message')
                            ->prose()
                            ->hiddenLabel(),
                    ])
                    ->visible(fn (Contact $contact) => ! empty($contact->message))
                    ->collapsible(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
