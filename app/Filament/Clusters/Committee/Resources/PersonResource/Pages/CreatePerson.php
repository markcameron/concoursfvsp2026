<?php

namespace App\Filament\Clusters\Committee\Resources\PersonResource\Pages;

use App\Filament\Clusters\Committee\Resources\PersonResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePerson extends CreateRecord
{
    protected static string $resource = PersonResource::class;
}
