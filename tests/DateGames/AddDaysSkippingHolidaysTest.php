<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\AddDaysSkippingHolidays;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AddDaysSkippingHolidaysTest extends TestCase
{
    #[Test]
    public function it_adds_days_and_skips_single_holiday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-10 12:00:00', $tz);

        // +3 => 2025-01-13, but 13 is holiday => 14
        self::assertSame(
            '2025-01-14 12:00:00',
            AddDaysSkippingHolidays::add($dt, 3, ['2025-01-13'])->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_skips_holiday_chains_and_handles_zero_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-10 12:00:00', $tz);

        // +1 => 11, but 11 and 12 are holidays => 13
        self::assertSame(
            '2025-01-13 12:00:00',
            AddDaysSkippingHolidays::add($dt, 1, ['2025-01-11', '2025-01-12'])->format('Y-m-d H:i:s')
        );

        // +0 lands on holiday => move forward
        self::assertSame(
            '2025-01-11 12:00:00',
            AddDaysSkippingHolidays::add($dt, 0, ['2025-01-10'])->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone_and_time(): void
    {
        $tz = new \DateTimeZone('UTC');
        $dt = new DateTimeImmutable('2025-01-10 23:59:59', $tz);

        $out = AddDaysSkippingHolidays::add($dt, 1, []);
        self::assertSame('UTC', $out->getTimezone()->getName());
        self::assertSame('2025-01-11 23:59:59', $out->format('Y-m-d H:i:s'));
    }
}
