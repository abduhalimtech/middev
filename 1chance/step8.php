<?php

$line = '2025-12-20T10:05:00Z; sku= ip-15 ; qty=2; price=1,299.99; tags=Phone|Apple|  New  ';

$parts = array_map('trim', explode(';', $line));
$parts = array_values(array_filter($parts, fn($a) => $a !== ''));
$at= $parts[0];

$pairs = array_slice($parts, 1);

$result = ['at' => $at, 'pairs' => $pairs];

print_r($result);

$kv = [];

foreach($pairs as $p){
    $pos = strpos($p, '=');

    if($pos ===false) continue;

    $key = strtolower(trim(substr($p, 0, $pos)));
    $val = trim(substr($p, $pos+1));
    $kv[$key] = $val;
}
print_r($kv);

$skus = [' ip-15 ', 'IP-15', 'IP - 15', "  mac \t- 01 "];

$out =[];
foreach($skus as $s){
    $sku = strtolower(trim($s));
    $sku = preg_replace('/\s+/', '', $sku);
    $out[] = $sku;
}

print_r($out);

$prices = ['1,299.99', '1299.99', '2000', '2,000.00', '1.5'];

