<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\LeftPad;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LeftPadTest extends TestCase
{
    #[Test]
    public function it_pads_to_length(): void
    {
        self::assertSame('0005', LeftPad::apply('5', 4, '0'));
        self::assertSame('---a', LeftPad::apply('a', 4, '-'));
        self::assertSame('a', LeftPad::apply('a', 1, '0'));
    }

    #[Test]
    public function it_returns_original_if_already_long_enough(): void
    {
        self::assertSame('hello', LeftPad::apply('hello', 3, '0'));
        self::assertSame('', LeftPad::apply('', 0, '0'));
        self::assertSame('ab', LeftPad::apply('ab', 2, 'x'));
    }

    #[Test]
    public function it_throws_on_invalid_pad_char(): void
    {
        $this->expectException(InvalidArgumentException::class);
        LeftPad::apply('a', 3, 'xx');
    }
}
