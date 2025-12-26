<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddBusinessDays
{
    /**
     * Rules:
     * - Add $days business days to $dt.
     * - Business day = Mon-Fri and not a holiday.
     * - Holidays are date-only strings Y-m-d.
     * - $days can be negative (go backwards).
     * - Preserve time and timezone.
     */
    public static function add(DateTimeImmutable $dt, int $days, array $holidays): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}
