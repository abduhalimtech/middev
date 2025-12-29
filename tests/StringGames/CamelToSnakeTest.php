<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\CamelToSnake;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CamelToSnakeTest extends TestCase
{
    #[Test]
    public function it_converts_basic_cases(): void
    {
        self::assertSame('simple', CamelToSnake::convert('simple'));
        self::assertSame('hello_world', CamelToSnake::convert('helloWorld'));
        self::assertSame('hello_world', CamelToSnake::convert('HelloWorld'));
    }

    #[Test]
    public function it_handles_consecutive_capitals_and_digits(): void
    {
        self::assertSame('my_url_value', CamelToSnake::convert('myURLValue'));
        self::assertSame('user_id2', CamelToSnake::convert('UserID2'));
        self::assertSame('ipv6_address', CamelToSnake::convert('IPv6Address'));    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', CamelToSnake::convert(''));
        self::assertSame('a', CamelToSnake::convert('A'));
        self::assertSame('already_snake', CamelToSnake::convert('already_snake'));
    }
}
