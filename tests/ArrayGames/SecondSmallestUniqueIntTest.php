<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\SecondSmallestUniqueInt;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SecondSmallestUniqueIntTest extends TestCase
{
    #[Test]
    public function it_finds_second_smallest_unique_in_common_cases(): void
    {
        self::assertSame(2, SecondSmallestUniqueInt::from([3, 1, 2]));
        self::assertSame(2, SecondSmallestUniqueInt::from([2, 2, 3, 3, 1]));
        self::assertSame(-7, SecondSmallestUniqueInt::from([-10, -5, -7]));
    }

    #[Test]
    public function it_handles_mixed_values_and_int_strings_and_extremes(): void
    {
        self::assertSame(5, SecondSmallestUniqueInt::from([10, ' -2 ', 'x', 1.2, null, [], true, '5', '-2']));
        self::assertSame(0, SecondSmallestUniqueInt::from([PHP_INT_MIN, PHP_INT_MAX, 0]));
        self::assertSame(2, SecondSmallestUniqueInt::from([' 1 ', '001', '2', ' 3 ']));
    }

    #[Test]
    public function it_throws_when_less_than_two_unique_ints_exist(): void
    {
        $this->expectException(InvalidArgumentException::class);
        SecondSmallestUniqueInt::from([2, '2', ' 2 ', 'x']);
    }
}
