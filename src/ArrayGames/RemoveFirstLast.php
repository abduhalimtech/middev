<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class RemoveFirstLast
{
    /**
     * Rules:
     * - If count <= 2: return original array unchanged.
     * - Else: remove first and last elements.
     * - Reindex output (0..n-1).
     */
    public static function apply(array $values): array
    {
        if (count($values) <= 2) {
            return $values;
        }

        // Slice starting from offset 1, and stop 1 from the end (-1).
        // array_slice reindexes automatically.
        return array_slice($values, 1, -1);
    }
}
