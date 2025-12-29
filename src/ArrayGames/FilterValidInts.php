<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FilterValidInts
{
    /**
     * Rules:
     * - Return valid integers.
     * - Allow "0010" (cleaned to 10).
     * - Reject "1.0", "1e3".
     */
    public static function from(array $values): array
    {
        $result = [];

        foreach ($values as $v) {
            // Case 1: Pure Integer
            if (is_int($v)) {
                $result[] = $v;
                continue;
            }

            // Case 2: String Candidate
            if (is_string($v)) {
                $string = trim($v);
                
                // STEP A: THE CLEANING (Remove Trench Coat)
                // Remove leading zeros, but keep the sign.
                // Replaces "Start + Sign + Zeros" with just "Sign".
                $clean = preg_replace('/^([+-]?)0+(?=\d)/', '$1', $string);

                // STEP B: THE BOUNCER
                // Now verify it's a valid integer (handles overflow, text, floats)
                $n = filter_var($clean, FILTER_VALIDATE_INT);
                
                if ($n !== false) {
                    $result[] = $n;
                }
            }
        }
        return $result;
    }
}