<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RemoveOuterQuotes;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveOuterQuotesTest extends TestCase
{
    #[Test]
    public function it_removes_outer_matching_quotes(): void
    {
        self::assertSame('hello', RemoveOuterQuotes::apply('"hello"'));
        self::assertSame('hello', RemoveOuterQuotes::apply("'hello'"));
        self::assertSame('', RemoveOuterQuotes::apply('""'));
    }

    #[Test]
    public function it_keeps_when_not_matching_or_not_both_sides(): void
    {
        self::assertSame('"hello\'', RemoveOuterQuotes::apply('"hello\''));
        self::assertSame('hello"', RemoveOuterQuotes::apply('hello"'));
        self::assertSame("'hello\"", RemoveOuterQuotes::apply("'hello\""));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', RemoveOuterQuotes::apply(''));
        self::assertSame('a', RemoveOuterQuotes::apply('a'));
        self::assertSame('""x""', RemoveOuterQuotes::apply('""x""')); // outer quotes are " and ", inside remains
    }
}
