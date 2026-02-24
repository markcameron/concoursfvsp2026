<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Document extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;
    use SoftDeletes;

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
