<?php
// <!-- 1) array_map
// Test 1 — Normalize + derive fields -->

// $rows = [
//   ['id' => ' 001 ', 'name' => '  iPhone 15 ', 'price' => '1,299.99', 'currency' => 'USD'],
//   ['id' => ' 002 ', 'name' => 'Samsung S24 ', 'price' => '899.50',  'currency' => 'USD'],
// ];
// $rate = 12650; // UZS per USD
// // Output: each row -> id int, name trimmed, price_usd float, price_uzs int, slug (kebab)

// $result = array_map(function($a) use ($rate){
//     $id = (int)$a['id'];
//     $name = trim($a['name']);
//     $price_usd = (float) str_replace(',', '', $a['price']);
//     $price_uzs = ((int) $a['price']) * $rate;
//     $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $a['name']));
//     $real_slug = trim($slug, '-');

//     return [
//         'id' => $id,
//         'name' => $name,
//         'price_usd' => $price_usd,
//         'price_uzs' => $price_uzs,
//         'slug' => $real_slug
//     ];
// }, $rows);

// print_r($result);



#array_filter Test 2 — Complex filter with multiple rules
// Keep only: status=paid AND total>0 AND items>0


// $orders = [
//   ['id' => 1, 'status' => 'paid',  'total' => 120, 'items' => 3],
//   ['id' => 2, 'status' => 'draft', 'total' => 500, 'items' => 10],
//   ['id' => 3, 'status' => 'paid',  'total' => 0,   'items' => 1],
//   ['id' => 4, 'status' => 'paid',  'total' => 80,  'items' => 0],
// ];

// $filtered_order = array_values(array_filter($orders, function($a){
//     return $a['status'] === 'paid' && $a['total'] >0 && $a['items'] > 0;
// }));

// print_r($filtered_order);

# array_reduce Test 3 — Group + aggregate (report)
// Build: [7 => 35, 9 => 5]

// $payments = [
//   ['user_id' => 7, 'amount' => 10],
//   ['user_id' => 7, 'amount' => 25],
//   ['user_id' => 9, 'amount' => 5],
// ];

// $total = array_reduce($payments, function($carry, $a){
//     $uid = $a['user_id'];
//     $carry[$uid] = ($carry[$uid] ?? 0) + $a['amount'];
//     return $carry;
// }, []);

// print_r($total);

# Test 4 — Reduce into 2 outputs at once
// Produce: ['sum' => 22, 'non_zero_count' => 3]

// $nums = [5, 10, 0, 7];

// $results = array_reduce($nums, function($acc, $n){

//     $acc['sum'] += $n;
//     if($n>0) $acc['non_zero_count']++;
//     return $acc;

// }, ['sum' => 0, 'non_zero_count' => 0]);

// print_r($results);



//array_keys Test 5 — Extract keys by value condition
// Get only enabled flag names: ['beta_ui', 'new_checkout']

// $featureFlags = [
//   'beta_ui' => true,
//   'dark_mode' => false,
//   'new_checkout' => true,
// ];
// $data = array_keys($featureFlags, true, true);
// print_r($data);

// array_values
// Test 6 — Reindex after filtering associative array
// Return active users as a zero-indexed array (no keys 10,35)

// $usersById = [
//   10 => ['id' => 10, 'active' => true],
//   22 => ['id' => 22, 'active' => false],
//   35 => ['id' => 35, 'active' => true],
// ];

// $activeUsers = array_values(array_filter($usersById, fn($v) => $v['active']));

// print_r($activeUsers);

// array_unique
// Test 7 — Unique emails case-insensitive
// Expected: ['A@x.com','B@x.com']
// Return unique emails case-insensitive, keeping first occurrences.

// $emails = ['A@x.com', 'a@x.com', 'B@x.com', 'b@x.com', 'b@x.com'];
// $unique = array_unique(array_map(fn($a)=> mb_strtoupper($a), $emails), SORT_REGULAR);

// $seen   = [];
// $unique = [];
// foreach($emails as $e){
//     $k = strtolower($e);
//     if(isset($seen[$k])){ continue; }
//     $seen[$k] = true;
//     $unique[] = $e;
// }
// print_r($unique);

// array_merge
// Test 8 — Merge defaults + overrides (careful!)
// Merge so $input overrides defaults

// $defaults = ['per_page' => 20, 'sort' => 'created_at', 'dir' => 'desc'];
// $input    = ['per_page' => 50, 'dir' => 'asc'];
// $r = array_merge($defaults, $input);
// print_r($r);


// Test 9 — Merge lists without resetting numeric keys confusion
// Make: ['A','B','C'] (simple list)

// $a = [10 => 'A', 11 => 'B'];
// $b = [20 => 'C'];

// $s = array_values(array_merge(array_values($a), array_values($b)));
// print_r($s);

// array_diff
// Test 10 — Find removed IDs (set difference)
// Which IDs were removed from old?

// $old = [1,2,3,4,5];
// $new = [2,3,5,6];
// $r = array_diff(array_values($old), $new);
// print_r($r);



// 9) array_intersect
// Test 11 — Intersection with normalization
// Find common roles (case-insensitive, trim)

// $a = ['  Admin', 'User', 'Manager'];
// $b = ['admin', 'guest', 'manager'];

// $res = array_intersect(array_map(fn($i)=>mb_strtolower(trim($i)), $a), $b);

// print_r($res);

// 10) usort
// Test 12 — Sort by multiple computed fields + stability trick
// Sort: rating desc, sales desc, then name asc.
// Also: make it deterministic even if equal (usort is not stable).

// $products = [
//   ['id' => 1, 'name' => 'A', 'rating' => 4.7, 'sales' => 120],
//   ['id' => 2, 'name' => 'B', 'rating' => 4.7, 'sales' => 200],
//   ['id' => 3, 'name' => 'C', 'rating' => 4.9, 'sales' => 50],
//   ['id' => 4, 'name' => 'D', 'rating' => 4.7, 'sales' => 200],
// ];

// foreach($products as $product => &$row){
//     $row['__i']=$product;
// }
// unset($row);

// $sorting = usort($products, function($a, $b){
//     $c = $b['rating'] <=> $a['rating'];
//     if ($c !==0) return $c;
    
//     $c = $b['sales'] <=> $a['sales']; 
//     if ($c !== 0) return $c;

//     $c = strcmp($a['name'], $b['name']);
//     if($c !==0) return $c;
    
//     return $a['__i'] <=> $b['__i'];

// });

// print_r($products);

//Task 7 — Products: discount% DESC, then final_price ASC

// discount% = (old - new) / old



// Test 13 — Sync tags (create payload for DB update)

// Produce:
// 1) $normalizedUniqueInput (lowercase+trim, unique)
// 2) $toAttach (in input but not current)
// 3) $toDetach (in current but not input)
$current = ['php', 'laravel', 'vue', 'docker'];
$input   = [' Laravel ', 'php', 'react', 'DOCKER', 'php'];

$normalizedUniqueInput = array_unique(array_map(fn($a)=> strtolower(trim($a)), $input));
$toAttach = array_diff($current, $normalizedUniqueInput);
$toDetach = array_diff($normalizedUniqueInput, $current);

print_r($normalizedUniqueInput);
print_r($toAttach);
print_r($toDetach);