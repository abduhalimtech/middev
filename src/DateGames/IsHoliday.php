<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsHoliday
{
    /**
     * Rules:
     * - Holidays: array of date-only strings ['Y-m-d', ...]
     * - Return true if $dt's local date (Y-m-d in its timezone) is in holidays.
     */
    public static function check(DateTimeInterface $dt, array $holidays): bool
    {
        $local = $dt->format('Y-m-d');
        if(in_array($local, $holidays)){
            return true;
        }
        return false;
    
    }
}
