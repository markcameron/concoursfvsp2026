<?php

namespace App\Console\Commands;

use App\Models\Photo;
use App\Models\PhotoAlbum;
use Illuminate\Console\Command;

class ImportPhotos extends Command
{
    protected $signature = 'photos:import
                            {album : Album ID or slug}
                            {path : Absolute path to a folder of images}
                            {--photographer= : Photographer name applied to all imported photos}';

    protected $description = 'Import images from a folder on disk into a photo album';

    public function handle(): int
    {
        $albumIdentifier = $this->argument('album');
        $folderPath = rtrim($this->argument('path'), '/');

        $album = PhotoAlbum::where('id', $albumIdentifier)
            ->orWhere('slug', $albumIdentifier)
            ->first();

        if (! $album) {
            $this->error("Album not found: {$albumIdentifier}");

            return self::FAILURE;
        }

        if (! is_dir($folderPath) || ! is_readable($folderPath)) {
            $this->error("Path is not a readable directory: {$folderPath}");

            return self::FAILURE;
        }

        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'JPG', 'JPEG', 'PNG', 'WEBP'];
        $files = [];

        foreach ($extensions as $ext) {
            foreach (glob("{$folderPath}/*.{$ext}") ?: [] as $file) {
                $files[] = $file;
            }
        }

        $files = array_unique($files);
        sort($files);

        if (empty($files)) {
            $this->warn("No image files found in: {$folderPath}");

            return self::SUCCESS;
        }

        $photographer = $this->option('photographer');
        $imported = 0;
        $failed = 0;
        $nextSortOrder = (int) $album->photos()->max('sort_order') + 1;

        $this->info('Importing ' . count($files) . " photo(s) into album \"{$album->title}\"...");

        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $filePath) {
            try {
                $title = pathinfo($filePath, PATHINFO_FILENAME);

                $photo = Photo::create([
                    'photo_album_id' => $album->id,
                    'title' => $title,
                    'photographer_name' => $photographer,
                    'sort_order' => $nextSortOrder++,
                ]);

                $photo->addMedia($filePath)
                    ->preservingOriginal()
                    ->toMediaCollection('photo');

                $imported++;
            } catch (\Throwable $e) {
                $failed++;
                $this->newLine();
                $this->warn('Failed to import ' . basename($filePath) . ': ' . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Done. Imported {$imported} photo(s) into album \"{$album->title}\"." . ($failed > 0 ? " {$failed} failed." : ''));

        return self::SUCCESS;
    }
}
