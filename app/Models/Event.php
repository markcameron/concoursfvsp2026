<?php

namespace App\Models;

use App\Support\Helpers;
use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Event extends Model
{
    use HasFactory;
    use HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'started_at',
        'ended_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Get all of the users for this event.
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable');
    }

    /**
     * Get all of the documents for this event.
     */
    public function documents(): MorphToMany
    {
        return $this->morphToMany(Document::class, 'documentable');
    }

    /**
     * @return Attribute<string, never>
     */
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value): string => Helpers::formatDateRange($this->started_at, $this->ended_at),
        );
    }

    /**
     * @return Attribute<int, never>
     */
    protected function participantCount(): Attribute
    {
        return Attribute::make(
            get: fn ($value): int => $this->users->count(),
        );
    }
}
