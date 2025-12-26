<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddDaysSkippingHolidays
{
    /**
     * Rules:
     * - Add $days calendar days to $dt (can be 0 or positive).
     * - After adding: if resulting date is a holiday (Y-m-d in $holidays),
     *   move forward by +1 day repeatedly until not a holiday.
     * - Preserve timezone and time.
     */
    public static function add(DateTimeImmutable $dt, int $days, array $holidays): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}
