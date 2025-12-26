<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\NextDay;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NextDayTest extends TestCase
{
    #[Test]
    public function it_adds_one_day_preserving_time(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame(
            '2025-01-16 10:00:00',
            NextDay::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_handles_month_rollover(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame(
            '2025-02-01 23:59:59',
            NextDay::from(new DateTimeImmutable('2025-01-31 23:59:59', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = NextDay::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}
