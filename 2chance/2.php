<?php

$names =[ 'Alex', 'Jacob', 'Mark', 'Max' ];
function likes( $names ) {
    if(empty($names)){
      return 'no one likes this';
    }  
    $count = count($names);
    if($count === 1){ return $names[0].' likes this';}elseif($count === 2){
      return $names[0].' and '.$names[1].' like this';
    }elseif($count === 3){
      return $names[0].', '.$names[1].' and '.$names[2].' like this';
    }else{
      return $names[0].', '.$names[1].' and '.$count - 2 .' like this';
    }
  
}

echo likes($names);

