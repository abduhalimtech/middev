<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\IsPalindromeNormalized;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsPalindromeNormalizedTest extends TestCase
{
    #[Test]
    public function it_detects_palindromes_ignoring_non_alnum_and_case(): void
    {
        self::assertTrue(IsPalindromeNormalized::check('A man, a plan, a canal: Panama'));
        self::assertTrue(IsPalindromeNormalized::check('No lemon, no melon'));
        self::assertFalse(IsPalindromeNormalized::check('hello'));
    }

    #[Test]
    public function it_handles_empty_and_symbols_only(): void
    {
        self::assertTrue(IsPalindromeNormalized::check(''));
        self::assertTrue(IsPalindromeNormalized::check('***'));
        self::assertTrue(IsPalindromeNormalized::check('  '));
    }

    #[Test]
    public function it_handles_digits_and_mixed_cases(): void
    {
        self::assertTrue(IsPalindromeNormalized::check('1a2A1'));
        self::assertFalse(IsPalindromeNormalized::check('12a'));
        self::assertTrue(IsPalindromeNormalized::check('0P0'));
    }
}
