<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NormalizeToDateOnly
{
    /**
     * Rules:
     * - Return the same date in same timezone but time set to 00:00:00
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
       return $dt->setTime(0, 0, 0);
    }
}
