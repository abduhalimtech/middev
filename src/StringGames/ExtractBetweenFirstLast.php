<?php

declare(strict_types=1);

namespace App\StringGames;

final class ExtractBetweenFirstLast
{
    /**
     * Rules:
     * - Return substring between the FIRST occurrence of $start and the LAST occurrence of $end.
     * - Start and end markers are strings (non-empty).
     * - If $start not found OR $end not found OR start position >= last end position => return ''.
     * - Markers are not included.
     */
    public static function get(string $s, string $start, string $end): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
