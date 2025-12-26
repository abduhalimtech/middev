<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class IntStats
{
    /**
     * @return array{min:int, max:int, unique:int}
     */
    public static function from(array $values): array
    {
        // TODO
        // throw new \RuntimeException('Not implemented');
        $result = [];
        foreach ($values as $value) {
            if(is_int($value)){
                $result[] = $value;
                continue;
            }
            if(is_string($value)){
                $cleanVal = trim($value);
                $filtered = filter_var($cleanVal, FILTER_VALIDATE_INT);
                
                if($filtered !== false){
                    $result[] = $filtered;
                }
            }

        }
        if(empty($result)){
            throw new InvalidArgumentException('No valid integers found.');
        }

        return [
            'min' => min($result),
            'max' => max($result),
            'unique' => count(array_unique($result))
        ];
    }
}


/*
Rules:

$values is an array of mixed values.

Valid integer values are:

int

string representing an integer (spaces allowed), within PHP int range
(" -10 ", "001", "-0007" are valid; "1.2", "1e3", "abc" invalid)

Ignore everything else (floats, bool, null, arrays, objects, float-strings, etc.)

If no valid integers after filtering → throw InvalidArgumentException

Return:

['min' => int, 'max' => int, 'unique' => int]

unique = number of unique valid integers

Examples:

input: [3, " 2 ", "x", -1, -1] → ['min'=>-1,'max'=>3,'unique'=>3]

input: [] → throws

input: ["1.2", null] → throws

*/