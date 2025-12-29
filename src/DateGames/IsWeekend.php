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
        $local = $dt->format('N');
        
        if($local >= 6){
            return true;
        }
        return false;
    }
}
