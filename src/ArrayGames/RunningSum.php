<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class RunningSum
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Return running sum array.
     * - Example: [1,2,3] => [1,3,6]
     * - Preserve order, reindex.
     */
    public static function from(array $nums): array
    {
        $result = [];
        $total = 0;

        foreach ($nums as $n) {
            $total += $n;     // Add current number to snowball
            $result[] = $total; // Save the snapshot
        }

        return $result;
    }
}
