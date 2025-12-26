<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\SumBySku;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SumBySkuTest extends TestCase
{
    #[Test]
    public function it_sums_qty_by_sku(): void
    {
        $lines = [
            'sku= ip-15 ; qty=2',
            'sku=IP-15; qty= 3 ',
            'sku= mac-01 ; qty=1',
            'sku=mac-01; qty=x', // ignore
            'qty=5; sku= ip-15',
        ];

        self::assertSame(['IP-15' => 10, 'MAC-01' => 1], SumBySku::fromLines($lines));
    }
}
