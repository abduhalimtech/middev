<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsWeekend
{
    /**
     * Rules:
     * - Return true if Saturday or Sunday.
     */
    public static function check(DateTimeInterface $dt): bool
    {
        if(in_array($dt->format('N'), [6,7])){
            return true;
        }else{
            return false;
        }
    }
}
