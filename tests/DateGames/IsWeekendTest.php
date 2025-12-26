<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\IsWeekend;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsWeekendTest extends TestCase
{
    #[Test]
    public function it_detects_weekend(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-18', $tz))); // Sat
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-19', $tz))); // Sun
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-20', $tz))); // Mon
    }
}
