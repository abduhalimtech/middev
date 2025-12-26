<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FilterValidInts;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FilterValidIntsTest extends TestCase
{
    #[Test]
    public function it_filters_valid_ints_and_preserves_order(): void
    {
        self::assertSame([3, 2, -1], FilterValidInts::from([3, '2', ' -1 ', 'x']));
        self::assertSame([10, 0, 5], FilterValidInts::from(['0010', 0, '5', 5.5, true]));
        self::assertSame([], FilterValidInts::from([]));
    }

    #[Test]
    public function it_ignores_invalid_numeric_like_strings(): void
    {
        self::assertSame([1], FilterValidInts::from(['1', '1.0', '1e3', ' 1 ', '01']));
        self::assertSame([], FilterValidInts::from(['', '  ', '1.2', '-']));
        self::assertSame([-7], FilterValidInts::from(['-0007', '-7.0']));
    }

    #[Test]
    public function it_handles_extreme_values(): void
    {
        self::assertSame([PHP_INT_MIN, PHP_INT_MAX], FilterValidInts::from([PHP_INT_MIN, ' '.PHP_INT_MAX.' ']));
        self::assertSame([PHP_INT_MIN], FilterValidInts::from([' '.PHP_INT_MIN.' ', '9223372036854775808']));
        self::assertSame([PHP_INT_MAX], FilterValidInts::from(['-9223372036854775809', PHP_INT_MAX]));
    }
}
