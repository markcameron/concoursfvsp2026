<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BannerColor: string implements HasColor, HasLabel
{
    case BLUE = 'blue';
    case RED = 'red';

    public function getLabel(): string
    {
        return __('enums.banner_color.'.$this->value);
    }

    public function getColor(): string
    {
        return match ($this) {
            self::BLUE => 'info',
            self::RED => 'danger',
        };
    }

    public function tailwindColor(): string
    {
        return match ($this) {
            self::BLUE => 'bg-theme-blue',
            self::RED => 'bg-theme-red',
        };
    }
}
