<?php

declare(strict_types=1);

namespace App\StringGames;

final class WrapWords
{
    /**
     * Rules:
     * - Normalize spaces in input (any whitespace -> single space, trim).
     * - Wrap words into lines of max length $width.
     * - Words are separated by spaces; do not split a word.
     * - If a single word length > $width, keep it on its own line (even if exceeds).
     * - Return lines joined by "\n".
     * - width must be >= 1.
     */
    public static function wrap(string $s, int $width): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
