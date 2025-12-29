<?php

declare(strict_types=1);

namespace App\StringGames;

final class BetweenMarkers
{
    /**
     * Rules:
     * - Return substring between first occurrence of $start and next occurrence of $end after it.
     * - If start not found OR end not found after start => return empty string.
     * - Do NOT include markers.
     */
    public static function get(string $s, string $start, string $end): string
    {
        // xx[core]yy
        $firstSignPos = strpos($s, $start);
        if($firstSignPos === false){
            return '';
        }
        $contentStart = $firstSignPos + strlen($start);
        $secondSignPos = strpos($s, $end);
        
        if($secondSignPos === false){
            return '';
        }
        $endContent = $secondSignPos - $contentStart;

        return substr($s, $contentStart,$endContent );
        
    }
}
