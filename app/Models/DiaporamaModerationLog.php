<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiaporamaModerationLog extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'scores' => 'array',
        ];
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(DiaporamaSubmission::class, 'diaporama_submission_id');
    }
}
