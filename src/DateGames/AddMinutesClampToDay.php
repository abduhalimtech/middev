<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddMinutesClampToDay
{
    /**
     * Rules:
     * - Add $minutes to $dt.
     * - If result crosses into a different calendar date (local Y-m-d),
     *   clamp to 23:59:59 of the original date.
     * - Preserve timezone.
     */
    public static function add(DateTimeImmutable $dt, int $minutes): DateTimeImmutable
    {
        $proposed = $dt->modify(sprintf('%+d minutes', $minutes));
        if($proposed->format('Y-m-d') !== $dt->format('Y-m-d')){
            return $dt->setTime(23,59,59);

        }
        return $proposed;
    }
}
