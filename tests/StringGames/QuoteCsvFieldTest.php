<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\QuoteCsvField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class QuoteCsvFieldTest extends TestCase
{
    #[Test]
    public function it_leaves_simple_fields_unchanged(): void
    {
        self::assertSame('hello', QuoteCsvField::apply('hello'));
        self::assertSame('123', QuoteCsvField::apply('123'));
        self::assertSame('', QuoteCsvField::apply(''));
    }

    #[Test]
    public function it_quotes_fields_with_commas_or_newlines(): void
    {
        self::assertSame('"hello,world"', QuoteCsvField::apply('hello,world'));
        self::assertSame("\"line1\nline2\"", QuoteCsvField::apply("line1\nline2"));
        self::assertSame('"a,b,c"', QuoteCsvField::apply('a,b,c'));
    }

    #[Test]
    public function it_escapes_internal_quotes_when_quoting(): void
    {
        self::assertSame('"He said ""hi"""', QuoteCsvField::apply('He said "hi"'));
        self::assertSame('"a,""b"""', QuoteCsvField::apply('a,"b"'));
        self::assertSame('"x""y,z"', QuoteCsvField::apply('x"y,z'));
    }
}
