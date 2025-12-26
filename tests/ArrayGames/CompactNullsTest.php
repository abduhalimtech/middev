<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\CompactNulls;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CompactNullsTest extends TestCase
{
    #[Test]
    public function it_removes_only_nulls(): void
    {
        self::assertSame([1, 2], CompactNulls::apply([1, null, 2]));
        self::assertSame([false, 0, '', '0'], CompactNulls::apply([null, false, 0, '', '0', null]));
        self::assertSame([], CompactNulls::apply([null, null]));
    }

    #[Test]
    public function it_preserves_order_and_reindexes(): void
    {
        $in = [10 => 1, 20 => null, 30 => 2, 40 => null, 50 => 3];
        self::assertSame([1, 2, 3], CompactNulls::apply($in));
    }

    #[Test]
    public function it_handles_empty_input(): void
    {
        self::assertSame([], CompactNulls::apply([]));
        self::assertSame([0], CompactNulls::apply([0]));
        self::assertSame([''], CompactNulls::apply(['']));
    }
}
