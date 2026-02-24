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
            ->nonQueued()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo_large')
            ->height(200)
            ->nonQueued()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo_25')
            ->height(50)
            ->nonQueued()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo_40')
            ->height(75)
            ->nonQueued()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo_55')
            ->height(125)
            ->nonQueued()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo_75')
            ->height(200)
            ->nonQueued()
            ->keepOriginalImageFormat();
    }

    public function getImageUrl(string $collection, string $conversion = 'logo_small'): string
    {
        $media = $this->getFirstMedia($collection);

        if (!$media) {
            return '';
        }

        if ($media->mime_type === 'image/svg+xml') {
            return $media->getUrl();
        }

        return $media->hasGeneratedConversion($conversion)
            ? $media->getUrl($conversion)
            : $media->getUrl();
    }
}
