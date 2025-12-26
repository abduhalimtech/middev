<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class MapWithIndex
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Return array where each value becomes value + index (0-based).
     * - Preserve order, reindex output.
     *
     * Example: [10,10,10] => [10,11,12]
     */
    public static function apply(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
