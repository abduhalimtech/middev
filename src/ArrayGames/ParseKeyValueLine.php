<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class ParseKeyValueLine
{
    /**
     * Rules:
     * - Input: string like "a=1; b = 2 ; c=hello"
     * - Split by ';'
     * - Each part may have spaces.
     * - Only keep pairs that contain '=' with non-empty key after trim.
     * - Key normalize: lowercase + trim.
     * - Value normalize: trim (keep case).
     * - If key repeats, LAST one wins.
     *
     * @return array<string, string>
     */
    public static function parse(string $line): array
    {
        throw new \RuntimeException('Not implemented');
    }
}
