<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SponsorType: string implements HasLabel
{
    case COMMUNE = 'commune';
    case LIVRET_FETE = 'livret_fete';
    case PARRAINAGE = 'parrainage';

    public function getLabel(): string
    {
        return __('enums.sponsor_type.'.$this->value);
    }
}
