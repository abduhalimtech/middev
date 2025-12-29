<?php

declare(strict_types=1);

namespace App\ArrayGames;

use IntlException;

final class IntersectionUniqueSorted
{
    /**
     * Rules:
     * - Input: two arrays of mixed values.
     * - Valid integers: int or int-string (trim allowed).
     * - Ignore invalid values.
     * - Compute intersection of valid integers (value-based).
     * - Return UNIQUE intersection values sorted ascending.
     */
    public static function from(array $a, array $b): array
    {
        $cleanA = self::getValidInts($a);
        $cleanB = self::getValidInts($b);
        $common = array_intersect($cleanA, $cleanB);
        $unique = array_values(array_unique($common));
        sort($unique);
        return $unique;
    }

    private static function getValidInts(array $values):array{
        $result = [];
        foreach ($values as $v) {
            if(is_int($v)){
                $result[]= $v;
                continue;
            }

            if(is_string($v)){
                $cleanVal = trim($v);
                $cleanVal = preg_replace('/^([+-]?)0+(?=\d)/', '$1', $cleanVal);
                $filtered = filter_var($cleanVal, FILTER_VALIDATE_INT);
                if($filtered !== false){
                    $result[] = $filtered;
                }

            }
        }
        if(empty($result)){
            return [];
        }
        return $result;
    }
}
