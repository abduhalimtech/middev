<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\DiffInFullDays;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DiffInFullDaysTest extends TestCase
{
    #[Test]
    public function it_returns_absolute_days_difference(): void
    {
        $tz = new \DateTimeZone('UTC');

        self::assertSame(0, DiffInFullDays::between(
            new DateTimeImmutable('2025-01-01 00:00:00', $tz),
            new DateTimeImmutable('2025-01-01 23:59:59', $tz),
        ));

        self::assertSame(1, DiffInFullDays::between(
            new DateTimeImmutable('2025-01-01 00:00:00', $tz),
            new DateTimeImmutable('2025-01-02 00:00:00', $tz),
        ));
    }

    #[Test]
    public function it_handles_multiple_days(): void
    {
        $tz = new \DateTimeZone('UTC');

        self::assertSame(10, DiffInFullDays::between(
            new DateTimeImmutable('2025-01-01 12:00:00', $tz),
            new DateTimeImmutable('2025-01-11 12:00:00', $tz),
        ));

        self::assertSame(365, DiffInFullDays::between(
            new DateTimeImmutable('2024-01-01 00:00:00', $tz),
            new DateTimeImmutable('2024-12-31 00:00:00', $tz),
        ));
    }

    #[Test]
    public function it_is_symmetric(): void
    {
        $tz = new \DateTimeZone('UTC');
        $a = new DateTimeImmutable('2025-01-10 10:00:00', $tz);
        $b = new DateTimeImmutable('2025-01-01 10:00:00', $tz);

        self::assertSame(9, DiffInFullDays::between($a, $b));
        self::assertSame(9, DiffInFullDays::between($b, $a));
    }
}
