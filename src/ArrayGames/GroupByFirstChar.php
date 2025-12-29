<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class GroupByFirstChar
{
    /**
     * Rules:
     * - Input: array of strings.
     * - Normalize each: trim.
     * - Ignore empty after trim.
     * - Group by first character LOWERCASED.
     * - Preserve order within each group.
     *
     * @return array<string, string[]>
     */
    public static function group(array $values): array
    {
        if(empty($values)){
            return $values;
        }

        $result = [];
        foreach ($values as $v) {
            if(is_string($v)){
                $t = trim($v);
                if($t === ''){
                    continue;
                }
                $fCh = strtolower($t[0]);
                $result[$fCh][] = $t;
            }
        }
        return $result;
    }
}
