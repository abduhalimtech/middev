<?php

$inventory = [
  ['sku' => ' ip-15 ', 'name' => 'iPhone 15',   'price_usd' => '1,299.99', 'stock' => 3, 'tags' => ['Phone', 'Apple', '  New  ']],
  ['sku' => ' ip-15 ', 'name' => 'iPhone 15',   'price_usd' => '1299.99',  'stock' => 0, 'tags' => ['phone', 'APPLE']],
  ['sku' => ' sam-s24', 'name' => 'Samsung S24','price_usd' => '899.50',   'stock' => 8, 'tags' => ['Phone', 'Android']],
  ['sku' => ' x-13 ',   'name' => 'Xiaomi 13',  'price_usd' => '599',      'stock' => 2, 'tags' => ['phone', 'android', 'Budget']],
  ['sku' => ' mb-air',  'name' => 'MacBook Air','price_usd' => '1,099',    'stock' => 1, 'tags' => ['Laptop', 'Apple']],
];
$rate = 12650; // UZS per USD
$blockedSkus = ['x-13', 'old-model']; // should be excluded after normalization
$priorityTags = ['apple', 'laptop']; // normalized tags; used for sorting priority
$minStock = 2;

$normalizedBlockedSkus = array_values(array_unique(array_map(fn($a)=> strtolower(trim($a)), $blockedSkus)));
$normalizedUniqueSkus = array_values(array_unique(array_map(fn($inv) => strtolower(trim($inv['sku'])),$inventory)));

$activeInventory = array_values(array_map(
    function($i) use($rate, $priorityTags){
          $sku = strtolower(trim($i['sku']));
          $name = trim($i['name']);

          $price_usd = (float)str_replace(',', '', $i['price_usd']);
          $price_uzs = (int)round($rate * $price_usd);
          $tags = array_values(
              array_unique(
                  array_map(
                      fn($tag) => strtolower(trim($tag)),
                      $i['tags']
                  )
              )
          );
          $is_priority = count(array_intersect($tags, $priorityTags)) > 0;
          return [
            'sku' => $sku,
            'name' => $name,
            'price_usd' => $price_usd,
            'price_uzs' => $price_uzs,
            'stock' => (int) $i['stock'],
            'tags' => $tags,
            'is_priority' => $is_priority,
          ];
    },
    array_filter($inventory, function (array $i) use($normalizedBlockedSkus, $minStock) {
              $sku = strtolower(trim($i['sku']));
              return $i ['stock'] >= $minStock && !in_array($sku, $normalizedBlockedSkus, true);
    })
  ));
print_r($activeInventory);

$activeInventorySkus = array_map(fn($s)=>strtolower(trim($s['sku'])), $activeInventory);
$skusToRestock = array_values(array_diff($normalizedUniqueSkus, $activeInventorySkus));

print_r($skusToRestock);

$tagCounts = array_reduce($activeInventory, function($acc, $a){
  $stock = $a['stock'];
  foreach($a['tags'] as $tag){
    if (!isset($acc[$tag])){
      $acc[$tag] = 0;
    }
    $acc[$tag] += $stock;
  }
  
  
  return $acc;
}, []);
print_r($tagCounts);

foreach($activeInventory as $ai => &$i) $i['__i'] = $ai;
unset($i);

usort($activeInventory, function($a, $b){
  $c= $b['is_priority'] <=> $a['is_priority'];
  if($c!==0) return $c;
  
  $c = $b['price_uzs'] <=> $a['price_uzs'];
  if($c!==0) return $c;
  
  $c = $b['stock'] <=> $a['stock'];
  if($c!==0) return $c;
  
  $c = strcmp($a['sku'], $b['sku']);
  if($c!==0) return $c;

  return ($a['__i'] <=> $b['__i']);
});

print_r($activeInventory);

