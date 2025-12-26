<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsSameDate
{
    /**
     * Rules:
     * - Return true if $a and $b are the same calendar date in their own timezones.
     * - Compare by formatting each as 'Y-m-d' using its own timezone.
     */
    public static function check(DateTimeInterface $a, DateTimeInterface $b): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}
