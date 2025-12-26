<?php

// creating function called first non reapeating
function firstNonRepeating($txt) {
    // with array split we are turning the string into array format => ['a', 's', ...]
    $arrSplit = str_split($txt);
    // outside of the loop we created counts variable
    $counts = [];

    // we are itarating the array that we have splitted from string to work on them one-by-one to get their count
    foreach ($arrSplit as $str) {
        // by this way, we are safe incrementing the string attendence in the list
        $counts[$str] = ($counts[$str] ?? 0) + 1;
    }

    // so, we have now array that has count numbers inside, and we are trying to output only first one
    foreach($counts as $char => $count){
        if($count === 1){
            return $char;
        }
    }
    // by default it is empty
    return '';

}

// Usage
echo firstNonRepeating('assawnbabccdeff'); // Output: w
