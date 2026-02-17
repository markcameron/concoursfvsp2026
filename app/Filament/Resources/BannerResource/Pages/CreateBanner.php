<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Models\Banner;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $banner = static::getModel()::create($data);

        if ($banner->is_active) {
            Banner::where('id', '!=', $banner->id)->update(['is_active' => false]);
        }

        return $banner;
    }
}
