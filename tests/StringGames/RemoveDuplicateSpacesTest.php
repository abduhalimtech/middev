<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RemoveDuplicateSpaces;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveDuplicateSpacesTest extends TestCase
{
    #[Test]
    public function it_collapses_only_spaces_not_other_whitespace(): void
    {
        self::assertSame('a b c', RemoveDuplicateSpaces::apply('a  b   c'));
        self::assertSame("a\t b", RemoveDuplicateSpaces::apply("a\t  b")); // tab stays, spaces collapse
        self::assertSame("a\n b", RemoveDuplicateSpaces::apply("a\n  b")); // newline stays, spaces collapse
    }

    #[Test]
    public function it_does_not_trim(): void
    {
        self::assertSame(' a', RemoveDuplicateSpaces::apply('  a'));
        self::assertSame('a ', RemoveDuplicateSpaces::apply('a  '));
        self::assertSame(' ', RemoveDuplicateSpaces::apply('   '));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', RemoveDuplicateSpaces::apply(''));
        self::assertSame('a', RemoveDuplicateSpaces::apply('a'));
        self::assertSame('a b', RemoveDuplicateSpaces::apply('a b'));
    }
}
