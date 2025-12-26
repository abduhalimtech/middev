<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\IntersectionUniqueSorted;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IntersectionUniqueSortedTest extends TestCase
{
    #[Test]
    public function it_intersects_and_sorts_basic_cases(): void
    {
        self::assertSame([2, 3], IntersectionUniqueSorted::from([1, 2, 3], [3, 2, 9]));
        self::assertSame([], IntersectionUniqueSorted::from([1, 2], [3, 4]));
        self::assertSame([0], IntersectionUniqueSorted::from([0, 0, 1], [0]));
    }

    #[Test]
    public function it_handles_mixed_values_and_int_strings(): void
    {
        self::assertSame([2], IntersectionUniqueSorted::from([' 2 ', 'x', 1.2, 3], [2, '2', '2.0']));
        self::assertSame([-1, 10], IntersectionUniqueSorted::from(['-1', '0010', 'x'], [-1, 10, 11]));
        self::assertSame([], IntersectionUniqueSorted::from(['1.2', null], ['1e3', true]));
    }

    #[Test]
    public function it_handles_extremes(): void
    {
        self::assertSame([PHP_INT_MIN], IntersectionUniqueSorted::from([PHP_INT_MIN, 0], [' '.PHP_INT_MIN.' ']));
        self::assertSame([PHP_INT_MAX], IntersectionUniqueSorted::from([PHP_INT_MAX], [PHP_INT_MAX, 1]));
        self::assertSame([], IntersectionUniqueSorted::from([PHP_INT_MIN], [PHP_INT_MAX]));
    }
}
