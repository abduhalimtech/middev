<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FlattenDeep
{
    /**
     * Rules:
     * - Flatten arrays of arbitrary depth.
     * - Preserve left-to-right order.
     * - Reindex output.
     * - Non-arrays are kept as-is.
     */
    public static function apply(array $values): array
    {
        $result = [];
        foreach ($values as $v) {
            if(is_array($v)){
                $result = array_merge($result, self::apply($v));
            }else{
                $result[]=$v;
            }
            
        }
        return $result;
    }
}
