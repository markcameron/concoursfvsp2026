<?php

namespace App\Filament\Resources\PressItemResource\Pages;

use App\Filament\Resources\PressItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPressItem extends EditRecord
{
    protected static string $resource = PressItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
