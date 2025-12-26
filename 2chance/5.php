<?php

// Create an empty array called $groups.
// Loop through the input list of words.
// For each word:Sort its letters to create a "key" (e.g., convert "tea" to "aet").
// Use that "key" to store the original word in the $groups array.Example: $groups['aet'][] = 'tea';
// Return the values of $groups.Constraint: In PHP, sort() works on arrays, not strings. 
// So to sort "tea", you need to: str_split $\rightarrow$ sort $\rightarrow$ implode.


function groupAnagrams($words){
    $groups = [];
    foreach($words as $word){
        $arr = str_split($word);
        sort($arr);
        $realWord = implode('', $arr);
        $groups[$realWord][] = $word; 
    }
    return array_values($groups);

}

$ff= ["eat", "tea", "tan", "ate", "nat", "bat"];
// var_dump(groupAnagrams($ff)); 
print_r(groupAnagrams($ff)); 