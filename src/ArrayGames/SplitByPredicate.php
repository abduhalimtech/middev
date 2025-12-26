<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class SplitByPredicate
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Output: [ $trues, $falses ]
     * - Put values where predicate is true into $trues, others into $falses.
     * - Predicate: "is even" (value % 2 === 0)
     * - Preserve order.
     *
     * @return array{0:int[],1:int[]}
     */
    public static function split(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
