<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ExtractBetweenFirstLast;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ExtractBetweenFirstLastTest extends TestCase
{
    #[Test]
    public function it_extracts_between_first_start_and_last_end(): void
    {
        self::assertSame('core]yy[more', ExtractBetweenFirstLast::get('xx[core]yy[more]zz', '[', ']'));
        self::assertSame('b--c', ExtractBetweenFirstLast::get('a<b--c>d<e>f', '<', '>'));
        self::assertSame('x', ExtractBetweenFirstLast::get('((x))', '((', '))'));
    }

    #[Test]
    public function it_returns_empty_when_markers_missing_or_invalid_order(): void
    {
        self::assertSame('', ExtractBetweenFirstLast::get('no markers', '[', ']'));
        self::assertSame('', ExtractBetweenFirstLast::get('xx[start only', '[', ']'));
        self::assertSame('', ExtractBetweenFirstLast::get(']end before start[', '[', ']'));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', ExtractBetweenFirstLast::get('', '[', ']'));
        self::assertSame('', ExtractBetweenFirstLast::get('[]', '[', ']')); // empty inside
        self::assertSame('', ExtractBetweenFirstLast::get('a', '[', ']'));
    }
}
