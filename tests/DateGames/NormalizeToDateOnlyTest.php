<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\NormalizeToDateOnly;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NormalizeToDateOnlyTest extends TestCase
{
    #[Test]
    public function it_sets_time_to_midnight(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 18:45:10', $tz);

        $out = NormalizeToDateOnly::apply($dt);

        self::assertSame('2025-01-15 00:00:00', $out->format('Y-m-d H:i:s'));
        self::assertSame('Asia/Tashkent', $out->getTimezone()->getName());
    }
}
