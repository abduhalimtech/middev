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
        $ints = [];

        foreach ($values as $v) {
            if (is_int($v)) {
                $ints[] = $v;
                continue;
            }
            if (is_string($v)) {
                $clean = trim($v);
                // The "Trench Coat" Regex Fix
                $clean = preg_replace('/^([+-]?)0+(?=\d)/', '$1', $clean);
                
                $val = filter_var($clean, FILTER_VALIDATE_INT);
                if ($val !== false) {
                    $ints[] = $val;
                }
            }
        }

        // 1. Unique
        $unique = array_unique($ints);

        // 2. Check Count BEFORE sorting (Need at least 2 competitors)
        if (count($unique) < 2) {
            throw new InvalidArgumentException("Not enough unique integers");
        }

        // 3. Sort Ascending
        sort($unique);

        // 4. Return Index 1 (The Second Item)
        return $unique[1];
    }
}
