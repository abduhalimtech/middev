<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class SecondSmallestUniqueInt
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Valid integers:
     *   - int
     *   - string representing integer (spaces allowed), within PHP int range
     * - Ignore everything else.
     * - Consider UNIQUE integers only.
     * - Return second smallest unique integer.
     * - If fewer than 2 unique integers => throw InvalidArgumentException.
     */
    public static function from(array $values): int
    {
        throw new \RuntimeException('Not implemented');
    }
}
