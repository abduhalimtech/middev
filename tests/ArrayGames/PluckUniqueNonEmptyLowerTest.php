<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PluckUniqueNonEmptyLower;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PluckUniqueNonEmptyLowerTest extends TestCase
{
    #[Test]
    public function it_plucks_normalizes_and_uniques(): void
    {
        $items = [
            ['id' => 1, 'tag' => '  Apple '],
            ['id' => 2, 'tag' => 'apple'],
            ['id' => 3, 'tag' => 'BANANA'],
            ['id' => 4, 'tag' => ' banana '],
        ];

        self::assertSame(['apple', 'banana'], PluckUniqueNonEmptyLower::from($items, 'tag'));
    }

    #[Test]
    public function it_ignores_missing_non_string_and_empty(): void
    {
        $items = [
            ['id' => 1],
            ['id' => 2, 'tag' => '   '],
            ['id' => 3, 'tag' => null],
            ['id' => 4, 'tag' => 123],
            ['id' => 5, 'tag' => 'X'],
        ];

        self::assertSame(['x'], PluckUniqueNonEmptyLower::from($items, 'tag'));
        self::assertSame([], PluckUniqueNonEmptyLower::from([], 'tag'));
    }

    #[Test]
    public function it_preserves_first_occurrence_order(): void
    {
        $items = [
            ['tag' => 'B'],
            ['tag' => 'A'],
            ['tag' => 'b'],
            ['tag' => 'a'],
            ['tag' => 'C'],
        ];

        self::assertSame(['b', 'a', 'c'], PluckUniqueNonEmptyLower::from($items, 'tag'));
    }
}
