<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\ZipArrays;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ZipArraysTest extends TestCase
{
    #[Test]
    public function it_zips_basic_arrays(): void
    {
        self::assertSame([[1,'a'], [2,'b']], ZipArrays::zip([1,2], ['a','b']));
        self::assertSame([[1,10],[2,20],[3,30]], ZipArrays::zip([1,2,3], [10,20,30]));
        self::assertSame([], ZipArrays::zip([], []));
    }

    #[Test]
    public function it_stops_at_shorter_length(): void
    {
        self::assertSame([[1,'a']], ZipArrays::zip([1,2,3], ['a']));
        self::assertSame([[1,'a'],[2,'b']], ZipArrays::zip([1,2], ['a','b','c']));
        self::assertSame([], ZipArrays::zip([], ['x']));
    }

    #[Test]
    public function it_reindexes_even_with_weird_keys(): void
    {
        $a = [10 => 'x', 20 => 'y'];
        $b = [5 => 1, 6 => 2, 7 => 3];
        self::assertSame([['x',1],['y',2]], ZipArrays::zip($a, $b));
    }
}
