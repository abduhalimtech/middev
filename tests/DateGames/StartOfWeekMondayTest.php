<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\StartOfWeekMonday;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StartOfWeekMondayTest extends TestCase
{
    #[Test]
    public function it_returns_monday_for_weekdays(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-13 00:00:00',
            StartOfWeekMonday::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz))->format('Y-m-d H:i:s')
        ); // Wed -> Mon

        self::assertSame(
            '2025-01-13 00:00:00',
            StartOfWeekMonday::from(new DateTimeImmutable('2025-01-13 23:59:59', $tz))->format('Y-m-d H:i:s')
        ); // Mon -> Mon
    }

    #[Test]
    public function it_handles_sunday_correctly(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-13 00:00:00',
            StartOfWeekMonday::from(new DateTimeImmutable('2025-01-19 12:00:00', $tz))->format('Y-m-d H:i:s')
        ); // Sun -> previous Mon
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = StartOfWeekMonday::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}
