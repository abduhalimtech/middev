<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\NormalizeUniqueSortedSum;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NormalizeUniqueSortedSumTest extends TestCase
{
    #[Test]
    public function it_normalizes_uniques_sorts_and_sums(): void
    {
        // valid ints => -1, 2, 3, 10 => sum 14
        self::assertSame(14, NormalizeUniqueSortedSum::from([3, '2', ' 2 ', -1, '0010']));
        self::assertSame(1, NormalizeUniqueSortedSum::from([1, 1, 1]));
        self::assertSame(0, NormalizeUniqueSortedSum::from([0, '0', ' 000 ']));
    }

    #[Test]
    public function it_ignores_invalid_values_and_handles_empty(): void
    {
        self::assertSame(5, NormalizeUniqueSortedSum::from(['x', '1.2', null, true, 2.5, '5']));
        self::assertSame(0, NormalizeUniqueSortedSum::from(['', '  ', [], new \stdClass()]));
        self::assertSame(0, NormalizeUniqueSortedSum::from([]));
    }

    #[Test]
    public function it_handles_extreme_ints(): void
    {
        self::assertSame(PHP_INT_MIN + PHP_INT_MAX, NormalizeUniqueSortedSum::from([PHP_INT_MAX, PHP_INT_MIN]));
        self::assertSame(PHP_INT_MIN, NormalizeUniqueSortedSum::from([PHP_INT_MIN, PHP_INT_MIN]));
    }
}
