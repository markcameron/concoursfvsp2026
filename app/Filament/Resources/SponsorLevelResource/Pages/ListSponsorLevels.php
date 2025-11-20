<?php

namespace App\Filament\Resources\SponsorLevelResource\Pages;

use App\Filament\Resources\SponsorLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSponsorLevels extends ListRecords
{
    protected static string $resource = SponsorLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
