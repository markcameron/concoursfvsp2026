<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Models\Banner;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['starts_at'])) {
            $data['starts_at'] = \Carbon\Carbon::parse($data['starts_at']);
        }
        if (isset($data['ends_at'])) {
            $data['ends_at'] = \Carbon\Carbon::parse($data['ends_at']);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->record->is_active) {
            Banner::where('id', '!=', $this->record->id)->update(['is_active' => false]);
        }
    }
}
