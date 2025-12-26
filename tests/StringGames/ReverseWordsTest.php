<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ReverseWords;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReverseWordsTest extends TestCase
{
    #[Test]
    public function it_reverses_words_in_normal_sentences(): void
    {
        self::assertSame('world hello', ReverseWords::apply('hello world'));
        self::assertSame('c b a', ReverseWords::apply('a b c'));
        self::assertSame('one', ReverseWords::apply('one'));
    }

    #[Test]
    public function it_normalizes_whitespace_before_reversing(): void
    {
        self::assertSame('c b a', ReverseWords::apply("  a\tb \n c  "));
        self::assertSame('', ReverseWords::apply('   '));
        self::assertSame('b a', ReverseWords::apply("a\n\nb"));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', ReverseWords::apply(''));
        self::assertSame('x', ReverseWords::apply('x'));
        self::assertSame('z y x', ReverseWords::apply('x   y   z'));
    }
}
