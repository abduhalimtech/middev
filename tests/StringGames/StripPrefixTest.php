<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\StripPrefix;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StripPrefixTest extends TestCase
{
    #[Test]
    public function it_strips_prefix_when_present(): void
    {
        self::assertSame('hello', StripPrefix::apply('pre-hello', 'pre-'));
        self::assertSame('site.com', StripPrefix::apply('https://site.com', 'https://'));
        self::assertSame('', StripPrefix::apply('pre', 'pre'));
    }

    #[Test]
    public function it_returns_original_when_missing_or_empty_prefix(): void
    {
        self::assertSame('hello', StripPrefix::apply('hello', 'pre-'));
        self::assertSame('hello', StripPrefix::apply('hello', ''));
        self::assertSame('', StripPrefix::apply('', 'pre-'));
    }

    #[Test]
    public function it_is_case_sensitive(): void
    {
        self::assertSame('Pre-hello', StripPrefix::apply('Pre-hello', 'pre-'));
        self::assertSame('hello', StripPrefix::apply('pre-hello', 'pre-'));
        self::assertSame('pre-hello', StripPrefix::apply('pre-hello', 'Pre-'));
    }
}
