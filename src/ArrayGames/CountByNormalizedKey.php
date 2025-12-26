<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class CountByNormalizedKey
{
    /**
     * Rules:
     * - Input: array of strings
     * - Normalize key: trim + lowercase
     * - Ignore empty after trim
     * - Return associative array key => count
     */
    public static function count(array $values): array
    {
        $out = [];
        foreach ($values as $v ) {
            if(!is_string($v)){
                continue;
            }
            $key = strtolower(trim($v));
            if($key === ''){
                continue;
            }

            $out[$key] = ($out[$key] ?? 0) + 1;
        }
        return $out;
    }
}
