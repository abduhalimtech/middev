<?php

declare(strict_types=1);

namespace App\StringGames;

final class CollapseRepeats
{
    /**
     * Rules:
     * - Collapse consecutive repeating characters into a single character.
     * - Example: "aaabbc" => "abc"
     * - Works on byte strings (ASCII).
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
