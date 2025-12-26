<?php

function isAnagram($s1, $s2){
    if (empty($s1) && empty($s2) ) {
        return false;
    }
    $arrS1 = str_split($s1);
    $arrS2 = str_split($s2);
    $countedS1 = [];
    $countedS2 = [];
    if(count($arrS1) !== count($arrS2)){
        return false;
    }
    foreach ($arrS1 as $a) {
        $countedS1[$a] = ($countedS1[$a]??0) + 1;
    }
    foreach ($arrS2 as $a) {
        $countedS2[$a] = ($countedS2[$a]??0) + 1;
    }
    if(($countedS1) == ($countedS2)){
        return true;
    }
    return false;
}
var_dump(isAnagram('fasle', 'false')); // bool(true)
var_dump(isAnagram('abc', 'xyz'));     // bool(false) (Your old code would say true here!)
var_dump(isAnagram('aabb', 'bbaa'));   // bool(true)