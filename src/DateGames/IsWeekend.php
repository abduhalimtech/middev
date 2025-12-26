<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsWeekend
{
    /**
     * Rules:
     * - Return true if Saturday or Sunday in the given date's timezone.
     */
    public static function check(DateTimeInterface $dt): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}
