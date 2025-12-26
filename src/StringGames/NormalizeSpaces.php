<?php

declare(strict_types=1);

namespace App\StringGames;

final class NormalizeSpaces
{
    /**
     * Rules:
     * - Convert any whitespace runs (space, tab, new line) to single space.
     * - Trim leading/trailing spaces.
     */
    public static function apply(string $s): string
    {
        return trim(preg_replace('/\s+/', ' ', $s));
    }
}
