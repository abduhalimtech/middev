<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class BusinessHoursWindow
{
    /**
     * Rules:
     * - Business hours are [09:00:00, 18:00:00) local time.
     * - If $dt is before 09:00 => return same date at 09:00.
     * - If $dt is within hours => unchanged.
     * - If $dt is >= 18:00 => return next day at 09:00.
     * - Preserve timezone.
     */
    public static function normalize(DateTimeImmutable $dt): DateTimeImmutable
    {
        $start = $dt->setTime(9,0,0);
        $end = $dt->setTime(18,0,0);
        if($dt < $start){
            return $start;
        }

        if ($dt >= $end) {
            return $dt->modify('+1 day')->setTime(9,0,0);
        }

        return $dt;

    }
}
