<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FrequenciesNormalizedLower;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FrequenciesNormalizedLowerTest extends TestCase
{
    #[Test]
    public function it_counts_normalized_strings(): void
    {
        self::assertSame(['a' => 3, 'b' => 1], FrequenciesNormalizedLower::from(['A',' a ','a','B']));
        self::assertSame(['x' => 2], FrequenciesNormalizedLower::from(['x','X']));
        self::assertSame([], FrequenciesNormalizedLower::from([]));
    }

    #[Test]
    public function it_ignores_non_strings_and_empty(): void
    {
        self::assertSame(['hi' => 1], FrequenciesNormalizedLower::from(['  hi ', '', '  ', null, 1, true]));
        self::assertSame([], FrequenciesNormalizedLower::from([null, 1, [], new \stdClass()]));
        self::assertSame(['0' => 2], FrequenciesNormalizedLower::from(['0', ' 0 ']));
    }

    #[Test]
    public function it_handles_many_occurrences(): void
    {
        $in = array_merge(array_fill(0, 5, 'A'), ['b', 'B', ' b ']);
        self::assertSame(['a' => 5, 'b' => 3], FrequenciesNormalizedLower::from($in));
    }
}
