<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddBusinessDays
{
    /**
     * Rules:
     * - Add $days business days to $dt.
     * - Business day = Mon-Fri and not a holiday.
     * - Holidays are date-only strings Y-m-d.
     * - $days can be negative (go backwards).
     * - Preserve time and timezone.
     */
    public static function add(DateTimeImmutable $dt, int $days, array $holidays): DateTimeImmutable
    {
        if($days === 0){
            return $dt;
        }
        if($days > 0){
            $direction = '+1 days';
        }else{
            $direction = '-1 days';
        }
        
        $steps = abs($days);
        $current = $dt;
        while($steps > 0){
            $current = $current->modify($direction);
            if($current->format('N') >= 6){
                continue;
            }
            if(in_array($current->format('Y-m-d'), $holidays, true)){
                continue;
            }

            $steps -- ;
        }
        return $current;
    }
}
