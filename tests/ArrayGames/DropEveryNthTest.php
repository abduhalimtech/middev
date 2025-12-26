<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\DropEveryNth;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DropEveryNthTest extends TestCase
{
    #[Test]
    public function it_drops_every_nth_element(): void
    {
        self::assertSame([1, 3, 5], DropEveryNth::apply([1, 2, 3, 4, 5, 6], 2));
        self::assertSame(['a', 'b', 'd', 'e'], DropEveryNth::apply(['a', 'b', 'c', 'd', 'e', 'f'], 3));
        self::assertSame([], DropEveryNth::apply([], 2));
    }

    #[Test]
    public function it_handles_n_equals_one(): void
    {
        self::assertSame([], DropEveryNth::apply([1, 2, 3], 1)); // drop all
        self::assertSame([], DropEveryNth::apply(['x'], 1));
        self::assertSame([], DropEveryNth::apply([], 1));
    }

    #[Test]
    public function it_throws_on_invalid_n(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DropEveryNth::apply([1, 2, 3], 0);
    }
}
