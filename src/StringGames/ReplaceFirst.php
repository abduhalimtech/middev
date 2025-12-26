<?php

declare(strict_types=1);

namespace App\StringGames;

final class ReplaceFirst
{
    /**
     * Rules:
     * - Replace only the first occurrence of $search with $replace.
     * - If $search is empty OR not found => return original string.
     */
    public static function apply(string $s, string $search, string $replace): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
