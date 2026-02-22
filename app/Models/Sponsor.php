<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Sponsor extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function sponsorLevel(): BelongsTo
    {
        return $this->belongsTo(SponsorLevel::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/png', 'image/jpeg', 'image/svg+xml']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('logo_small')
            ->height(62)
            ->nonOptimized()
            ->nonQueued();

        $this->addMediaConversion('logo_large')
            ->height(200)
            ->nonOptimized()
            ->nonQueued();
    }
}
