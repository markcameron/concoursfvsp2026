<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([

                        Forms\Components\TextInput::make('machine_name')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\Section::make('SEO')
                            ->collapsed()
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Titre SEO')
                                    ->placeholder(fn($get) => $get('title'))
                                    ->maxLength(60)
                                    ->helperText('Laissez vide pour utiliser le titre de la page. Maximum 60 caractères.'),

                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Description SEO')
                                    ->maxLength(160)
                                    ->rows(3)
                                    ->helperText('Laissez vide pour utiliser la description par défaut. Maximum 160 caractères.'),
                            ]),

                        Forms\Components\Builder::make('content')
                            ->blocks([

                                Builder\Block::make('markdown')
                                    ->label('Texte libre')
                                    ->schema([
                                        Forms\Components\MarkdownEditor::make('body')
                                            ->label('Texte')
                                            ->required(),
                                    ]),

                                Builder\Block::make('markdown_intro_centered')
                                    ->label('Texte libre centré')
                                    ->schema([
                                        Forms\Components\MarkdownEditor::make('body')
                                            ->label('Texte')
                                            ->required(),
                                    ]),

                                Builder\Block::make('download_file')
                                    ->label('Bloc avec fichier à télécharger')
                                    ->schema([
                                        Forms\Components\Select::make('orientation')
                                            ->label('Orientation du bloc')
                                            ->options([
                                                'left' => 'Texte à gauche',
                                                'right' => 'Texte à droite',
                                                'top' => 'Texte en haut',
                                            ])
                                            ->default('left')
                                            ->required(),

                                        Forms\Components\TextInput::make('title')
                                            ->label('Titre')
                                            ->required(),

                                        Forms\Components\MarkdownEditor::make('body')
                                            ->label('Texte')
                                            ->required(),

                                        Forms\Components\TextInput::make('button_text')
                                            ->label('Texte du bouton')
                                            ->required(),

                                        FileUpload::make('file')
                                            ->label('Fichier')
                                            ->preserveFilenames()
                                            ->directory('sponsor_info')
                                            ->required()
                                            ->disk('front')
                                            ->downloadable(),
                                    ]),

                                Builder\Block::make('text_with_link')
                                    ->label('Bloc avec lien')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Titre')
                                            ->required(),

                                        Forms\Components\MarkdownEditor::make('body')
                                            ->label('Texte')
                                            ->required(),

                                        Forms\Components\TextInput::make('button_text')
                                            ->label('Texte du bouton')
                                            ->required(),

                                        Forms\Components\TextInput::make('url')
                                            ->label('URL')
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->required(),
                                    ]),

                                Builder\Block::make('section_people')
                                    ->label('Bloc avec personnes')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Titre de la section')
                                            ->required(),

                                        Forms\Components\Repeater::make('people')
                                            ->grid(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('last_name')
                                                    ->required(),

                                                Forms\Components\TextInput::make('first_name')
                                                    ->required(),

                                                Forms\Components\TextInput::make('role'),

                                                Forms\Components\TextInput::make('email')
                                                    ->email(),

                                                FileUpload::make('photo')
                                                    ->directory('section_people')
                                                    ->disk('front')
                                                    ->visibility('public')
                                                    ->image()
                                                    ->imageResizeMode('cover')
                                                    ->imageCropAspectRatio('4:5')
                                                    ->imageResizeTargetWidth('328')
                                                    ->imageResizeTargetHeight('410'),
                                            ])
                                            ->columns(1),
                                    ]),

                                Builder\Block::make('program')
                                    ->label('Bloc avec programme')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required(),

                                        Forms\Components\Repeater::make('friday')
                                            ->schema([
                                                Forms\Components\TimePicker::make('time')
                                                    ->seconds(false),

                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                            ])
                                            ->columns(2),

                                        Forms\Components\Repeater::make('saturday')
                                            ->schema([
                                                Forms\Components\TimePicker::make('time')
                                                    ->seconds(false),

                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                            ])
                                            ->columns(2),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
