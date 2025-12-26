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

        self::assertSame('2025-01-15 00:00:00', NormalizeToDateOnly::apply($dt)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $dt = new DateTimeImmutable('2025-01-15 18:45:10', $tz);

        $out = NormalizeToDateOnly::apply($dt);
        self::assertSame('UTC', $out->getTimezone()->getName());
        self::assertSame('2025-01-15 00:00:00', $out->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_handles_already_midnight(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 00:00:00', $tz);

        self::assertSame('2025-01-15 00:00:00', NormalizeToDateOnly::apply($dt)->format('Y-m-d H:i:s'));
    }
}
