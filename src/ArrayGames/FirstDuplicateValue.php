<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class FirstDuplicateValue
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Return the first value that appears twice (second occurrence decides).
     * - Compare by strict equality (===).
     * - If no duplicates => throw InvalidArgumentException.
     *
     * Example: [1,2,3,2,1] => 2 (because 2 is first to have a second occurrence)
     */
    public static function find(array $values): mixed
    {
        $seen = [];
        foreach ($values as $v) {
            if(in_array($v, $seen, true) === true){
                return $v;
            }
            $seen [] = $v;
        }
        throw new InvalidArgumentException();
    }
}
