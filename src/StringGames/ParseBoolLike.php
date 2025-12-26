<?php

declare(strict_types=1);

namespace App\StringGames;

final class ParseBoolLike
{
    /**
     * Rules:
     * - Accept true values (case-insensitive, trim): "1", "true", "yes", "on"
     * - Accept false values: "0", "false", "no", "off"
     * - Anything else => null
     */
    public static function parse(string $s): ?bool
    {
        throw new \RuntimeException('Not implemented');
    }
}
