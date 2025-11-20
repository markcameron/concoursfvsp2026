<?php

namespace App\Filament\Resources\SponsorInfoResource\Pages;

use App\Filament\Resources\SponsorInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSponsorInfo extends EditRecord
{
    protected static string $resource = SponsorInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
