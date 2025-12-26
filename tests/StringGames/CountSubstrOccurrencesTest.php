<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\CountSubstrOccurrences;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CountSubstrOccurrencesTest extends TestCase
{
    #[Test]
    public function it_counts_non_overlapping_occurrences(): void
    {
        self::assertSame(2, CountSubstrOccurrences::count('ababab', 'ab'));
        self::assertSame(2, CountSubstrOccurrences::count('aaaa', 'aa')); // non-overlapping => 2
        self::assertSame(1, CountSubstrOccurrences::count('hello', 'll'));
    }

    #[Test]
    public function it_returns_zero_on_missing_or_empty_needle(): void
    {
        self::assertSame(0, CountSubstrOccurrences::count('hello', 'z'));
        self::assertSame(0, CountSubstrOccurrences::count('hello', ''));
        self::assertSame(0, CountSubstrOccurrences::count('', 'a'));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame(3, CountSubstrOccurrences::count('aaaaa', 'a'));
        self::assertSame(1, CountSubstrOccurrences::count('aaa', 'aaa'));
        self::assertSame(0, CountSubstrOccurrences::count('a', 'aa'));
    }
}
