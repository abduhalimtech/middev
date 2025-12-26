<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\NormalizeSpaces;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NormalizeSpacesTest extends TestCase
{
    #[Test]
    public function it_normalizes_whitespace(): void
    {
        self::assertSame('a b c', NormalizeSpaces::apply("  a\t b \n  c  "));
    }
}
