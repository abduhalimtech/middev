<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class CompactNulls
{
    /**
     * Rules:
     * - Remove ONLY null values from the array.
     * - Keep false, 0, '', and other values.
     * - Preserve order and reindex.
     */
    public static function apply(array $values): array
    {
        $result =[];
        foreach ($values as $v) {
            if($v === null){
                continue;
            }
            $result[] = $v;
        }
        return $result;
        // return array_filter($values);
    }
}
