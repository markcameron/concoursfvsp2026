<?php

namespace App\Filament\Resources\PhotoAlbumResource\Pages;

use App\Filament\Resources\PhotoAlbumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotoAlbum extends EditRecord
{
    protected static string $resource = PhotoAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
