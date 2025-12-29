<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class WindowMax
{
    /**
     * Rules:
     * - Input: array of ints (assume values are ints).
     * - Return array of maximum value in each sliding window of size $k.
     * - If k <= 0 OR k > count($nums) => throw InvalidArgumentException.
     *
     * Example: nums=[1,3,-1,-3,5], k=3 => [3,3,5]
     */
    public static function compute(array $nums, int $k): array
    {
        $count = count($nums);
        if($k <= 0 || $k > $count){
            throw new InvalidArgumentException();
        }

        for ($i = 0; $i <= $count - $k; $i++){
            $result[] = max(array_slice($nums, $i, $k));
        }

        return $result;
        
    }
}
