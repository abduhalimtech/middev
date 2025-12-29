<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class NormalizeUniqueSortedSum
{
    /**
     * Rules:
     * - Keep only valid integers (int or int-string with trim allowed).
     * - Ignore invalid values (floats, float-strings, bool, null, arrays, objects, etc).
     * - Unique the integers.
     * - Sort ascending.
     * - Return the sum of the resulting integers.
     * - If none found => return 0.
     */
    public static function from(array $values): int
    {
        $result = [];
        foreach ($values as $v) {
            if(is_int($v)){
                $result[]= $v;
                continue;
            }
            if(is_string($v)){
                $cleanVal = trim($v);
                if($cleanVal === ''){
                    $result[] = 0;
                    continue;
                }
                $cleanVal = preg_replace('/^([+-]?)0+(?=\d)/', '$1', $cleanVal);
                $filtered = filter_var($cleanVal, FILTER_VALIDATE_INT);
                if($filtered !== false){
                    $result[] = $filtered;
                }

            }
        }
        
        $unique = array_unique($result);
        rsort($unique);
        return array_sum($unique);
    }
}
