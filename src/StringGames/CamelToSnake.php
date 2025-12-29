<?php

declare(strict_types=1);

namespace App\StringGames;

final class CamelToSnake
{
    /**
     * Rules:
     * - Convert camelCase / PascalCase to snake_case (ASCII).
     * - Output must be lowercase.
     * - Handle consecutive capitals:
     *   "myURLValue" => "my_url_value"
     *   "UserID2"    => "user_id2"
     * - Digits remain.
     * - Empty string => empty string.
     */
    public static function convert(string $s): string
    {
        if ($s === '') {
            return '';
        }

        // 1. Acronym Handler
        // Rule: Split (Upper)(Upper+Lower) -> URLValue => URL_Value
        // Fix: Added (?<!^) to say "Don't do this if we are at the START of the string".
        // This prevents IPv6 -> I_Pv6. It leaves it as IPv6.
        $s = preg_replace('/(?<!^)([A-Z])([A-Z][a-z])/', '$1_$2', $s);

        // 2. Standard Camel Handler
        // Rule: Split (Lower/Digit)(Upper) -> myValue => my_Value
        // This handles the "6" -> "A" in IPv6Address
        $s = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $s);

        return strtolower($s);
    }
}

