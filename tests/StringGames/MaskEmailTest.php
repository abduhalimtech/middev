<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\MaskEmail;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MaskEmailTest extends TestCase
{
    #[Test]
    public function it_masks_local_part_correctly(): void
    {
        self::assertSame('a@site.com', MaskEmail::mask('a@site.com'));
        self::assertSame('a*@site.com', MaskEmail::mask('ab@site.com'));
        self::assertSame('a*c@site.com', MaskEmail::mask('abc@site.com'));
    }

    #[Test]
    public function it_preserves_domain_and_masks_long_locals(): void
    {
        self::assertSame('a***********v@site.com', MaskEmail::mask('aziz.turgunov@site.com'));
        self::assertSame('j******e@company.co.uk', MaskEmail::mask('john_doe@company.co.uk'));
    }

    #[Test]
    public function it_throws_on_invalid_email_shape(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MaskEmail::mask('no-at-sign');

        // also invalid: empty local or empty domain or multiple @
        // (keep these asserts in same test to mirror interview style)
        try { MaskEmail::mask('@site.com'); $this->fail('expected'); } catch (InvalidArgumentException) {}
        try { MaskEmail::mask('a@'); $this->fail('expected'); } catch (InvalidArgumentException) {}
        try { MaskEmail::mask('a@@b.com'); $this->fail('expected'); } catch (InvalidArgumentException) {}
    }
}
