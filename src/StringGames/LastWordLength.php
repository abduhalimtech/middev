<?php

declare(strict_types=1);

namespace App\StringGames;

final class LastWordLength
{
    /**
     * Rules:
     * - Return length of the last word (words separated by whitespace).
     * - If no word => 0
     */
    public static function get(string $s): int
    {
        // 'hello world'
        $word = trim($s);
        if(empty($word)){
            return 0;
        }

        $pos = strrpos($word, ' ');
        if($pos === false){
            return strlen($word);
        }
        $lastWordLen = strlen($word) - $pos - 1;

        return $lastWordLen;
    }
}
