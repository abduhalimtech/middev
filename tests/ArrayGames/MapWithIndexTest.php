<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\MapWithIndex;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapWithIndexTest extends TestCase
{
    #[Test]
    public function it_maps_value_plus_index(): void
    {
        self::assertSame([10, 11, 12], MapWithIndex::apply([10, 10, 10]));
        self::assertSame([1, 3, 5], MapWithIndex::apply([1, 2, 3]));
        self::assertSame([], MapWithIndex::apply([]));
    }

    #[Test]
    public function it_handles_negative_values(): void
    {
        self::assertSame([-1, 0, 1], MapWithIndex::apply([-1, -1, -1]));
        self::assertSame([-5], MapWithIndex::apply([-5]));
        self::assertSame([0, 2], MapWithIndex::apply([0, 1]));
    }

    #[Test]
    public function it_reindexes_even_with_weird_keys(): void
    {
        $in = [10 => 5, 20 => 5, 30 => 5];
        self::assertSame([5, 6, 7], MapWithIndex::apply($in));
    }
}
