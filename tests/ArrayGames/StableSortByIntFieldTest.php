<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\StableSortByIntField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StableSortByIntFieldTest extends TestCase
{
    #[Test]
    public function it_sorts_by_int_field_and_is_stable(): void
    {
        $items = [
            ['id' => 1, 'p' => 2],
            ['id' => 2, 'p' => 1],
            ['id' => 3, 'p' => 2], // same as id=1, must remain after it
            ['id' => 4, 'p' => 1], // same as id=2, must remain after it
        ];

        $out = StableSortByIntField::sort($items, 'p');
        self::assertSame([2, 4, 1, 3], array_column($out, 'id'));
    }

    #[Test]
    public function it_puts_missing_or_invalid_last(): void
    {
        $items = [
            ['id' => 1, 'p' => ' 2 '],
            ['id' => 2],
            ['id' => 3, 'p' => 'x'],
            ['id' => 4, 'p' => 1],
        ];

        $out = StableSortByIntField::sort($items, 'p');
        self::assertSame([4, 1, 2, 3], array_column($out, 'id'));
    }

    #[Test]
    public function it_handles_empty_and_single_item(): void
    {
        self::assertSame([], StableSortByIntField::sort([], 'p'));
        self::assertSame([['id' => 1, 'p' => 1]], StableSortByIntField::sort([['id' => 1, 'p' => 1]], 'p'));
        self::assertSame([['id' => 1]], StableSortByIntField::sort([['id' => 1]], 'p'));
    }
}
