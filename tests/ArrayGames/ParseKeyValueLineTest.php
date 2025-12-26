<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\ParseKeyValueLine;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParseKeyValueLineTest extends TestCase
{
    #[Test]
    public function it_parses_basic_key_values(): void
    {
        self::assertSame(['a' => '1', 'b' => '2', 'c' => 'hello'], ParseKeyValueLine::parse('a=1; b = 2 ; c=hello'));
        self::assertSame(['sku' => 'IP-15', 'qty' => '2'], ParseKeyValueLine::parse('sku=IP-15;qty=2'));
        self::assertSame([], ParseKeyValueLine::parse(''));
    }

    #[Test]
    public function it_ignores_invalid_parts_and_empty_keys(): void
    {
        self::assertSame(['a' => '1'], ParseKeyValueLine::parse('a=1; ; noeq ; =x ;  =  ;'));
        self::assertSame([], ParseKeyValueLine::parse(';;;   ;'));
        self::assertSame(['x' => ''], ParseKeyValueLine::parse('x='));
    }

    #[Test]
    public function it_uses_last_value_when_key_repeats(): void
    {
        self::assertSame(['a' => '3'], ParseKeyValueLine::parse('a=1; a=2; a = 3'));
        self::assertSame(['tag' => 'B'], ParseKeyValueLine::parse('TAG=A; tag=B'));
        self::assertSame(['a' => '2', 'b' => '1'], ParseKeyValueLine::parse('a=1;b=1;a=2'));
    }
}
