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
        foreach ($values as $v) {
            if(is_string($v) === false){
                continue;
            }
            $cr = strtolower(trim($v));
            if($cr === ''){
                continue;
            }
            $out[$cr] = ($out[$cr] ?? 0) + 1;
        }
        return $out;
    }
}
