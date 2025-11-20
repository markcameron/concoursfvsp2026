<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SponsorLevelColors: string implements HasLabel, HasColor
{
    case HOSE_25 = 'black';
    case HOSE_45 = 'green';
    case HOSE_55 = 'orange';
    case HOSE_70 = 'yellow';

    public function getLabel(): string
    {
        return __('enums.sponsor_level_colors.' . strtolower($this->value));
    }

    public function getColor(): string
    {
        return match ($this) {
            self::HOSE_25 => 'black',
            self::HOSE_45 => 'green',
            self::HOSE_55 => 'orange',
            self::HOSE_70 => 'yellow',
        };
    }
}
