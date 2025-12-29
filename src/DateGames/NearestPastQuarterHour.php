<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NearestPastQuarterHour
{
    /**
     * Rules:
     * - Round DOWN to nearest past 15-minute mark.
     * - Seconds must become 00.
     * - Example: 10:14:59 => 10:00:00
     *           10:15:00 => 10:15:00
     *           10:29:10 => 10:15:00
     * - Preserve date and timezone.
     */
    public static function round(DateTimeImmutable $dt): DateTimeImmutable
    {
        $minute =(int)$dt->format('i');
        $block = $minute % 15;
        $newMinute = $minute - $block;

        return $dt->setTime((int)$dt->format('H'), $newMinute, 0);
    
    }
}
