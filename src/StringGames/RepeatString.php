<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class RepeatString
{
    /**
     * Rules:
     * - Repeat $s exactly $times times.
     * - If $times < 0 => throw InvalidArgumentException.
     * - If $times === 0 => return ''.
     */
    public static function make(string $s, int $times): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
