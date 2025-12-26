<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\TakeUntil;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TakeUntilTest extends TestCase
{
    #[Test]
    public function it_takes_until_first_negative(): void
    {
        self::assertSame([1, 2], TakeUntil::from([1, 2, -1, 3]));
        self::assertSame([], TakeUntil::from([-1, 1, 2]));
        self::assertSame([0, 0, 1], TakeUntil::from([0, 0, 1, -5, 9]));
    }

    #[Test]
    public function it_returns_original_if_no_negative(): void
    {
        self::assertSame([1, 2, 3], TakeUntil::from([1, 2, 3]));
        self::assertSame([], TakeUntil::from([]));
        self::assertSame([0], TakeUntil::from([0]));
    }

    #[Test]
    public function it_handles_large_arrays_fast_enough(): void
    {
        $in = array_merge(range(1, 100), [-1], range(1, 100));
        $out = TakeUntil::from($in);
        self::assertCount(100, $out);
        self::assertSame(100, $out[99]);
    }
}
