<?php

namespace App\Support;

use Carbon\Carbon;

class Helpers {
    public static function formatDateRange(
        ?Carbon $start,
        ?Carbon $end,
        string $dateFormat = "ddd D MMM, YYYY",
        string $timeFormat = "HH:mm",
    ) {
        $dateTimeFormat = $dateFormat . ' ' . $timeFormat;

        $format = $dateTimeFormat;

        if ($start->isSameDay($end)) {
            return collect([
                $start->isoFormat($format),
                $end->isoFormat($timeFormat),
            ])->implode('-');
        }

        return $start->isoFormat($format) . ' - ' . $end->isoFormat($format);
    }
}
