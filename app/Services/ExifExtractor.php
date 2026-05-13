<?php

namespace App\Services;

class ExifExtractor
{
    /**
     * Extract and normalize EXIF data from an image file path.
     *
     * @return array<string, mixed>|null
     */
    public function extract(string $filePath): ?array
    {
        if (! file_exists($filePath) || ! is_readable($filePath)) {
            return null;
        }

        $raw = @exif_read_data($filePath, 'ANY_TAG', false);

        if ($raw === false) {
            return null;
        }

        return array_filter([
            'camera' => $this->camera($raw),
            'lens' => $this->lens($raw),
            'aperture' => $this->aperture($raw),
            'shutter_speed' => $this->shutterSpeed($raw),
            'iso' => $this->iso($raw),
            'focal_length' => $this->focalLength($raw),
            'taken_at' => $this->takenAt($raw),
            'width' => $raw['COMPUTED']['Width'] ?? null,
            'height' => $raw['COMPUTED']['Height'] ?? null,
        ], fn($v) => $v !== null && $v !== '');
    }

    /** @param array<string, mixed> $raw */
    private function camera(array $raw): ?string
    {
        $make = trim($raw['Make'] ?? '');
        $model = trim($raw['Model'] ?? '');

        if (! $model) {
            return $make ?: null;
        }

        // Avoid duplicating make in model string (e.g. "Canon Canon EOS R5")
        if ($make && ! str_starts_with($model, $make)) {
            return "{$make} {$model}";
        }

        return $model ?: null;
    }

    /** @param array<string, mixed> $raw */
    private function lens(array $raw): ?string
    {
        return trim($raw['LensModel'] ?? $raw['UndefinedTag:0xA434'] ?? '') ?: null;
    }

    /** @param array<string, mixed> $raw */
    private function aperture(array $raw): ?string
    {
        $value = $raw['COMPUTED']['ApertureFNumber'] ?? null;

        if ($value) {
            return $value; // already formatted as "f/2.8"
        }

        $fnumber = $raw['FNumber'] ?? null;

        if ($fnumber && str_contains((string) $fnumber, '/')) {
            [$num, $den] = explode('/', $fnumber);

            if ($den != 0) {
                return 'f/' . rtrim(rtrim(number_format($num / $den, 1), '0'), '.');
            }
        }

        return null;
    }

    /** @param array<string, mixed> $raw */
    private function shutterSpeed(array $raw): ?string
    {
        $exposure = $raw['ExposureTime'] ?? null;

        if (! $exposure) {
            return null;
        }

        if (str_contains((string) $exposure, '/')) {
            return $exposure . 's';
        }

        $val = (float) $exposure;

        if ($val >= 1) {
            return rtrim(rtrim(number_format($val, 1), '0'), '.') . 's';
        }

        $den = (int) round(1 / $val);

        return "1/{$den}s";
    }

    /** @param array<string, mixed> $raw */
    private function iso(array $raw): ?int
    {
        $iso = $raw['ISOSpeedRatings'] ?? null;

        if (is_array($iso)) {
            $iso = $iso[0] ?? null;
        }

        return $iso ? (int) $iso : null;
    }

    /** @param array<string, mixed> $raw */
    private function focalLength(array $raw): ?string
    {
        $fl = $raw['FocalLength'] ?? null;

        if (! $fl) {
            return null;
        }

        if (str_contains((string) $fl, '/')) {
            [$num, $den] = explode('/', $fl);

            if ($den != 0) {
                return (int) round($num / $den) . 'mm';
            }
        }

        return (int) $fl . 'mm';
    }

    /** @param array<string, mixed> $raw */
    private function takenAt(array $raw): ?string
    {
        $dt = $raw['DateTimeOriginal'] ?? $raw['DateTime'] ?? null;

        if (! $dt) {
            return null;
        }

        try {
            // EXIF format: "YYYY:MM:DD HH:MM:SS"
            $carbon = \Carbon\Carbon::createFromFormat('Y:m:d H:i:s', $dt);

            return $carbon ? $carbon->toIso8601String() : null;
        } catch (\Throwable) {
            return null;
        }
    }
}
