<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\IntStats;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IntStatsTest extends TestCase
{
    #[Test]
    public function it_computes_stats_with_mixed_values(): void
    {
        $in = [3, ' 2 ', 'x', -1, -1, 1.2, true, null, [], new \stdClass(), '0010', '-0007'];
        // valid ints => [3,2,-1,10,-7]
        self::assertSame(['min' => -7, 'max' => 10, 'unique' => 5], IntStats::from($in));
    }

    #[Test]
    public function it_handles_extreme_ints_and_rejects_out_of_range_strings(): void
    {
        $in = [PHP_INT_MIN, '  '.PHP_INT_MAX.'  ', '9223372036854775808', '-9223372036854775809'];
        // last 2 are out of range on 64-bit => ignore
        self::assertSame(
            ['min' => PHP_INT_MIN, 'max' => PHP_INT_MAX, 'unique' => 2],
            IntStats::from($in)
        );
    }

    #[Test]
    public function it_throws_when_no_valid_integers(): void
    {
        $this->expectException(InvalidArgumentException::class);
        IntStats::from(['', '  ', '1.2', '1e3', null, true, 2.5, []]);
    }
}
