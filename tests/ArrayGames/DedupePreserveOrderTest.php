<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\DedupePreserveOrder;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DedupePreserveOrderTest extends TestCase
{
    #[Test]
    public function it_dedupes_strings_preserving_order(): void
    {
        self::assertSame(['A', 'B'], DedupePreserveOrder::from(['A', 'B', 'A', 'B']));
        self::assertSame(['x', 'X'], DedupePreserveOrder::from(['x', 'X', 'x']));
        self::assertSame(['hi', 'HI'], DedupePreserveOrder::from([' hi ', 'HI', 'hi']));
    }

    #[Test]
    public function it_ignores_non_strings_and_empty(): void
    {
        self::assertSame(['a'], DedupePreserveOrder::from([' a ', '', '   ', null, 1, true, 'a']));
        self::assertSame([], DedupePreserveOrder::from([null, 1, false, [], new \stdClass()]));
        self::assertSame([], DedupePreserveOrder::from([]));
    }

    #[Test]
    public function it_handles_many_values(): void
    {
        $in = array_merge([' A '], array_fill(0, 3, 'B'), ['A', 'C', ' C ']);
        self::assertSame(['A', 'B', 'C'], DedupePreserveOrder::from($in));
    }
}
