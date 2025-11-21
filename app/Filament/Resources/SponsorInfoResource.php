<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SponsorInfo;
use Filament\Resources\Resource;
use App\Filament\Clusters\Sponsoring;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SponsorInfoResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\SponsorInfoResource\RelationManagers;

class SponsorInfoResource extends Resource
{
    protected static ?string $model = SponsorInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Sponsoring::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Builder::make('content')
                            ->blocks([
                                Builder\Block::make('download_file')
                                    ->label('Download File Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Heading')
                                            ->required(),

                                        Forms\Components\MarkdownEditor::make('body')
                                            ->label('Body')
                                            ->required(),

                                        Forms\Components\TextInput::make('button_text')
                                            ->label('Button Text')
                                            ->required(),

                                        FileUpload::make('file')
                                            ->label('File')
                                            ->preserveFilenames()
                                            ->directory('files/sponsor_info')
                                            ->required()
                                            ->downloadable(),
                                    ]),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSponsorInfos::route('/'),
            'create' => Pages\CreateSponsorInfo::route('/create'),
            'edit' => Pages\EditSponsorInfo::route('/{record}/edit'),
        ];
    }
}
