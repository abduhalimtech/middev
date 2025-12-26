<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\SetTimeToNine;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SetTimeToNineTest extends TestCase
{
    #[Test]
    public function it_sets_time_to_09_00_00(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame(
            '2025-01-15 09:00:00',
            SetTimeToNine::apply(new DateTimeImmutable('2025-01-15 20:30:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_keeps_date_unchanged(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame(
            '2025-02-28 09:00:00',
            SetTimeToNine::apply(new DateTimeImmutable('2025-02-28 00:01:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = SetTimeToNine::apply(new DateTimeImmutable('2025-01-15 20:30:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}
