<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\WrapWords;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class WrapWordsTest extends TestCase
{
    #[Test]
    public function it_wraps_words_by_width(): void
    {
        self::assertSame("a b\nc", WrapWords::wrap('a b c', 3));
        self::assertSame("hello\nworld", WrapWords::wrap('hello world', 5));
        self::assertSame("one two\nthree", WrapWords::wrap('one two three', 7));
    }

    #[Test]
    public function it_normalizes_whitespace_before_wrapping(): void
    {
        self::assertSame("a b\nc", WrapWords::wrap("  a\tb \n c  ", 3));
        self::assertSame("", WrapWords::wrap("   ", 3));
        self::assertSame("a", WrapWords::wrap("a", 1));
    }

    #[Test]
    public function it_keeps_long_word_on_its_own_line(): void
    {
        self::assertSame("toolongword", WrapWords::wrap('toolongword', 4));
        self::assertSame("a\ntoolongword\nb", WrapWords::wrap('a toolongword b', 4));
        self::assertSame("xx\nyyy", WrapWords::wrap('xx yyy', 2));
    }
}
