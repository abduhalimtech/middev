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
        throw new \RuntimeException('Not implemented');
    }
}
