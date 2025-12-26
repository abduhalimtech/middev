<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\CollapseRepeats;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CollapseRepeatsTest extends TestCase
{
    #[Test]
    public function it_collapses_basic_repeats(): void
    {
        self::assertSame('abc', CollapseRepeats::apply('aaabbc'));
        self::assertSame('ab', CollapseRepeats::apply('aabb'));
        self::assertSame('a', CollapseRepeats::apply('aaaa'));
    }

    #[Test]
    public function it_handles_empty_and_single(): void
    {
        self::assertSame('', CollapseRepeats::apply(''));
        self::assertSame('x', CollapseRepeats::apply('x'));
        self::assertSame('xy', CollapseRepeats::apply('xy'));
    }

    #[Test]
    public function it_preserves_spaces_and_symbols(): void
    {
        self::assertSame('a b', CollapseRepeats::apply('a  b'));
        self::assertSame('!-', CollapseRepeats::apply('!!--'));
        self::assertSame('a-b', CollapseRepeats::apply('a--b'));
    }
}
