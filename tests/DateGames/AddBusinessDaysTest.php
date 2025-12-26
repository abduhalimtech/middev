<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\AddBusinessDays;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AddBusinessDaysTest extends TestCase
{
    #[Test]
    public function it_adds_business_days_skipping_weekends(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-17 10:00:00', $tz); // Fri

        // +1 business day => Mon
        self::assertSame('2025-01-20 10:00:00', AddBusinessDays::add($dt, 1, [])->format('Y-m-d H:i:s'));

        // +2 => Tue
        self::assertSame('2025-01-21 10:00:00', AddBusinessDays::add($dt, 2, [])->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_holidays_as_non_business_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-17 10:00:00', $tz); // Fri

        // Mon is holiday => +1 should land on Tue
        self::assertSame(
            '2025-01-21 10:00:00',
            AddBusinessDays::add($dt, 1, ['2025-01-20'])->format('Y-m-d H:i:s')
        );

        // Tue is also holiday => land on Wed
        self::assertSame(
            '2025-01-22 10:00:00',
            AddBusinessDays::add($dt, 1, ['2025-01-20', '2025-01-21'])->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_supports_negative_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-20 10:00:00', $tz); // Mon

        // -1 business day => Fri
        self::assertSame('2025-01-17 10:00:00', AddBusinessDays::add($dt, -1, [])->format('Y-m-d H:i:s'));

        // -1 with Fri as holiday => Thu
        self::assertSame(
            '2025-01-16 10:00:00',
            AddBusinessDays::add($dt, -1, ['2025-01-17'])->format('Y-m-d H:i:s')
        );
    }
}
