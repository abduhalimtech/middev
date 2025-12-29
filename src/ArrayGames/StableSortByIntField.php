<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class StableSortByIntField
{
    /**
     * Rules:
     * - Input: array of associative arrays.
     * - Sort ascending by integer field $field.
     * - Missing/invalid int => goes LAST.
     * - Stable: items with same key keep original order.
     *
     * Valid int: int or int-string (trim allowed).
     */
    public static function sort(array $items, string $field): array
    {
        // We use usort with a custom comparator function
        usort($items, function ($a, $b) use ($field) {
            
            // Helper to extract a valid int (or null if invalid)
            $getVal = function ($row) use ($field) {
                if (!is_array($row) || !isset($row[$field])) return null;
                $v = $row[$field];
                
                if (is_int($v)) return $v;
                if (is_string($v)) {
                    // Quick trim check
                    return filter_var(trim($v), FILTER_VALIDATE_INT) ?: null;
                }
                return null;
            };

            $valA = $getVal($a);
            $valB = $getVal($b);

            // LOGIC: Who goes first?
            
            // 1. Both are valid ints? Compare values.
            if ($valA !== null && $valB !== null) {
                return $valA <=> $valB;
            }

            // 2. Both are bad? They are equal (keep original order).
            if ($valA === null && $valB === null) {
                return 0;
            }

            // 3. Only A is bad? A goes LAST (A > B)
            if ($valA === null) {
                return 1;
            }

            // 4. Only B is bad? B goes LAST (A < B)
            return -1;
        });

        return $items;
    }
}
