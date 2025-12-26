<?php

declare(strict_types=1);

namespace App\StringGames;

final class RemoveVowels
{
    /**
     * Rules:
     * - Remove vowels a,e,i,o,u (case-insensitive).
     * - Return remaining string unchanged otherwise.
     */
    public static function apply(string $s): string
    {
        $vowels = ['a', 'e', 'i', 'o', 'u'];
        return str_ireplace($vowels,'', $s);
    }
}
