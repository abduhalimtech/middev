<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class NormalizeUniqueSortedSum
{
    /**
     * Rules:
     * - Keep only valid integers (int or int-string with trim allowed).
     * - Ignore invalid values (floats, float-strings, bool, null, arrays, objects, etc).
     * - Unique the integers.
     * - Sort ascending.
     * - Return the sum of the resulting integers.
     * - If none found => return 0.
     */
    public static function from(array $values): int
    {
        throw new \RuntimeException('Not implemented');
    }
}
