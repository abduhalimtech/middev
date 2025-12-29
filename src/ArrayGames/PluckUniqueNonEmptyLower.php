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
        $collected = [];

        foreach ($items as $item) {
            // 1. Safety: Ensure we are looking at an array and the key exists
            if (!is_array($item) || !isset($item[$field])) {
                continue;
            }

            $value = $item[$field];

            // 2. Type Filter: Must be a string
            if (!is_string($value)) {
                continue;
            }

            // 3. Normalize: Trim then Lowercase
            // (Trim first is usually safer to catch "   ")
            $clean = strtolower(trim($value));

            // 4. Empty Filter: If it was just whitespace, it's now empty
            if ($clean === '') {
                continue;
            }

            $collected[] = $clean;
        }

        // 5. Unique & Reindex
        // array_unique keeps the first occurrence (Preserves Order)
        // array_values resets the keys (0, 1, 2...)
        return array_values(array_unique($collected));
    }
}
