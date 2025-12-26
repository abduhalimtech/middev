<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\ShiftToNextBusinessDay;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ShiftToNextBusinessDayTest extends TestCase
{
    #[Test]
    public function it_returns_same_date_if_business_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 10:00:00', $tz); // Wed

        self::assertSame('2025-01-15 10:00:00', ShiftToNextBusinessDay::shift($dt, [])->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_weekend_to_monday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz); // Sat

        self::assertSame('2025-01-20 10:00:00', ShiftToNextBusinessDay::shift($dt, [])->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_weekend_and_holidays_chain(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz); // Sat

        // Mon+Tue holidays => Wed
        self::assertSame(
            '2025-01-22 10:00:00',
            ShiftToNextBusinessDay::shift($dt, ['2025-01-20', '2025-01-21'])->format('Y-m-d H:i:s')
        );
    }
}
