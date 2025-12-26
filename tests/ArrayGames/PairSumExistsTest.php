<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PairSumExists;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PairSumExistsTest extends TestCase
{
    #[Test]
    public function it_detects_pair_sum_basic(): void
    {
        self::assertTrue(PairSumExists::check([1, 2, 3], 5)); // 2+3
        self::assertFalse(PairSumExists::check([1, 2, 3], 7));
        self::assertTrue(PairSumExists::check([-1, 4, 0], 3)); // -1+4
    }

    #[Test]
    public function it_handles_duplicates_correctly(): void
    {
        self::assertTrue(PairSumExists::check([2, 2], 4)); // must allow using both 2s
        self::assertFalse(PairSumExists::check([2], 4));
        self::assertTrue(PairSumExists::check([0, 0, 1], 0)); // 0+0
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertFalse(PairSumExists::check([], 0));
        self::assertFalse(PairSumExists::check([1], 1));
        self::assertTrue(PairSumExists::check([PHP_INT_MAX, 0], PHP_INT_MAX));
    }
}
