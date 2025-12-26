<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\IsHoliday;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsHolidayTest extends TestCase
{
    #[Test]
    public function it_detects_holidays_by_local_date(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $holidays = ['2025-01-01', '2025-03-08'];

        self::assertTrue(IsHoliday::check(new DateTimeImmutable('2025-01-01 10:00:00', $tz), $holidays));
        self::assertTrue(IsHoliday::check(new DateTimeImmutable('2025-03-08 00:00:00', $tz), $holidays));
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-01-02 10:00:00', $tz), $holidays));
    }

    #[Test]
    public function it_handles_empty_holidays(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-01-01', $tz), []));
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-03-08', $tz), []));
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-12-31', $tz), []));
    }

    #[Test]
    public function it_uses_timezone_for_date_comparison(): void
    {
        // UTC time late night may be next day in Asia/Tashkent
        $holidays = ['2025-01-02'];

        $utc = new DateTimeImmutable('2025-01-01 22:30:00', new \DateTimeZone('UTC'));
        $tash = $utc->setTimezone(new \DateTimeZone('Asia/Tashkent')); // +5 => 2025-01-02

        self::assertFalse(IsHoliday::check($utc, $holidays));
        self::assertTrue(IsHoliday::check($tash, $holidays));
    }
}
