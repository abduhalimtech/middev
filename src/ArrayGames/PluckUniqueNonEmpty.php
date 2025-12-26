<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PluckUniqueNonEmpty
{
    /**
     * Rules:
     * - Input: array of associative arrays
     * - Pluck $field values
     * - Keep only string values that are non-empty after trim
     * - Normalize: trim (but do NOT lowercase)
     * - Unique preserving order
     *
     * @return string[]
     */
    public static function from(array $items, string $field): array
    {
        $out =[];
        $seen = [];

        foreach($items as $i){

            if(!isset($i[$field]) || !is_string($i[$field])){
                continue;
            }
            $trimmed = trim($i[$field]);
            if($trimmed === '' || isset($seen[$trimmed])){
                continue;
        
            }
            $seen[$trimmed] = true;
            $out[] =$trimmed;
        }
        // sort($out);
        return $out;
    }
}
