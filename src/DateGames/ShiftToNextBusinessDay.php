<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class ShiftToNextBusinessDay
{
    /**
     * Rules:
     * - Business day = Mon-Fri and not holiday.
     * - Holidays are Y-m-d strings.
     * - If $dt is already business day => return unchanged (keep time).
     * - Else move forward day-by-day until business day.
     * - Preserve timezone.
     */
    public static function shift(DateTimeImmutable $dt, array $holidays): DateTimeImmutable
    {
        while (true) {
            // 1. Check Weekend (6 = Sat, 7 = Sun)
            $n = (int)$dt->format('N');
            if ($n >= 6) {
                $dt = $dt->modify('+1 day');
                continue; // Loop again to check if the NEW day is valid
            }

            // 2. Check Holiday
            $dateString = $dt->format('Y-m-d');
            if (in_array($dateString, $holidays, true)) {
                $dt = $dt->modify('+1 day');
                continue; // Loop again
            }

            // If we survived both checks, we found a business day!
            return $dt;
        }
    }
}
