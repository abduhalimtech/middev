<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\GroupByFirstChar;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GroupByFirstCharTest extends TestCase
{
    #[Test]
    public function it_groups_by_first_char_lowercased(): void
    {
        self::assertSame(
            ['a' => ['Apple', 'apricot'], 'b' => ['Banana']],
            GroupByFirstChar::group(['Apple', 'Banana', 'apricot'])
        );

        self::assertSame(
            ['x' => ['x', 'Xy'], 'y' => ['y']],
            GroupByFirstChar::group(['x', 'y', 'Xy'])
        );
    }

    #[Test]
    public function it_trims_and_ignores_empty(): void
    {
        self::assertSame(['a' => ['A']], GroupByFirstChar::group(['  ', ' A ', '']));
        self::assertSame([], GroupByFirstChar::group([]));
        self::assertSame(['h' => ['hi']], GroupByFirstChar::group(["\nhi\n"]));
    }

    #[Test]
    public function it_preserves_order_within_groups(): void
    {
        $in = ['Apple', 'Axe', 'apricot', 'Banana', 'boat'];
        $out = GroupByFirstChar::group($in);
        self::assertSame(['Apple', 'Axe', 'apricot'], $out['a']);
        self::assertSame(['Banana', 'boat'], $out['b']);
    }
}
