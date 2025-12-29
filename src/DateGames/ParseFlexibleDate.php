<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;

final class ParseFlexibleDate
{
    /**
     * Rules:
     * - Accept formats:
     *   1) "YYYY-MM-DD"
     *   2) "DD.MM.YYYY"
     *   3) "YYYY/MM/DD"
     * - Reject invalid dates (e.g. 2025-02-30)
     * - Return normalized "Y-m-d"
     * - Use timezone "UTC" for parsing (output is date-only anyway).
     */
    public static function normalize(string $input): string
    {
        $dt = self::parse($input);
        return $dt->format('Y-m-d');
    }

    private static function parse(string $input): DateTimeImmutable
    {
        $formats = ['Y-m-d', 'd.m.Y', 'Y/m/d'];
        foreach ($formats as $f) {
            $current = DateTimeImmutable::createFromFormat($f, $input, new DateTimeZone('UTC'));
            if($current ===false){
                continue;
            }
            if($current->format($f) === $input){
                return $current->setTime(0,0,0);
            }

        }
        throw new InvalidArgumentException();
    }

}
