<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\RunningSum;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RunningSumTest extends TestCase
{
    #[Test]
    public function it_builds_running_sum(): void
    {
        self::assertSame([1, 3, 6], RunningSum::from([1, 2, 3]));
        self::assertSame([0, 0, 1], RunningSum::from([0, 0, 1]));
        self::assertSame([], RunningSum::from([]));
    }

    #[Test]
    public function it_handles_negative_values(): void
    {
        self::assertSame([-1, -3, -6], RunningSum::from([-1, -2, -3]));
        self::assertSame([5, 3, 3], RunningSum::from([5, -2, 0]));
        self::assertSame([10], RunningSum::from([10]));
    }

    #[Test]
    public function it_reindexes_even_with_weird_keys(): void
    {
        $in = [10 => 1, 20 => 2, 30 => 3];
        self::assertSame([1, 3, 6], RunningSum::from($in));
    }
}
