<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\RemoveFirstLast;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveFirstLastTest extends TestCase
{
    #[Test]
    public function it_removes_first_and_last_when_possible(): void
    {
        self::assertSame([2, 3], RemoveFirstLast::apply([1, 2, 3, 4]));
        self::assertSame(['b'], RemoveFirstLast::apply(['a', 'b', 'c']));
        self::assertSame([1, 1], RemoveFirstLast::apply([9, 1, 1, 8]));
    }

    #[Test]
    public function it_returns_original_for_small_arrays(): void
    {
        self::assertSame([], RemoveFirstLast::apply([]));
        self::assertSame([1], RemoveFirstLast::apply([1]));
        self::assertSame([1, 2], RemoveFirstLast::apply([1, 2]));
    }

    #[Test]
    public function it_reindexes_output(): void
    {
        $in = [10 => 'x', 20 => 'y', 30 => 'z', 40 => 'w'];
        self::assertSame(['y', 'z'], RemoveFirstLast::apply($in));
    }
}
