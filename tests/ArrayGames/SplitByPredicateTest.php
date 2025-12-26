<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\SplitByPredicate;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SplitByPredicateTest extends TestCase
{
    #[Test]
    public function it_splits_evens_and_odds_preserving_order(): void
    {
        self::assertSame([[2, 4], [1, 3]], SplitByPredicate::split([1, 2, 3, 4]));
        self::assertSame([[0, -2], [-1, 3]], SplitByPredicate::split([0, -1, -2, 3]));
        self::assertSame([[], []], SplitByPredicate::split([]));
    }

    #[Test]
    public function it_handles_all_even_or_all_odd(): void
    {
        self::assertSame([[2, 6], []], SplitByPredicate::split([2, 6]));
        self::assertSame([[], [1, 5]], SplitByPredicate::split([1, 5]));
        self::assertSame([[0], []], SplitByPredicate::split([0]));
    }

    #[Test]
    public function it_keeps_duplicates(): void
    {
        self::assertSame([[2, 2], [1, 1]], SplitByPredicate::split([2, 1, 2, 1]));
        self::assertSame([[4, 4, 4], []], SplitByPredicate::split([4, 4, 4]));
        self::assertSame([[], [3, 3]], SplitByPredicate::split([3, 3]));
    }
}
