<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class ZipArrays
{
    /**
     * Rules:
     * - Zip two arrays into pairs: [[a0,b0],[a1,b1],...]
     * - Stop at the shorter length.
     * - Reindex output.
     */
    public static function zip(array $a, array $b): array
    {
        $result = [];
        
        // 1. Find the limit (Stop at the shorter length)
        $limit = min(count($a), count($b));

        // 2. Loop until the limit
        for ($i = 0; $i < $limit; $i++) {
            // Create the pair [ItemA, ItemB]
            $result[] = [$a[$i], $b[$i]];
        }

        return $result;
    }
}
