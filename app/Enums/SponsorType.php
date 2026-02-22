<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SponsorType: string implements HasColor, HasLabel
{
    case COMMUNE = 'commune';
    case PARRAINAGE = 'parrainage';
    case LIVRET_FETE = 'livret_fete';

    public function getLabel(): string
    {
        return __('enums.sponsor_type.'.$this->value);
    }

    public function getColor(): string
    {
        return match ($this) {
            self::COMMUNE => 'success',
            self::PARRAINAGE => 'info',
            self::LIVRET_FETE => 'warning',
        };
    }
}
