<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RemoveVowels;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveVowelsTest extends TestCase
{
    #[Test]
    public function it_removes_vowels(): void
    {
        self::assertSame('Hll Wrld!', RemoveVowels::apply('Hello World!'));
    }
}
