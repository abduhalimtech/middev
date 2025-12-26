<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\WindowMax;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class WindowMaxTest extends TestCase
{
    #[Test]
    public function it_computes_window_max_for_normal_cases(): void
    {
        self::assertSame([3, 3, 5], WindowMax::compute([1, 3, -1, -3, 5], 3));
        self::assertSame([2, 2, 2], WindowMax::compute([2, 2, 2, 2], 2));
        self::assertSame([10], WindowMax::compute([10], 1));
    }

    #[Test]
    public function it_handles_negative_numbers(): void
    {
        // Window 1: [-1, -2] -> max -1
        // Window 2: [-2, -3] -> max -2
        self::assertSame([-1, -2], WindowMax::compute([-1, -2, -3], 2));

        self::assertSame([-5], WindowMax::compute([-5, -10], 2));

        // Window 1: [-2, 0] -> max 0
        // Window 2: [0, -1] -> max 0
        self::assertSame([0, 0], WindowMax::compute([-2, 0, -1], 2));
    }

    #[Test]
    public function it_throws_on_invalid_k(): void
    {
        $this->expectException(InvalidArgumentException::class);
        WindowMax::compute([1, 2, 3], 0);
    }
}
