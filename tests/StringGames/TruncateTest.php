<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\Truncate;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TruncateTest extends TestCase
{
    #[Test]
    public function it_returns_original_if_not_longer_than_max(): void
    {
        self::assertSame('hello', Truncate::apply('hello', 5));
        self::assertSame('', Truncate::apply('', 3));
        self::assertSame('ab', Truncate::apply('ab', 3));
    }

    #[Test]
    public function it_truncates_and_adds_ellipsis(): void
    {
        self::assertSame('h...', Truncate::apply('hello', 4));
        self::assertSame('...', Truncate::apply('hello', 3));
        self::assertSame('az...', Truncate::apply('aziz', 5));
    }

    #[Test]
    public function it_throws_when_max_too_small(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Truncate::apply('hello', 2);
    }
}
