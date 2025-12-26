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
        throw new \RuntimeException('Not implemented');
    }
}
