<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class DiffInFullDays
{
    /**
     * Rules:
     * - Return absolute difference in FULL days between $a and $b.
     * - Time of day matters: use DateInterval->days (absolute).
     * - Example: 2025-01-01 23:00 to 2025-01-02 01:00 => 0 full days? Actually diff->days gives 0? No: it gives 0? (depends on interval)
     *   We avoid ambiguity by using DateTimeInterface::diff and taking ->days (absolute).
     */
    public static function between(DateTimeInterface $a, DateTimeInterface $b): int
    {
        $c = $a->diff($b)->days;
        return $c;
    }
}
