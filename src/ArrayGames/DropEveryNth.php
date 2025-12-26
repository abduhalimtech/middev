<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class DropEveryNth
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Drop every N-th element (1-indexed).
     *   N=2 drops 2nd, 4th, 6th...
     * - Reindex output.
     * - If N <= 0 => throw InvalidArgumentException.
     */
    public static function apply(array $values, int $n): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
