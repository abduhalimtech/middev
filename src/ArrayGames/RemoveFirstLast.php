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
        throw new \RuntimeException('Not implemented');
    }
}
