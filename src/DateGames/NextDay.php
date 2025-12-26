<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NextDay
{
    /**
     * Rules:
     * - Return $dt moved by +1 day (same time).
     * - Preserve timezone.
     */
    public static function from(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}
