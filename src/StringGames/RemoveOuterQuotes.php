<?php

declare(strict_types=1);

namespace App\StringGames;

final class RemoveOuterQuotes
{
    /**
     * Rules:
     * - If string starts and ends with the same quote char (single ' or double "),
     *   remove ONLY the outer pair.
     * - Otherwise return original.
     * - Works on byte strings.
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
