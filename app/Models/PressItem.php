<?php

namespace App\Models;

use App\Enums\PressItemType;
use Illuminate\Database\Eloquent\Model;

class PressItem extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => PressItemType::class,
            'active' => 'boolean',
            'sort_order' => 'int',
        ];
    }
}
