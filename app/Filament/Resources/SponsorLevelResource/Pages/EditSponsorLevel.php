<?php

namespace App\Filament\Resources\SponsorLevelResource\Pages;

use App\Filament\Resources\SponsorLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSponsorLevel extends EditRecord
{
    protected static string $resource = SponsorLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
