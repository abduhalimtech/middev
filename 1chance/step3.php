<?php

$current = [
  ['id' => 10, 'email' => 'A@x.com', 'roles' => ['admin','user']],
  ['id' => 11, 'email' => 'b@x.com', 'roles' => ['user']],
];

$inputEmails = [' a@x.com ', 'C@x.com', 'b@x.com', 'b@x.com'];

/**
 * 1) Normalize + unique input emails
 */
$normalizedUniqueInput = array_values(array_unique(
    array_map(fn($e) => strtolower(trim($e)), $inputEmails)
));

/**
 * Normalize current emails (for comparison)
 */
$normalizedCurrentEmails = array_map(
    fn($u) => strtolower(trim($u['email'])),
    $current
);

/**
 * 2) Emails to invite (in input but not in current)
 */
$toInvite = array_values(array_diff($normalizedUniqueInput, $normalizedCurrentEmails));

/**
 * 3) Build id => roles_count map
 */
$idToRolesCount = array_reduce($current, function ($acc, $u) {
    $acc[$u['id']] = count($u['roles']);
    return $acc;
}, []);

/**
 * 4) Sort current by roles_count desc, then email asc, deterministic
 */
$sorted = array_map(function ($u, $i) {
    $u['email'] = strtolower(trim($u['email']));
    $u['roles_count'] = count($u['roles']);
    $u['__i'] = $i; // stability tie-breaker
    return $u;
}, $current, array_keys($current));

usort($sorted, function ($a, $b) {
    $c = $b['roles_count'] <=> $a['roles_count'];
    if ($c !== 0) return $c;

    $c = $a['email'] <=> $b['email'];
    if ($c !== 0) return $c;

    return $a['__i'] <=> $b['__i'];
});

$sorted = array_map(function ($u) {
    unset($u['__i']);
    return $u;
}, $sorted);

// Results:
print_r($normalizedUniqueInput);   // ['a@x.com','c@x.com','b@x.com']
print_r($toInvite);                // ['c@x.com']
print_r($idToRolesCount);          // [10 => 2, 11 => 1]
print_r($sorted);                  // sorted current users
