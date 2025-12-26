<?php

declare(strict_types=1);

namespace App\StringGames;

final class QuoteCsvField
{
    /**
     * Rules:
     * - If field contains comma, double quote, or newline => must be CSV-quoted:
     *   - wrap with double quotes
     *   - double each internal double quote
     * - Otherwise return field unchanged.
     * - Works on byte strings.
     */
    public static function apply(string $field): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
