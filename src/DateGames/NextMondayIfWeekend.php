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
        $local = $dt->format('N');

        if($local == 6){
            return $dt->modify('+2 days');
        }
        if($local == 7){
            return $dt->modify('+1 day');
        }
        return $dt;
    }
}
