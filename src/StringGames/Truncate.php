<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class Truncate
{
    /**
     * Rules:
     * - If strlen($s) <= $max => return $s unchanged.
     * - If $max < 3 => throw InvalidArgumentException.
     * - Otherwise return substr($s, 0, $max - 3) . '...'
     * - Special: if $max === 3 => return '...'
     */
    public static function apply(string $s, int $max): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
