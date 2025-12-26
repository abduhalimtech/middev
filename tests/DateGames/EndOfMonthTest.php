<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\EndOfMonth;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EndOfMonthTest extends TestCase
{
    #[Test]
    public function it_returns_last_day_for_common_months(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-04-30 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2025-04-10 01:02:03', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-01-31 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2025-01-01 00:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_handles_leap_year_february(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2024-02-29 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2024-02-10 10:00:00', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-02-28 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2025-02-10 10:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = EndOfMonth::for(new DateTimeImmutable('2025-02-10 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}
