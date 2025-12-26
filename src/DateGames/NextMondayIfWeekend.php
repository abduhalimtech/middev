<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NextMondayIfWeekend
{
    /**
     * Rules:
     * - If $dt is Saturday or Sunday => move forward to next Monday.
     * - Keep time.
     * - Preserve timezone.
     * - If already Mon-Fri => unchanged.
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}
