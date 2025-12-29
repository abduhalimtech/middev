<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class EndOfMonth
{
    /**
     * Rules:
     * - Return the last day of the month of $dt at 23:59:59.
     * - Preserve timezone.
     * - Must correctly handle leap years (e.g., Feb 2024 has 29 days).
     */
    public static function for(DateTimeImmutable $dt): DateTimeImmutable
    {
        $local = $dt->modify('last day of this month');
        $set = $local->setTime(23,59,59);
        return $set;
    }
}
