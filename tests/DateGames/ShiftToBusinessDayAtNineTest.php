<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\ShiftToBusinessDayAtNine;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ShiftToBusinessDayAtNineTest extends TestCase
{
    #[Test]
    public function it_returns_same_date_at_nine_if_business_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 20:30:00', $tz); // Wed
        $out = ShiftToBusinessDayAtNine::shift($dt, []);

        self::assertSame('2025-01-15 09:00:00', $out->format('Y-m-d H:i:s'));
        self::assertSame('Asia/Tashkent', $out->getTimezone()->getName());
    }

    #[Test]
    public function it_skips_weekend_to_monday_at_nine(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz); // Sat
        $out = ShiftToBusinessDayAtNine::shift($dt, []);

        self::assertSame('2025-01-20 09:00:00', $out->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_weekend_and_holiday_chain(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        // Sat -> Mon (holiday) -> Tue
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz);
        $out = ShiftToBusinessDayAtNine::shift($dt, ['2025-01-20']);

        self::assertSame('2025-01-21 09:00:00', $out->format('Y-m-d H:i:s'));
    }
}
