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
    public function it_detects_weekend_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-18', $tz))); // Sat
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-19', $tz))); // Sun
    }

    #[Test]
    public function it_detects_weekdays(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-20', $tz))); // Mon
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-15', $tz))); // Wed
    }

    #[Test]
    public function it_works_with_different_timezones(): void
    {
        $tz = new \DateTimeZone('UTC');
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-18 23:00:00', $tz)));
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-20 00:00:00', $tz)));
    }
}
