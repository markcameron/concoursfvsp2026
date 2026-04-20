<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DiaporamaSubmission extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'moderation_scores' => 'array',
        ];
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('status', 'approved');
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }

    public function scopeFlagged(Builder $query): void
    {
        $query->where('status', 'flagged');
    }

    public function scopeRejected(Builder $query): void
    {
        $query->where('status', 'rejected');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(DiaporamaVote::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(DiaporamaReport::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('display')
            ->width(1200)
            ->nonQueued()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('thumb')
            ->height(80)
            ->nonQueued()
            ->keepOriginalImageFormat();
    }
}
