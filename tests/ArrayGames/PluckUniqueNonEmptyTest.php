<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PluckUniqueNonEmpty;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PluckUniqueNonEmptyTest extends TestCase
{
    #[Test]
    public function it_plucks_unique_non_empty(): void
    {
        $items = [
            ['id' => 1, 'tag' => '  A '],
            ['id' => 2, 'tag' => 'A'],
            ['id' => 3, 'tag' => ''],
            ['id' => 4],
            ['id' => 5, 'tag' => 'B'],
            ['id' => 6, 'tag' => '  B  '],
        ];

        self::assertSame(['A', 'B'], PluckUniqueNonEmpty::from($items, 'tag'));
    }
}
