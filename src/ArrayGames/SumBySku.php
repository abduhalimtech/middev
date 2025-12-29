<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class SumBySku
{
    /**
     * Rules:
     * - Input lines like: "sku= ip-15 ; qty=2"
     * - sku normalize: trim + uppercase
     * - qty: valid integer (same rules: int string allowed). Invalid qty => ignore line.
     * - Return associative array SKU => sum(qty)
     */
    public static function fromLines(array $lines): array
    {
        $result = [];
        foreach($lines as $line){
            $parts = explode(';', $line);
            
            $sku = null;
            $qty = null;

            foreach($parts as $part){
                $pair = explode('=', $part, 2);

                if(count($pair) !== 2){
                    continue;
                }

                $key = trim($pair[0]);
                $value = trim($pair[1]);

                if(strcasecmp($key, 'sku') === 0){
                    $sku = strtoupper($value);
                }
                if(strcasecmp($key, 'qty') === 0){
                    $cleanQty = preg_replace('/^([+-]?)0+(?=\d)/', '$1', $value);
                    $filtered = filter_var($cleanQty, FILTER_VALIDATE_INT);
    
                    if ($filtered !== false) {
                        $qty = $filtered; // Use the validated int directly
                    }
                }
            }
            if($sku !== null && $qty !== null){
                $result[$sku] = ($result[$sku] ??0 ) + $qty;
            }
        }
        return $result;

    }
}
