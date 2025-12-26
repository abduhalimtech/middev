<?php

declare(strict_types=1);

$root = getcwd();
$files = [];

/* =========================
 |  ARRAYS (4 tasks)
 ========================= */

$files['src/ArrayGames/IntersectionUniqueSorted.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class IntersectionUniqueSorted
{
    /**
     * Rules:
     * - Input: two arrays of mixed values.
     * - Valid integers: int or int-string (trim allowed).
     * - Ignore invalid values.
     * - Compute intersection of valid integers (value-based).
     * - Return UNIQUE intersection values sorted ascending.
     */
    public static function from(array $a, array $b): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/IntersectionUniqueSortedTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\IntersectionUniqueSorted;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IntersectionUniqueSortedTest extends TestCase
{
    #[Test]
    public function it_intersects_and_sorts_basic_cases(): void
    {
        self::assertSame([2, 3], IntersectionUniqueSorted::from([1, 2, 3], [3, 2, 9]));
        self::assertSame([], IntersectionUniqueSorted::from([1, 2], [3, 4]));
        self::assertSame([0], IntersectionUniqueSorted::from([0, 0, 1], [0]));
    }

    #[Test]
    public function it_handles_mixed_values_and_int_strings(): void
    {
        self::assertSame([2], IntersectionUniqueSorted::from([' 2 ', 'x', 1.2, 3], [2, '2', '2.0']));
        self::assertSame([-1, 10], IntersectionUniqueSorted::from(['-1', '0010', 'x'], [-1, 10, 11]));
        self::assertSame([], IntersectionUniqueSorted::from(['1.2', null], ['1e3', true]));
    }

    #[Test]
    public function it_handles_extremes(): void
    {
        self::assertSame([PHP_INT_MIN], IntersectionUniqueSorted::from([PHP_INT_MIN, 0], [' '.PHP_INT_MIN.' ']));
        self::assertSame([PHP_INT_MAX], IntersectionUniqueSorted::from([PHP_INT_MAX], [PHP_INT_MAX, 1]));
        self::assertSame([], IntersectionUniqueSorted::from([PHP_INT_MIN], [PHP_INT_MAX]));
    }
}

PHP;

$files['src/ArrayGames/PluckUniqueNonEmptyLower.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PluckUniqueNonEmptyLower
{
    /**
     * Rules:
     * - Input: array of associative arrays.
     * - Pluck $field values.
     * - Keep only strings that are non-empty after trim.
     * - Normalize: trim + lowercase.
     * - Unique preserving order.
     *
     * @return string[]
     */
    public static function from(array $items, string $field): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/PluckUniqueNonEmptyLowerTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PluckUniqueNonEmptyLower;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PluckUniqueNonEmptyLowerTest extends TestCase
{
    #[Test]
    public function it_plucks_normalizes_and_uniques(): void
    {
        $items = [
            ['id' => 1, 'tag' => '  Apple '],
            ['id' => 2, 'tag' => 'apple'],
            ['id' => 3, 'tag' => 'BANANA'],
            ['id' => 4, 'tag' => ' banana '],
        ];

        self::assertSame(['apple', 'banana'], PluckUniqueNonEmptyLower::from($items, 'tag'));
    }

    #[Test]
    public function it_ignores_missing_non_string_and_empty(): void
    {
        $items = [
            ['id' => 1],
            ['id' => 2, 'tag' => '   '],
            ['id' => 3, 'tag' => null],
            ['id' => 4, 'tag' => 123],
            ['id' => 5, 'tag' => 'X'],
        ];

        self::assertSame(['x'], PluckUniqueNonEmptyLower::from($items, 'tag'));
        self::assertSame([], PluckUniqueNonEmptyLower::from([], 'tag'));
    }

    #[Test]
    public function it_preserves_first_occurrence_order(): void
    {
        $items = [
            ['tag' => 'B'],
            ['tag' => 'A'],
            ['tag' => 'b'],
            ['tag' => 'a'],
            ['tag' => 'C'],
        ];

        self::assertSame(['b', 'a', 'c'], PluckUniqueNonEmptyLower::from($items, 'tag'));
    }
}

PHP;

$files['src/ArrayGames/ParseKeyValueLine.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class ParseKeyValueLine
{
    /**
     * Rules:
     * - Input: string like "a=1; b = 2 ; c=hello"
     * - Split by ';'
     * - Each part may have spaces.
     * - Only keep pairs that contain '=' with non-empty key after trim.
     * - Key normalize: lowercase + trim.
     * - Value normalize: trim (keep case).
     * - If key repeats, LAST one wins.
     *
     * @return array<string, string>
     */
    public static function parse(string $line): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/ParseKeyValueLineTest.php'] = <<<'PHP'
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

PHP;

$files['src/ArrayGames/StableSortByIntField.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class StableSortByIntField
{
    /**
     * Rules:
     * - Input: array of associative arrays.
     * - Sort ascending by integer field $field.
     * - Missing/invalid int => goes LAST.
     * - Stable: items with same key keep original order.
     *
     * Valid int: int or int-string (trim allowed).
     */
    public static function sort(array $items, string $field): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/StableSortByIntFieldTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\StableSortByIntField;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StableSortByIntFieldTest extends TestCase
{
    #[Test]
    public function it_sorts_by_int_field_and_is_stable(): void
    {
        $items = [
            ['id' => 1, 'p' => 2],
            ['id' => 2, 'p' => 1],
            ['id' => 3, 'p' => 2], // same as id=1, must remain after it
            ['id' => 4, 'p' => 1], // same as id=2, must remain after it
        ];

        $out = StableSortByIntField::sort($items, 'p');
        self::assertSame([2, 4, 1, 3], array_column($out, 'id'));
    }

    #[Test]
    public function it_puts_missing_or_invalid_last(): void
    {
        $items = [
            ['id' => 1, 'p' => ' 2 '],
            ['id' => 2],
            ['id' => 3, 'p' => 'x'],
            ['id' => 4, 'p' => 1],
        ];

        $out = StableSortByIntField::sort($items, 'p');
        self::assertSame([4, 1, 2, 3], array_column($out, 'id'));
    }

    #[Test]
    public function it_handles_empty_and_single_item(): void
    {
        self::assertSame([], StableSortByIntField::sort([], 'p'));
        self::assertSame([['id' => 1, 'p' => 1]], StableSortByIntField::sort([['id' => 1, 'p' => 1]], 'p'));
        self::assertSame([['id' => 1]], StableSortByIntField::sort([['id' => 1]], 'p'));
    }
}

PHP;

/* =========================
 |  STRINGS (3 tasks)
 ========================= */

$files['src/StringGames/ExtractBetweenFirstLast.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class ExtractBetweenFirstLast
{
    /**
     * Rules:
     * - Return substring between the FIRST occurrence of $start and the LAST occurrence of $end.
     * - Start and end markers are strings (non-empty).
     * - If $start not found OR $end not found OR start position >= last end position => return ''.
     * - Markers are not included.
     */
    public static function get(string $s, string $start, string $end): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/ExtractBetweenFirstLastTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ExtractBetweenFirstLast;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ExtractBetweenFirstLastTest extends TestCase
{
    #[Test]
    public function it_extracts_between_first_start_and_last_end(): void
    {
        self::assertSame('core]yy[more', ExtractBetweenFirstLast::get('xx[core]yy[more]zz', '[', ']'));
        self::assertSame('b--c', ExtractBetweenFirstLast::get('a<b--c>d<e>f', '<', '>'));
        self::assertSame('x', ExtractBetweenFirstLast::get('((x))', '((', '))'));
    }

    #[Test]
    public function it_returns_empty_when_markers_missing_or_invalid_order(): void
    {
        self::assertSame('', ExtractBetweenFirstLast::get('no markers', '[', ']'));
        self::assertSame('', ExtractBetweenFirstLast::get('xx[start only', '[', ']'));
        self::assertSame('', ExtractBetweenFirstLast::get(']end before start[', '[', ']'));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', ExtractBetweenFirstLast::get('', '[', ']'));
        self::assertSame('', ExtractBetweenFirstLast::get('[]', '[', ']')); // empty inside
        self::assertSame('', ExtractBetweenFirstLast::get('a', '[', ']'));
    }
}

PHP;

$files['src/StringGames/CountSubstrOccurrences.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class CountSubstrOccurrences
{
    /**
     * Rules:
     * - Count occurrences of $needle in $haystack.
     * - Overlapping is NOT allowed (use next search after the end of last match).
     * - If $needle is empty => return 0.
     */
    public static function count(string $haystack, string $needle): int
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/CountSubstrOccurrencesTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\CountSubstrOccurrences;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CountSubstrOccurrencesTest extends TestCase
{
    #[Test]
    public function it_counts_non_overlapping_occurrences(): void
    {
        self::assertSame(2, CountSubstrOccurrences::count('ababab', 'ab'));
        self::assertSame(2, CountSubstrOccurrences::count('aaaa', 'aa')); // non-overlapping => 2
        self::assertSame(1, CountSubstrOccurrences::count('hello', 'll'));
    }

    #[Test]
    public function it_returns_zero_on_missing_or_empty_needle(): void
    {
        self::assertSame(0, CountSubstrOccurrences::count('hello', 'z'));
        self::assertSame(0, CountSubstrOccurrences::count('hello', ''));
        self::assertSame(0, CountSubstrOccurrences::count('', 'a'));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame(3, CountSubstrOccurrences::count('aaaaa', 'a'));
        self::assertSame(1, CountSubstrOccurrences::count('aaa', 'aaa'));
        self::assertSame(0, CountSubstrOccurrences::count('a', 'aa'));
    }
}

PHP;

$files['src/StringGames/StripNonAlnum.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class StripNonAlnum
{
    /**
     * Rules:
     * - Keep only ASCII letters and digits [A-Za-z0-9].
     * - Remove everything else (spaces, dashes, underscores, punctuation).
     * - Return resulting string (no extra trimming needed because removed).
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/StripNonAlnumTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\StripNonAlnum;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StripNonAlnumTest extends TestCase
{
    #[Test]
    public function it_strips_non_alphanumeric_chars(): void
    {
        self::assertSame('abc123', StripNonAlnum::apply('a-b_c 1!2@3'));
        self::assertSame('HelloWorld', StripNonAlnum::apply('Hello, World!'));
        self::assertSame('', StripNonAlnum::apply('***'));
    }

    #[Test]
    public function it_handles_empty_and_spaces(): void
    {
        self::assertSame('', StripNonAlnum::apply(''));
        self::assertSame('', StripNonAlnum::apply('   '));
        self::assertSame('A', StripNonAlnum::apply(' A '));
    }

    #[Test]
    public function it_keeps_digits_and_letters_only(): void
    {
        self::assertSame('AZaz09', StripNonAlnum::apply('AZaz09'));
        self::assertSame('x1', StripNonAlnum::apply('x-1'));
        self::assertSame('B2', StripNonAlnum::apply('B_2'));
    }
}

PHP;

/* =========================
 |  DATES (3 tasks)
 ========================= */

$files['src/DateGames/IsWeekend.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsWeekend
{
    /**
     * Rules:
     * - Return true if Saturday or Sunday in the given date's timezone.
     */
    public static function check(DateTimeInterface $dt): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/IsWeekendTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\IsWeekend;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsWeekendTest extends TestCase
{
    #[Test]
    public function it_detects_weekend_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-18', $tz))); // Sat
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-19', $tz))); // Sun
    }

    #[Test]
    public function it_detects_weekdays(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-20', $tz))); // Mon
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-15', $tz))); // Wed
    }

    #[Test]
    public function it_works_with_different_timezones(): void
    {
        $tz = new \DateTimeZone('UTC');
        self::assertTrue(IsWeekend::check(new DateTimeImmutable('2025-01-18 23:00:00', $tz)));
        self::assertFalse(IsWeekend::check(new DateTimeImmutable('2025-01-20 00:00:00', $tz)));
    }
}

PHP;

$files['src/DateGames/NormalizeToDateOnly.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NormalizeToDateOnly
{
    /**
     * Rules:
     * - Return same date in same timezone, but time set to 00:00:00.
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/NormalizeToDateOnlyTest.php'] = <<<'PHP'
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

PHP;

$files['src/DateGames/ShiftToBusinessDayAtNine.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class ShiftToBusinessDayAtNine
{
    /**
     * Rules:
     * - Business day = not weekend (Sat/Sun) and not holiday.
     * - Holidays are date-only strings: ['YYYY-MM-DD', ...]
     * - If input date is business day => return same date at 09:00:00
     * - Else move forward day-by-day until business day => return at 09:00:00
     * - Preserve timezone.
     */
    public static function shift(DateTimeImmutable $dt, array $holidays): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/ShiftToBusinessDayAtNineTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\ShiftToBusinessDayAtNine;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ShiftToBusinessDayAtNineTest extends TestCase
{
    #[Test]
    public function it_returns_same_date_at_nine_if_business_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 20:30:00', $tz); // Wed

        $out = ShiftToBusinessDayAtNine::shift($dt, []);
        self::assertSame('2025-01-15 09:00:00', $out->format('Y-m-d H:i:s'));
        self::assertSame('Asia/Tashkent', $out->getTimezone()->getName());
    }

    #[Test]
    public function it_skips_weekend_to_monday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz); // Sat

        $out = ShiftToBusinessDayAtNine::shift($dt, []);
        self::assertSame('2025-01-20 09:00:00', $out->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_weekend_and_holiday_chain(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        // Sat -> Mon (holiday) -> Tue
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz);

        $out = ShiftToBusinessDayAtNine::shift($dt, ['2025-01-20']);
        self::assertSame('2025-01-21 09:00:00', $out->format('Y-m-d H:i:s'));
    }
}

PHP;

/* =========================
 |  Write files
 ========================= */

$dirs = [
    'src/ArrayGames', 'src/StringGames', 'src/DateGames',
    'tests/ArrayGames', 'tests/StringGames', 'tests/DateGames',
    'tools',
];

foreach ($dirs as $d) {
    $path = $root . DIRECTORY_SEPARATOR . $d;
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

foreach ($files as $rel => $content) {
    $path = $root . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
    file_put_contents($path, $content);
}

echo "Batch 2 generated: " . count($files) . " files (" . (count($files) / 2) . " tasks).\n";
