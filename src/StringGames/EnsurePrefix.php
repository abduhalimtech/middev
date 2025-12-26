<?php

declare(strict_types=1);

namespace App\StringGames;

final class EnsurePrefix
{
    /**
     * Rules:
     * - If $s already starts with $prefix => return $s unchanged.
     * - Otherwise return $prefix . $s.
     * - If $prefix is empty => return $s.
     */
    public static function apply(string $s, string $prefix): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
