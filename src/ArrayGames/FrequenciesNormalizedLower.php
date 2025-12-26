<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FrequenciesNormalizedLower
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Keep only strings.
     * - Normalize each: trim + lowercase.
     * - Ignore empty after trim.
     * - Return associative array: key => count.
     *
     * @return array<string,int>
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
