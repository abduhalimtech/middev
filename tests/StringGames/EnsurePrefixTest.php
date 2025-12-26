<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\EnsurePrefix;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EnsurePrefixTest extends TestCase
{
    #[Test]
    public function it_adds_prefix_when_missing(): void
    {
        self::assertSame('pre-hello', EnsurePrefix::apply('hello', 'pre-'));
        self::assertSame('https://site.com', EnsurePrefix::apply('site.com', 'https://'));
        self::assertSame('x', EnsurePrefix::apply('x', ''));
    }

    #[Test]
    public function it_keeps_string_when_prefix_present(): void
    {
        self::assertSame('pre-hello', EnsurePrefix::apply('pre-hello', 'pre-'));
        self::assertSame('aaaa', EnsurePrefix::apply('aaaa', 'a'));
        self::assertSame('', EnsurePrefix::apply('', 'pre'));
    }

    #[Test]
    public function it_is_case_sensitive(): void
    {
        self::assertSame('Pre-hello', EnsurePrefix::apply('hello', 'Pre-'));
        self::assertSame('pre-hello', EnsurePrefix::apply('hello', 'pre-'));
        self::assertSame('Pre-pre', EnsurePrefix::apply('pre', 'Pre-'));
    }
}
