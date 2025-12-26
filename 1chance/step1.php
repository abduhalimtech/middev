<?php declare(strict_types=1);

# Convert prices from USD to UZS (rate given)
// $usdprices = [10, 25.5, 100];

// $rate = 12000;

// $exchange = array_map(fn($p) => (int) round($p * $rate), $usdprices);

// print_r ($exchange);


//2 Normalize product names (trim + lowercase)
// $names = ["  iPhone  ", "SAMSUNG  ", "  Xiaomi"];

// $data = array_map(fn($name) => mb_strtolower(trim($name)), $names);

// print_r($data);


#3 Add computed field to each item

// $items = [
//   ['name' => 'A', 'w' => 2, 'h' => 3],
//   ['name' => 'B', 'w' => 5, 'h' => 4],
// ];

// $computed = array_map(function($i){
//     $i['area'] = $i['w'] * $i['h']; 
//     return $i;
// }, $items);

// print_r($computed);

#4 array_filter() — remove

// $products = [
//   ['id' => 1, 'stock' => 5],
//   ['id' => 2, 'stock' => 0],
//   ['id' => 3, 'stock' => 2],
// ];

// $avlb = array_filter($products, fn($p)=>$p['stock']>0);
// print_r($avlb);

#5 Remove null/empty strings (but keep "0")

// $values = ["", "  ", null, "ok", "0", 0, " test "];

// $filtered_values = array_values(array_filter($values, function ($v) {
//     if($v === null) return false;
//     if(is_string($v)) return trim($v) !== '';
//     return true;

// }));


// print_r($filtered_values);

#6 Q6. Keep only users older than 18

// $users = [
//   ['name' => 'A', 'age' => 17],
//   ['name' => 'B', 'age' => 18],
//   ['name' => 'C', 'age' => 22],
// ];

// $filtered_users = array_values(array_filter($users, fn($u) => $u['age'] > 18 ));

// print_r($filtered_users);


#7 array_reduce() — totals / aggregation Q7. Total shipment weight

// $boxes = [
//   ['id' => 1, 'weight' => 2.5],
//   ['id' => 2, 'weight' => 3.1],
//   ['id' => 3, 'weight' => 1.4],
// ];


// $total = array_reduce($boxes, fn($sum, $b) => $sum + $b['weight'], 0.0);
// print_r($total);

#8 Build an id => item lookup map

// $items = [
//   ['id' => 10, 'name' => 'A'],
//   ['id' => 11, 'name' => 'B'],
// ];

// $r = array_reduce($items, function ($acc, $i) {
//     $acc[$i['id']] = $i;
//     return $acc;
// }, []);

// print_r($r);

#9 Q9. Sum order totals (qty * price)

// $lines = [
//   ['qty' => 2, 'price' => 12.5],
//   ['qty' => 1, 'price' => 99],
//   ['qty' => 3, 'price' => 5],
// ];


// $totals = array_reduce($lines, fn($sum, $l)=>$sum + ($l['qty']*$l['price']), 0.0);

// print_r($totals);

#10 usort() — custom sort Q10. Sort boxes by volume (ascending)

// $boxes = [
//   ['id' => 1, 'w' => 2, 'h' => 3, 'd' => 4], // 24
//   ['id' => 2, 'w' => 1, 'h' => 1, 'd' => 10], // 10
//   ['id' => 3, 'w' => 3, 'h' => 3, 'd' => 3], // 27
// ];

// $usorted = usort($boxes, function($a, $b){
//     $va = $a['w'] * $a['h'] * $a['d'];
//     $vb = $b['w'] * $b['h'] * $b['d'];
//     return $va <=> $vb;
// });

// print_r($usorted);
// print_r($boxes);

#Q11. Sort users by score desc, then name asc

// $users = [
//   ['name' => 'Bob', 'score' => 10],
//   ['name' => 'Ann', 'score' => 10],
//   ['name' => 'Zed', 'score' => 12],
// ];

// $sorted_users = usort($users, function($a, $b){
//     $byScore = $b['score'] <=> $a['score'];
//     return $byScore !== 0 ? $byScore : ($a['name'] <=> $b['name']);
// });

// print_r($users);
// print_r($sorted_users);

#Q12. Sort objects by property

// class Box {
//     public function __construct(
//         public int $id,
//         public int $volume,
//     ) {}
// }

// $boxes = [new Box(1, 24), new Box(2, 10), new Box(3, 27)];

// $s = usort($boxes, fn($a, $b) => $a->volume <=> $b->volume);

// print_r($boxes);


#Q13. In-stock → add line_total → sum grand total

// $cart = [
//   ['sku' => 'A', 'qty' => 2, 'price' => 10, 'stock' => 3],
//   ['sku' => 'B', 'qty' => 1, 'price' => 50, 'stock' => 0],
//   ['sku' => 'C', 'qty' => 4, 'price' => 3,  'stock' => 10],
// ];

// $inStock = array_values(array_filter($cart, fn($v) => $v['stock'] > 0));
// $addedTotal = array_map(function($a){
//     $a['line_total'] = $a['price'] * $a['qty'];
//     return $a;
// }, $inStock);

// $last = array_reduce($addedTotal, fn($sum, $b) => $sum + $b['line_total'], 0.0);


// print_r($last);

#Q14. Sort products by computed discount percent desc

// $products = [
//   ['name' => 'A', 'old' => 200, 'new' => 150], // 25%
//   ['name' => 'B', 'old' => 100, 'new' => 90],  // 10%
//   ['name' => 'C', 'old' => 80,  'new' => 40],  // 50%
// ];

// $sorded = usort($products, function($a, $b){
//     $ac = ($a['old'] - $a['new'])/$a['old'];
//     $ab = ($b['old'] - $b['new'])/$b['old'];
//     return $ab <=> $ac;

// });

// print_r($products);
