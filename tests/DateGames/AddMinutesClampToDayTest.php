<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\AddMinutesClampToDay;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AddMinutesClampToDayTest extends TestCase
{
    #[Test]
    public function it_adds_minutes_within_same_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 10:00:00', $tz);

        self::assertSame('2025-01-15 10:30:00', AddMinutesClampToDay::add($dt, 30)->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 09:00:00', AddMinutesClampToDay::add($dt, -60)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_clamps_if_crossing_to_next_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 23:50:00', $tz);

        // +20 minutes would go to next day => clamp
        self::assertSame('2025-01-15 23:59:59', AddMinutesClampToDay::add($dt, 20)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $dt = new DateTimeImmutable('2025-01-15 23:50:00', $tz);
        $out = AddMinutesClampToDay::add($dt, 20);

        self::assertSame('UTC', $out->getTimezone()->getName());
        self::assertSame('2025-01-15 23:59:59', $out->format('Y-m-d H:i:s'));
    }
}
