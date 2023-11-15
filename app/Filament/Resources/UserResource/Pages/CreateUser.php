<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use App\Notifications\InformAccountCreated;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $this->record->create_token = Hash::make(Str::random(64));
        $this->record->save();
        $this->record->notify(new InformAccountCreated($this->record));
    }
}
