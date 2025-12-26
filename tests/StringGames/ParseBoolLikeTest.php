<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ParseBoolLike;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParseBoolLikeTest extends TestCase
{
    #[Test]
    public function it_parses_true_values(): void
    {
        self::assertSame(true, ParseBoolLike::parse('1'));
        self::assertSame(true, ParseBoolLike::parse(' true '));
        self::assertSame(true, ParseBoolLike::parse('YES'));
    }

    #[Test]
    public function it_parses_false_values(): void
    {
        self::assertSame(false, ParseBoolLike::parse('0'));
        self::assertSame(false, ParseBoolLike::parse(' false '));
        self::assertSame(false, ParseBoolLike::parse('off'));
    }

    #[Test]
    public function it_returns_null_for_unknown(): void
    {
        self::assertNull(ParseBoolLike::parse('maybe'));
        self::assertNull(ParseBoolLike::parse(''));
        self::assertNull(ParseBoolLike::parse('2'));
    }
}
