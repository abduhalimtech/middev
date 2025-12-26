<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PartitionByType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PartitionByTypeTest extends TestCase
{
    #[Test]
    public function it_partitions_into_three_buckets(): void
    {
        $in = [1, '1', 'a', null, 2, true, 'b'];
        $out = PartitionByType::split($in);

        self::assertSame([1, 2], $out['ints']);
        self::assertSame(['1', 'a', 'b'], $out['strings']);
        self::assertSame([null, true], $out['others']);
    }

    #[Test]
    public function it_preserves_order_and_reindexes(): void
    {
        $in = [10 => 1, 20 => 'x', 30 => 2, 40 => 'y'];
        $out = PartitionByType::split($in);

        self::assertSame([1, 2], $out['ints']);
        self::assertSame(['x', 'y'], $out['strings']);
        self::assertSame([], $out['others']);
    }

    #[Test]
    public function it_handles_empty_and_all_others(): void
    {
        self::assertSame(['ints' => [], 'strings' => [], 'others' => []], PartitionByType::split([]));

        $out = PartitionByType::split([null, false, 1.2, []]);
        self::assertSame([], $out['ints']);
        self::assertSame([], $out['strings']);
        self::assertSame([null, false, 1.2, []], $out['others']);
    }
}
