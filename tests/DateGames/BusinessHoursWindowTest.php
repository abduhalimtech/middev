<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\BusinessHoursWindow;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class BusinessHoursWindowTest extends TestCase
{
    #[Test]
    public function it_moves_time_up_to_9_if_before_open(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 08:30:00', $tz);

        self::assertSame('2025-01-15 09:00:00', BusinessHoursWindow::normalize($dt)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_keeps_time_if_within_business_hours(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame('2025-01-15 09:00:00', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-15 09:00:00', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 17:59:59', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-15 17:59:59', $tz))->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_moves_to_next_day_9_if_after_close(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame('2025-01-16 09:00:00', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-15 18:00:00', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-02-01 09:00:00', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-31 19:00:00', $tz))->format('Y-m-d H:i:s'));
    }
}
