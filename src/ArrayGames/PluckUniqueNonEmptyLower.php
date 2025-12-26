<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PluckUniqueNonEmptyLower
{
    /**
     * Rules:
     * - Input: array of associative arrays.
     * - Pluck $field values.
     * - Keep only strings that are non-empty after trim.
     * - Normalize: trim + lowercase.
     * - Unique preserving order.
     *
     * @return string[]
     */
    public static function from(array $items, string $field): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
