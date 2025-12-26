<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\ParseFlexibleDate;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParseFlexibleDateTest extends TestCase
{
    #[Test]
    public function it_normalizes_supported_formats(): void
    {
        self::assertSame('2025-01-05', ParseFlexibleDate::normalize('2025-01-05'));
        self::assertSame('2025-01-05', ParseFlexibleDate::normalize('05.01.2025'));
        self::assertSame('2025-01-05', ParseFlexibleDate::normalize('2025/01/05'));
    }

    #[Test]
    public function it_rejects_invalid_dates(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ParseFlexibleDate::normalize('2025-02-30');
    }

    #[Test]
    public function it_rejects_unknown_format(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ParseFlexibleDate::normalize('01-05-2025');
    }
}
