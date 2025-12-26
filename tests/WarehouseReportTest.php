<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Test;
require_once __DIR__ . '/../src/WarehouseReport.php';

it('parses lines into normalized events', function () {
    $lines = [
        '2025-12-20T10:05:00Z; sku= ip-15 ; qty=2; price=1,299.99; tags=Phone|Apple|  New  ',
        '2025-12-20 15:30:00+05:00 ; sku=IP-15; qty=1; price=1299.99; tags=phone|APPLE',
        '2025-12-21T00:10:00Z; sku= mac-01; qty=3; price=2,000.00; tags= Laptop | Apple |  ',
    ];

    $r = WarehouseReport::fromLines($lines);
    $events = $r->events();

    expect($events)->toHaveCount(3);

    expect($events[0]['sku'])->toBe('ip-15');
    expect($events[0]['qty'])->toBe(2);
    expect($events[0]['price_cents'])->toBe(129999);
    expect($events[0]['tags'])->toBe(['phone', 'apple', 'new']);

    expect($events[1]['sku'])->toBe('ip-15');
    expect($events[1]['price_cents'])->toBe(129999);
    expect($events[1]['tags'])->toBe(['phone', 'apple']);

    expect($events[2]['sku'])->toBe('mac-01');
    expect($events[2]['qty'])->toBe(3);
    expect($events[2]['price_cents'])->toBe(200000);
    expect($events[2]['tags'])->toBe(['laptop', 'apple']);
});

it('computes total revenue in cents (qty * price)', function () {
    $lines = [
        '2025-12-20T10:05:00Z; sku=ip-15; qty=2; price=1,299.99; tags=a',
        '2025-12-20T10:06:00Z; sku=mac-01; qty=3; price=2,000.00; tags=a',
    ];

    $r = WarehouseReport::fromLines($lines);

    // (2 * 129999) + (3 * 200000) = 259998 + 600000 = 859998
    expect($r->totalRevenueCents())->toBe(859998);
});

it('groups revenue by sku deterministically (sorted by sku asc)', function () {
    $lines = [
        '2025-12-20T10:05:00Z; sku=mac-01; qty=1; price=2,000.00; tags=a',
        '2025-12-20T10:06:00Z; sku=ip-15; qty=2; price=1,299.99; tags=a',
        '2025-12-20T10:07:00Z; sku=ip-15; qty=1; price=1,299.99; tags=a',
    ];

    $r = WarehouseReport::fromLines($lines);

    expect($r->revenueBySkuCents())->toBe([
        'ip-15' => 389997, // 3 * 129999
        'mac-01' => 200000,
    ]);
});

it('returns top skus by quantity with tie-breaker sku asc', function () {
    $lines = [
        '2025-12-20T10:00:00Z; sku=b-1; qty=2; price=1.00; tags=a',
        '2025-12-20T10:00:00Z; sku=a-1; qty=2; price=1.00; tags=a',
        '2025-12-20T10:00:00Z; sku=c-1; qty=1; price=1.00; tags=a',
    ];

    $r = WarehouseReport::fromLines($lines);

    // a-1 and b-1 tie on qty=2 => sku asc => a-1 first
    expect($r->topSkusByQty(2))->toBe(['a-1', 'b-1']);
});

it('computes daily revenue in a given timezone', function () {
    $lines = [
        // In Asia/Tashkent (+05:00), this is 2025-12-21 04:59:59
        '2025-12-20T23:59:59Z; sku=ip-15; qty=1; price=1,299.99; tags=a',
        // In Asia/Tashkent, this is 2025-12-21 05:00:01
        '2025-12-21T00:00:01Z; sku=ip-15; qty=1; price=1,299.99; tags=a',
    ];

    $r = WarehouseReport::fromLines($lines);

    expect($r->dailyRevenueCents('2025-12-20', 'Asia/Tashkent'))->toBe(0);
    expect($r->dailyRevenueCents('2025-12-21', 'Asia/Tashkent'))->toBe(259998);
});

it('filters by tag without mutating original', function () {
    $lines = [
        '2025-12-20T10:05:00Z; sku=ip-15; qty=1; price=1,299.99; tags=phone|apple',
        '2025-12-20T10:06:00Z; sku=mac-01; qty=1; price=2,000.00; tags=laptop|apple',
    ];

    $r = WarehouseReport::fromLines($lines);
    $onlyPhone = $r->filterByTag(' Phone ');

    expect($r->events())->toHaveCount(2);
    expect($onlyPhone->events())->toHaveCount(1);
    expect($onlyPhone->events()[0]['sku'])->toBe('ip-15');
});

it('rejects invalid qty and invalid price', function () {
    expect(fn () => WarehouseReport::fromLines([
        '2025-12-20T10:05:00Z; sku=ip-15; qty=0; price=1.00; tags=a',
    ]))->toThrow(InvalidArgumentException::class);

    expect(fn () => WarehouseReport::fromLines([
        '2025-12-20T10:05:00Z; sku=ip-15; qty=1; price=abc; tags=a',
    ]))->toThrow(InvalidArgumentException::class);
});
