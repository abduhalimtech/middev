<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class MaskEmail
{
    public static function mask(string $email): string
    {

        $parts = explode('@', $email);
        if(count($parts) !== 2){
            throw new InvalidArgumentException('Invalid email format');
        }
        
        $local = $parts[0];
        $domain = $parts[1];
        
        if($local === '' || $domain === ''){
            throw new InvalidArgumentException('Empty local or domain part');

        }
        $countLocal = strlen($local);


        if($countLocal === 1){
            return $email;
        }
        if($countLocal === 2){
            return $local[0].'*'.'@'.$domain;
        }
        $starCount = $countLocal - 2;
        $stars = str_repeat('*', $starCount);
        $maskedLocal = $local[0].$stars.$local[$countLocal-1];

        // if($countLocal >=3){
            return $maskedLocal.'@'.$domain;
        // }

    }
}
