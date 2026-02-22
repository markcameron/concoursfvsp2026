<?php

namespace App\Models;

use App\Enums\VariableType;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => VariableType::class,
        ];
    }

    public function getValueAttribute(mixed $value): mixed
    {
        return match ($this->type) {
            VariableType::BOOL => (bool) $value,
            VariableType::INT => (int) $value,
            VariableType::STRING, VariableType::TEXT => $value,
            default => $value,
        };
    }

    public function setValueAttribute(mixed $value): void
    {
        $this->attributes['value'] = match ($this->type) {
            VariableType::BOOL => $value === 'true' ? '1' : '0',
            VariableType::INT => (string) $value,
            VariableType::STRING, VariableType::TEXT => $value,
            default => $value,
        };
    }
}
