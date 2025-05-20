<?php

namespace App\Filament\Actions\Header;

use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DocumentDownloadAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'download';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('fields.download'));

        $this->color('info');

        $this->icon('heroicon-o-arrow-down-tray');

        $this->hidden(static function (Model $record): bool {
            return !$record->hasMedia();
        });

        $this->action(function (): BinaryFileResponse {
            $media = $this->process(function (array $data, Model $record) {
                return $record->getFirstMedia();
            });

            return response()->download($media->getPath());
        });
    }
}
