<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\LastWordLength;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LastWordLengthTest extends TestCase
{
    #[Test]
    public function it_gets_last_word_length(): void
    {
        self::assertSame(5, LastWordLength::get('hello world'));
        self::assertSame(5, LastWordLength::get('hello world   '));
        self::assertSame(0, LastWordLength::get('   '));
    }
}
