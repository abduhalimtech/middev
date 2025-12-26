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
        throw new \RuntimeException('Not implemented');
    }
}
