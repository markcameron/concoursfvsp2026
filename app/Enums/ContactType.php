<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContactType: string implements HasLabel, HasColor
{
    case CONTACT = 'contact';
    case SPONSORING = 'sponsoring';

    public function getLabel(): string
    {
        return __('enums.contact_type.' . strtolower($this->value));
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CONTACT => 'blue',
            self::SPONSORING => 'red',
        };
    }
}
