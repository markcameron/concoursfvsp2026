<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusTask: string implements HasLabel, HasColor
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETE = 'complete';

    public function getLabel(): string
    {
        return __('fields.status_task.' . strtolower($this->value));
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'info',
            self::IN_PROGRESS => 'warning',
            self::COMPLETE => 'success',
        };
    }
}
