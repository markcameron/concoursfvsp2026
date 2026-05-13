<?php

namespace App\Filament\Resources\PressItemResource\Pages;

use App\Filament\Resources\PressItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPressItems extends ListRecords
{
    protected static string $resource = PressItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
