<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\NextMondayIfWeekend;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NextMondayIfWeekendTest extends TestCase
{
    #[Test]
    public function it_moves_saturday_and_sunday_to_next_monday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-20 10:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-18 10:00:00', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-01-20 10:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-19 10:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_keeps_weekdays_unchanged(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-20 10:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-20 10:00:00', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-01-15 09:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-15 09:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-18 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}
