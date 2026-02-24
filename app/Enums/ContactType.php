<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContactType: string implements HasColor, HasLabel
{
    case CONTACT = 'contact';
    case SPONSORING = 'sponsoring';
    case TUG_OF_WAR = 'tug-of-war';
    case HOUSING = 'housing';

    public function getLabel(): string
    {
        return __('enums.contact_type.' . str_replace('-', '_', $this->value));
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CONTACT => 'info',
            self::SPONSORING => 'danger',
            self::TUG_OF_WAR => 'success',
            self::HOUSING => 'warning',
        };
    }
}
