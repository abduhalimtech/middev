<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\CountByNormalizedKey;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CountByNormalizedKeyTest extends TestCase
{
    #[Test]
    public function it_counts_by_normalized_key(): void
    {
        $in = [' Apple ', 'apple', 'APPLE', '  ', 'Banana', 'banana ', 'BANANA'];
        self::assertSame(['apple' => 3, 'banana' => 3], CountByNormalizedKey::count($in));
    }
}
