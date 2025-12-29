<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class ShiftToBusinessDayAtNine
{
    /**
     * Rules:
     * - Business day = not weekend (Sat/Sun) and not holiday.
     * - Holidays are date-only strings: ['YYYY-MM-DD', ...]
     * - If input date is business day => return same date at 09:00:00
     * - Else move forward day-by-day until business day => return at 09:00:00
     * - Preserve timezone.
     */
    public static function shift(DateTimeImmutable $dt, array $holidays): DateTimeImmutable
    {
        // 1. Run the loop to find the correct Date
        while (true) {
            // Check Weekend
            if ((int)$dt->format('N') >= 6) {
                $dt = $dt->modify('+1 day');
                continue;
            }

            // Check Holiday
            if (in_array($dt->format('Y-m-d'), $holidays, true)) {
                $dt = $dt->modify('+1 day');
                continue;
            }

            // Found it. Stop looking.
            break;
        }

        // 2. Set the Time (Requirement: Always return at 09:00:00)
        return $dt->setTime(9, 0, 0);
    }
}
