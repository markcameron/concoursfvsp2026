<?php

namespace App\Listeners;

use App\Models\Photo;
use App\Services\ExifExtractor;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class ExtractPhotoExif
{
    public function __construct(private readonly ExifExtractor $extractor) {}

    public function handle(MediaHasBeenAddedEvent $event): void
    {
        $media = $event->media;

        if ($media->collection_name !== 'photo' || ! ($media->model instanceof Photo)) {
            return;
        }

        $exif = $this->extractor->extract($media->getPath());

        if ($exif) {
            $media->model->update(['exif_data' => $exif]);
        }
    }
}
