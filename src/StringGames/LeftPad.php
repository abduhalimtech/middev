<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class LeftPad
{
    /**
     * Rules:
     * - Left pad $s with $padChar until strlen($s) == $len.
     * - If strlen($s) >= $len => return $s unchanged.
     * - $padChar must be exactly 1 byte char, otherwise throw InvalidArgumentException.
     * - $len must be >= 0.
     */
    public static function apply(string $s, int $len, string $padChar): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
