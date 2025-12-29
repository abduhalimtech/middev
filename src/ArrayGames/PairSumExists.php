<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PairSumExists
{
    /**
     * Rules:
     * - Input: array of ints (assume values are ints).
     * - Return true if there exist two DISTINCT indices i != j such that nums[i] + nums[j] == $target.
     * - Must handle duplicates correctly.
     * - Empty or single-element array => false.
     */
    public static function check(array $nums, int $target): bool
    {
        if(count($nums) < 2){
            return false;
        }
        $seen = [];
        foreach ($nums as $n) {
            $wanted = $target - $n;
            if(isset($seen[$wanted])){
                return true;
            }
            $seen[$n] = true;
        }
        return false;
    }
}
