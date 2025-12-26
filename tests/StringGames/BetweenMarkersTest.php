<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\BetweenMarkers;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class BetweenMarkersTest extends TestCase
{
    #[Test]
    public function it_extracts_between_markers(): void
    {
        self::assertSame('core', BetweenMarkers::get('xx[core]yy', '[', ']'));
    }

    #[Test]
    public function it_returns_empty_on_missing(): void
    {
        self::assertSame('', BetweenMarkers::get('xx core yy', '[', ']'));
        self::assertSame('', BetweenMarkers::get('xx[core yy', '[', ']'));
    }
}
