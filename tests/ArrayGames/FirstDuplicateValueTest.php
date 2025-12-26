<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FirstDuplicateValue;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FirstDuplicateValueTest extends TestCase
{
    #[Test]
    public function it_returns_first_value_that_repeats(): void
    {
        self::assertSame(2, FirstDuplicateValue::find([1, 2, 3, 2, 1]));
        self::assertSame('a', FirstDuplicateValue::find(['a', 'b', 'a']));
        self::assertSame(0, FirstDuplicateValue::find([0, 1, 0, 1])); // 0 repeats first
    }

    #[Test]
    public function it_uses_strict_equality(): void
    {
        // '1' !== 1, so duplicate is 1 when second 1 appears
        self::assertSame(1, FirstDuplicateValue::find(['1', 1, 2, 1]));
        self::assertSame('1', FirstDuplicateValue::find(['1', 1, '1']));
    }

    #[Test]
    public function it_throws_when_no_duplicates(): void
    {
        $this->expectException(InvalidArgumentException::class);
        FirstDuplicateValue::find([1, 2, 3]);
    }
}
