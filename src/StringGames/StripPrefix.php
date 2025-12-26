<?php

declare(strict_types=1);

namespace App\StringGames;

final class StripPrefix
{
    /**
     * Rules:
     * - If $s starts with $prefix => remove it.
     * - Otherwise return $s unchanged.
     * - If $prefix is empty => return $s.
     */
    public static function apply(string $s, string $prefix): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
