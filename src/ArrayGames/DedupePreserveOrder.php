<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class DedupePreserveOrder
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Keep only strings.
     * - Normalize each string: trim (keep case).
     * - Ignore empty after trim.
     * - Return unique values preserving first appearance order.
     *
     * @return string[]
     */
    public static function from(array $values): array
    {
        $result = [];
        foreach ($values as $v) {
            if(!is_string($v)){
                continue;

            }   
            $v = trim($v);
            if ($v === '') {
                continue;
            }
            $result[] = $v;

        }
        return array_values(array_unique($result));
    }
}
