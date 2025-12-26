<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FlattenDeep;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FlattenDeepTest extends TestCase
{
    #[Test]
    public function it_flattens_nested_arrays(): void
    {
        self::assertSame([1, 2, 3, 4], FlattenDeep::apply([1, [2, [3]], 4]));
        self::assertSame(['a', 'b', 'c'], FlattenDeep::apply([['a'], [['b']], 'c']));
        self::assertSame([], FlattenDeep::apply([]));
    }

    #[Test]
    public function it_keeps_non_arrays_and_nulls(): void
    {
        self::assertSame([null, 1, 'x'], FlattenDeep::apply([null, [1, ['x']]]));
        self::assertSame([true, false], FlattenDeep::apply([[true], [[false]]]));
        self::assertSame([0, 0], FlattenDeep::apply([[0], 0]));
    }

    #[Test]
    public function it_preserves_order(): void
    {
        $in = [1, [2, [3, [4]]], 5, [[6]], 7];
        self::assertSame([1,2,3,4,5,6,7], FlattenDeep::apply($in));
    }
}
