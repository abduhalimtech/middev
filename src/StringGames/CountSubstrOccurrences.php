<?php

declare(strict_types=1);

namespace App\StringGames;

final class CountSubstrOccurrences
{
    /**
     * Rules:
     * - Count occurrences of $needle in $haystack.
     * - Overlapping is NOT allowed (use next search after the end of last match).
     * - If $needle is empty => return 0.
     */
    public static function count(string $haystack, string $needle): int
    {
        throw new \RuntimeException('Not implemented');
    }
}
