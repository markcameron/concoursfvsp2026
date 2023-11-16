<?php

namespace App\Enums;

enum StatusTask: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETE = 'complete';

    public function label(): string
    {
        return __('fields.status_task.' . strtolower($this->value));
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'info',
            self::IN_PROGRESS => 'warning',
            self::COMPLETE => 'success',
        };
    }
}
