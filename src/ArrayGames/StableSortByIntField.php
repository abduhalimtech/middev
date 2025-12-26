<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class StableSortByIntField
{
    /**
     * Rules:
     * - Input: array of associative arrays.
     * - Sort ascending by integer field $field.
     * - Missing/invalid int => goes LAST.
     * - Stable: items with same key keep original order.
     *
     * Valid int: int or int-string (trim allowed).
     */
    public static function sort(array $items, string $field): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
