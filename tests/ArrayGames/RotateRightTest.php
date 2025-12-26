<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\RotateRight;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RotateRightTest extends TestCase
{
    #[Test]
    public function it_rotates_right_basic_cases(): void
    {
        self::assertSame([4, 1, 2, 3], RotateRight::apply([1, 2, 3, 4], 1));
        self::assertSame([3, 4, 1, 2], RotateRight::apply([1, 2, 3, 4], 2));
        self::assertSame([1, 2, 3], RotateRight::apply([1, 2, 3], 0));
    }

    #[Test]
    public function it_handles_k_larger_than_length(): void
    {
        self::assertSame([3, 1, 2], RotateRight::apply([1, 2, 3], 4)); // 4 % 3 = 1
        self::assertSame([2, 3, 1], RotateRight::apply([1, 2, 3], 5)); // 5 % 3 = 2
        self::assertSame([], RotateRight::apply([], 10));
    }

    #[Test]
    public function it_reindexes_output(): void
    {
        $in = [10 => 'a', 20 => 'b', 30 => 'c'];
        self::assertSame(['c', 'a', 'b'], RotateRight::apply($in, 1));
    }
}
