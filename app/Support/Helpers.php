<?php

namespace App\Support;

use Carbon\Carbon;

class Helpers {
    public static function formatDateRange(
        ?Carbon $start,
        ?Carbon $end,
        string $dateFormat = "ddd D MMM, YYYY",
        string $timeFormat = "HH:mm",
        string $timezone = 'Europe/Zurich',
    ) {
        $dateTimeFormat = $dateFormat . ' ' . $timeFormat;

        $format = $dateTimeFormat;

        if ($start->isSameDay($end)) {
            return collect([
                $start->timezone($timezone)->isoFormat($format),
                $end->timezone($timezone)->isoFormat($timeFormat),
            ])->implode('-');
        }

        return collect([
            $start->timezone($timezone)->isoFormat($format),
            $end->timezone($timezone)->isoFormat($format),
        ])->implode('-');
    }
}
