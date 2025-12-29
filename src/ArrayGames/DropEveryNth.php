<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class DropEveryNth
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Drop every N-th element (1-indexed).
     *   N=2 drops 2nd, 4th, 6th...
     * - Reindex output.
     * - If N <= 0 => throw InvalidArgumentException.
     */
    public static function apply(array $values, int $n): array
    {
        if($n <= 0){
            throw new InvalidArgumentException();
        }
        $out =[];
        foreach($values as $key=>$v){
            $postion = $key+1;
            if($postion % $n === 0){
                continue;
            }
            $out[] = $v;
        }
        return array_values($out);
    }
}
