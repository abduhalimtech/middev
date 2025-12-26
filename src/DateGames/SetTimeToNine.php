<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class SetTimeToNine
{
    /**
     * Rules:
     * - Return $dt with time set to 09:00:00 in same timezone.
     * - Date stays unchanged.
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}
