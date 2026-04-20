<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModerationSetting extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'sexual_review' => 'float',
            'sexual_reject' => 'float',
            'sexual_minors_reject' => 'float',
            'violence_review' => 'float',
            'violence_reject' => 'float',
            'hate_review' => 'float',
            'hate_reject' => 'float',
            'harassment_review' => 'float',
            'harassment_reject' => 'float',
            'self_harm_review' => 'float',
            'self_harm_reject' => 'float',
            'illicit_review' => 'float',
            'illicit_reject' => 'float',
        ];
    }

    public static function current(): self
    {
        return static::firstOrCreate([]);
    }
}
