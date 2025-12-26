<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\IsSameDate;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsSameDateTest extends TestCase
{
    #[Test]
    public function it_returns_true_for_same_date_same_tz(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertTrue(IsSameDate::check(
            new DateTimeImmutable('2025-01-15 00:00:00', $tz),
            new DateTimeImmutable('2025-01-15 23:59:59', $tz),
        ));
    }

    #[Test]
    public function it_returns_false_for_different_dates(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertFalse(IsSameDate::check(
            new DateTimeImmutable('2025-01-15 23:59:59', $tz),
            new DateTimeImmutable('2025-01-16 00:00:00', $tz),
        ));
    }

    #[Test]
    public function it_uses_each_objects_timezone(): void
    {
        // Same instant, but different local dates
        $a = new DateTimeImmutable('2025-01-15 23:30:00', new \DateTimeZone('UTC'));
        $b = new DateTimeImmutable('2025-01-16 04:30:00', new \DateTimeZone('Asia/Tashkent')); // UTC+5

        self::assertFalse(IsSameDate::check($a, $b));
    }
}
