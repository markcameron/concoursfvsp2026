<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Document extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    /**
     * Get the user that created the document.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the committees this document belongs to.
     */
    public function committees(): MorphToMany
    {
        return $this->morphedByMany(Committee::class, 'documentable');
    }

    /**
     * Get all of the events this document belongs to.
     */
    public function events(): MorphToMany
    {
        return $this->morphedByMany(Event::class, 'documentable');
    }
}
