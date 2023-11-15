<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use App\Notifications\InformAccountCreated;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->afterFormValidated(function ($model) {
                    dd($model);
                })
                ->after(function ($model) {
                    dd($model);
                    $model->notify(new InformAccountCreated());
                }),
        ];
    }
}
