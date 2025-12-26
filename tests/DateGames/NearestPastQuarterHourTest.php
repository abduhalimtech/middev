<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\NearestPastQuarterHour;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NearestPastQuarterHourTest extends TestCase
{
    #[Test]
    public function it_rounds_down_correctly(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame('2025-01-15 10:00:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:14:59', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 10:15:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:15:00', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 10:15:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:29:10', $tz))->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_handles_hour_boundary(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame('2025-01-15 11:45:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 11:59:59', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 12:00:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 12:00:01', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 12:30:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 12:44:00', $tz))->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:14:59', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}
