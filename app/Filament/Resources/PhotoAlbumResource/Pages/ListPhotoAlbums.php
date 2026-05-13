<?php

namespace App\Filament\Resources\PhotoAlbumResource\Pages;

use App\Filament\Resources\PhotoAlbumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhotoAlbums extends ListRecords
{
    protected static string $resource = PhotoAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
