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
    public function it_moves_to_next_monday_if_weekend(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        $sat = new DateTimeImmutable('2025-01-18 10:00:00', $tz);
        self::assertSame('2025-01-20 10:00:00', NextMondayIfWeekend::apply($sat)->format('Y-m-d H:i:s'));

        $mon = new DateTimeImmutable('2025-01-20 10:00:00', $tz);
        self::assertSame('2025-01-20 10:00:00', NextMondayIfWeekend::apply($mon)->format('Y-m-d H:i:s'));
    }
}
