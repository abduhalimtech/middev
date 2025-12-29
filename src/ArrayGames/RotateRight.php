<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class RotateRight
{
    /**
     * Rules:
     * - Rotate array RIGHT by $k positions.
     * - If $k can be larger than count($values).
     * - Empty array => [].
     * - Reindex output.
     *
     * Example: [1,2,3,4], k=1 => [4,1,2,3]
     */
    public static function apply(array $values, int $k): array
    {
        $count = count($values);

        // 1. Guard: Empty or no rotation needed
        if ($count === 0 || $k === 0) {
            return $values;
        }

        // 2. Optimize K (Remove useless full spins)
        // If k=12 and count=10, we only effectively rotate 2 times.
        $effectiveK = $k % $count;

        if ($effectiveK === 0) {
            return $values;
        }

        // 3. The Slice & Glue
        // Grab the last K items (Tail)
        // array_slice with negative start takes from the end.
        $tail = array_slice($values, -$effectiveK);
        
        // Grab everything BEFORE the tail (Head)
        // Length = Total - K
        $head = array_slice($values, 0, $count - $effectiveK);

        // 4. Merge: Tail comes first
        return array_merge($tail, $head);
    }
}
