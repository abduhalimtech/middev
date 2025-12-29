<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class StartOfWeekMonday
{
    /**
     * Rules:
     * - Return the Monday of the same week as $dt (ISO week: Monday is first day).
     * - Set time to 00:00:00.
     * - Preserve timezone.
     */
    public static function from(DateTimeImmutable $dt): DateTimeImmutable
    {
        // 1. Jump to Monday
        // 'monday this week' is smart: if today is Sunday, it goes back to Monday.
        $monday = $dt->modify('monday this week');

        // 2. Reset clock to midnight
        return $monday->setTime(0, 0, 0);
    }
}
