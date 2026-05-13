<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoVote extends Model
{
    protected $guarded = [];

    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class);
    }
}
