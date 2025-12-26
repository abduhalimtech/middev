<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ReplaceFirst;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReplaceFirstTest extends TestCase
{
    #[Test]
    public function it_replaces_only_first_occurrence(): void
    {
        self::assertSame('a-x-b', ReplaceFirst::apply('a-b-b', 'b', 'x'));
        self::assertSame('heLlo', ReplaceFirst::apply('hello', 'l', 'L'));
        self::assertSame('Xabab', ReplaceFirst::apply('ababab', 'ab', 'X'));
    }

    #[Test]
    public function it_returns_original_when_search_missing_or_empty(): void
    {
        self::assertSame('abc', ReplaceFirst::apply('abc', 'z', 'x'));
        self::assertSame('abc', ReplaceFirst::apply('abc', '', 'x'));
        self::assertSame('', ReplaceFirst::apply('', 'a', 'x'));
    }

    #[Test]
    public function it_handles_overlapping_patterns(): void
    {
        self::assertSame('baa', ReplaceFirst::apply('aaaa', 'aa', 'b'));
        self::assertSame('baba', ReplaceFirst::apply('aaba', 'aa', 'b'));
        self::assertSame('a', ReplaceFirst::apply('a', 'aa', 'b'));
    }
}
