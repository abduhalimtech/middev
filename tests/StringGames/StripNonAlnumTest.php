<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\StripNonAlnum;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StripNonAlnumTest extends TestCase
{
    #[Test]
    public function it_strips_non_alphanumeric_chars(): void
    {
        self::assertSame('abc123', StripNonAlnum::apply('a-b_c 1!2@3'));
        self::assertSame('HelloWorld', StripNonAlnum::apply('Hello, World!'));
        self::assertSame('', StripNonAlnum::apply('***'));
    }

    #[Test]
    public function it_handles_empty_and_spaces(): void
    {
        self::assertSame('', StripNonAlnum::apply(''));
        self::assertSame('', StripNonAlnum::apply('   '));
        self::assertSame('A', StripNonAlnum::apply(' A '));
    }

    #[Test]
    public function it_keeps_digits_and_letters_only(): void
    {
        self::assertSame('AZaz09', StripNonAlnum::apply('AZaz09'));
        self::assertSame('x1', StripNonAlnum::apply('x-1'));
        self::assertSame('B2', StripNonAlnum::apply('B_2'));
    }
}
