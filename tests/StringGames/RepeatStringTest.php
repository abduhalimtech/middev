<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RepeatString;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RepeatStringTest extends TestCase
{
    #[Test]
    public function it_repeats_strings_correctly(): void
    {
        self::assertSame('aaa', RepeatString::make('a', 3));
        self::assertSame('abab', RepeatString::make('ab', 2));
        self::assertSame('', RepeatString::make('x', 0));
    }

    #[Test]
    public function it_handles_empty_string_input(): void
    {
        self::assertSame('', RepeatString::make('', 3));
        self::assertSame('', RepeatString::make('', 0));
        self::assertSame('   ', RepeatString::make(' ', 3));
    }

    #[Test]
    public function it_throws_on_negative_times(): void
    {
        $this->expectException(InvalidArgumentException::class);
        RepeatString::make('a', -1);
    }
}
