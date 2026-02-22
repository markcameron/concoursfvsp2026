<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VariableType: string implements HasLabel
{
    case BOOL = 'bool';
    case STRING = 'string';
    case INT = 'int';
    case TEXT = 'text';

    public function getLabel(): string
    {
        return __('enums.variable_type.'.$this->value);
    }
}
