<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NextMondayIfWeekend
{
    /**
     * Rules:
     * - If dt is Sat/Sun => move forward to next Monday (same timezone), keep time same.
     * - Otherwise return unchanged.
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
        $day = (int) $dt->format('N');

        if ($day === 6) {          // Saturday → +2 days
            return $dt->modify('+2 days');
        }

        if ($day === 7) {          // Sunday → +1 day
            return $dt->modify('+1 day');
        }

        return $dt;

    }
}
