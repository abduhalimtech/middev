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
        throw new \RuntimeException('Not implemented');
    }
}
