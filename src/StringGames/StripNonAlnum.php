<?php

declare(strict_types=1);

namespace App\StringGames;

final class StripNonAlnum
{
    /**
     * Rules:
     * - Keep only ASCII letters and digits [A-Za-z0-9].
     * - Remove everything else (spaces, dashes, underscores, punctuation).
     * - Return resulting string (no extra trimming needed because removed).
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
