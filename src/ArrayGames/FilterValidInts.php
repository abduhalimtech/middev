<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FilterValidInts
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Valid integer values:
     *   - int
     *   - string representing integer (trim allowed), within PHP int range
     * - Return valid integers as int[] preserving original order.
     * - Ignore invalid values.
     *
     * @return int[]
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
