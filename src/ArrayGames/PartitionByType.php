<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PartitionByType
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Output: ['ints' => int[], 'strings' => string[], 'others' => array]
     * - ints: keep only int values (strict int, not numeric strings)
     * - strings: keep only string values
     * - others: everything else
     * - Preserve order in each bucket, reindex arrays.
     */
    public static function split(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
