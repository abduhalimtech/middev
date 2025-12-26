<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class TakeUntil
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Return elements from start until the first element that is < 0 (negative).
     * - The negative element is NOT included.
     * - If no negatives => return original.
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
