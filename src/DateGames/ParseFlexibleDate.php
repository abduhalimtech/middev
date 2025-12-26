<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;
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
        throw new \RuntimeException('Not implemented');
    }

    private static function parse(string $input): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}
