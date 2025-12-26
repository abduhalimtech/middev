<?php

declare(strict_types=1);

$root = getcwd();
$files = [];

/* =========================
 |  ARRAYS (4 tasks)
 ========================= */

$files['src/ArrayGames/FilterValidInts.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FilterValidInts
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Valid integer values:
     *   - int
     *   - string representing integer (trim allowed), within PHP int range
     * - Return valid integers as int[] preserving original order.
     * - Ignore invalid values.
     *
     * @return int[]
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/FilterValidIntsTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FilterValidInts;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FilterValidIntsTest extends TestCase
{
    #[Test]
    public function it_filters_valid_ints_and_preserves_order(): void
    {
        self::assertSame([3, 2, -1], FilterValidInts::from([3, '2', ' -1 ', 'x']));
        self::assertSame([10, 0, 5], FilterValidInts::from(['0010', 0, '5', 5.5, true]));
        self::assertSame([], FilterValidInts::from([]));
    }

    #[Test]
    public function it_ignores_invalid_numeric_like_strings(): void
    {
        self::assertSame([1], FilterValidInts::from(['1', '1.0', '1e3', ' 1 ', '01']));
        self::assertSame([], FilterValidInts::from(['', '  ', '1.2', '-']));
        self::assertSame([-7], FilterValidInts::from(['-0007', '-7.0']));
    }

    #[Test]
    public function it_handles_extreme_values(): void
    {
        self::assertSame([PHP_INT_MIN, PHP_INT_MAX], FilterValidInts::from([PHP_INT_MIN, ' '.PHP_INT_MAX.' ']));
        self::assertSame([PHP_INT_MIN], FilterValidInts::from([' '.PHP_INT_MIN.' ', '9223372036854775808']));
        self::assertSame([PHP_INT_MAX], FilterValidInts::from(['-9223372036854775809', PHP_INT_MAX]));
    }
}

PHP;

$files['src/ArrayGames/ZipArrays.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class ZipArrays
{
    /**
     * Rules:
     * - Zip two arrays into pairs: [[a0,b0],[a1,b1],...]
     * - Stop at the shorter length.
     * - Reindex output.
     */
    public static function zip(array $a, array $b): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/ZipArraysTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\ZipArrays;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ZipArraysTest extends TestCase
{
    #[Test]
    public function it_zips_basic_arrays(): void
    {
        self::assertSame([[1,'a'], [2,'b']], ZipArrays::zip([1,2], ['a','b']));
        self::assertSame([[1,10],[2,20],[3,30]], ZipArrays::zip([1,2,3], [10,20,30]));
        self::assertSame([], ZipArrays::zip([], []));
    }

    #[Test]
    public function it_stops_at_shorter_length(): void
    {
        self::assertSame([[1,'a']], ZipArrays::zip([1,2,3], ['a']));
        self::assertSame([[1,'a'],[2,'b']], ZipArrays::zip([1,2], ['a','b','c']));
        self::assertSame([], ZipArrays::zip([], ['x']));
    }

    #[Test]
    public function it_reindexes_even_with_weird_keys(): void
    {
        $a = [10 => 'x', 20 => 'y'];
        $b = [5 => 1, 6 => 2, 7 => 3];
        self::assertSame([['x',1],['y',2]], ZipArrays::zip($a, $b));
    }
}

PHP;

$files['src/ArrayGames/FrequenciesNormalizedLower.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FrequenciesNormalizedLower
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Keep only strings.
     * - Normalize each: trim + lowercase.
     * - Ignore empty after trim.
     * - Return associative array: key => count.
     *
     * @return array<string,int>
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/FrequenciesNormalizedLowerTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FrequenciesNormalizedLower;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FrequenciesNormalizedLowerTest extends TestCase
{
    #[Test]
    public function it_counts_normalized_strings(): void
    {
        self::assertSame(['a' => 3, 'b' => 1], FrequenciesNormalizedLower::from(['A',' a ','a','B']));
        self::assertSame(['x' => 2], FrequenciesNormalizedLower::from(['x','X']));
        self::assertSame([], FrequenciesNormalizedLower::from([]));
    }

    #[Test]
    public function it_ignores_non_strings_and_empty(): void
    {
        self::assertSame(['hi' => 1], FrequenciesNormalizedLower::from(['  hi ', '', '  ', null, 1, true]));
        self::assertSame([], FrequenciesNormalizedLower::from([null, 1, [], new \stdClass()]));
        self::assertSame(['0' => 2], FrequenciesNormalizedLower::from(['0', ' 0 ']));
    }

    #[Test]
    public function it_handles_many_occurrences(): void
    {
        $in = array_merge(array_fill(0, 5, 'A'), ['b', 'B', ' b ']);
        self::assertSame(['a' => 5, 'b' => 3], FrequenciesNormalizedLower::from($in));
    }
}

PHP;

$files['src/ArrayGames/PairSumExists.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PairSumExists
{
    /**
     * Rules:
     * - Input: array of ints (assume values are ints).
     * - Return true if there exist two DISTINCT indices i != j such that nums[i] + nums[j] == $target.
     * - Must handle duplicates correctly.
     * - Empty or single-element array => false.
     */
    public static function check(array $nums, int $target): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/PairSumExistsTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PairSumExists;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PairSumExistsTest extends TestCase
{
    #[Test]
    public function it_detects_pair_sum_basic(): void
    {
        self::assertTrue(PairSumExists::check([1, 2, 3], 5)); // 2+3
        self::assertFalse(PairSumExists::check([1, 2, 3], 7));
        self::assertTrue(PairSumExists::check([-1, 4, 0], 3)); // -1+4
    }

    #[Test]
    public function it_handles_duplicates_correctly(): void
    {
        self::assertTrue(PairSumExists::check([2, 2], 4)); // must allow using both 2s
        self::assertFalse(PairSumExists::check([2], 4));
        self::assertTrue(PairSumExists::check([0, 0, 1], 0)); // 0+0
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertFalse(PairSumExists::check([], 0));
        self::assertFalse(PairSumExists::check([1], 1));
        self::assertTrue(PairSumExists::check([PHP_INT_MAX, 0], PHP_INT_MAX));
    }
}

PHP;

/* =========================
 |  STRINGS (3 tasks)
 ========================= */

$files['src/StringGames/EnsurePrefix.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class EnsurePrefix
{
    /**
     * Rules:
     * - If $s already starts with $prefix => return $s unchanged.
     * - Otherwise return $prefix . $s.
     * - If $prefix is empty => return $s.
     */
    public static function apply(string $s, string $prefix): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/EnsurePrefixTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\EnsurePrefix;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EnsurePrefixTest extends TestCase
{
    #[Test]
    public function it_adds_prefix_when_missing(): void
    {
        self::assertSame('pre-hello', EnsurePrefix::apply('hello', 'pre-'));
        self::assertSame('https://site.com', EnsurePrefix::apply('site.com', 'https://'));
        self::assertSame('x', EnsurePrefix::apply('x', ''));
    }

    #[Test]
    public function it_keeps_string_when_prefix_present(): void
    {
        self::assertSame('pre-hello', EnsurePrefix::apply('pre-hello', 'pre-'));
        self::assertSame('aaaa', EnsurePrefix::apply('aaaa', 'a'));
        self::assertSame('', EnsurePrefix::apply('', 'pre'));
    }

    #[Test]
    public function it_is_case_sensitive(): void
    {
        self::assertSame('Pre-hello', EnsurePrefix::apply('hello', 'Pre-'));
        self::assertSame('pre-hello', EnsurePrefix::apply('hello', 'pre-'));
        self::assertSame('Pre-pre', EnsurePrefix::apply('pre', 'Pre-'));
    }
}

PHP;

$files['src/StringGames/ReverseWords.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class ReverseWords
{
    /**
     * Rules:
     * - Normalize whitespace (any whitespace => single space, trim).
     * - Reverse the order of words.
     * - Return string joined by single spaces.
     * - Empty/whitespace-only => ''.
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/ReverseWordsTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ReverseWords;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReverseWordsTest extends TestCase
{
    #[Test]
    public function it_reverses_words_in_normal_sentences(): void
    {
        self::assertSame('world hello', ReverseWords::apply('hello world'));
        self::assertSame('c b a', ReverseWords::apply('a b c'));
        self::assertSame('one', ReverseWords::apply('one'));
    }

    #[Test]
    public function it_normalizes_whitespace_before_reversing(): void
    {
        self::assertSame('c b a', ReverseWords::apply("  a\tb \n c  "));
        self::assertSame('', ReverseWords::apply('   '));
        self::assertSame('b a', ReverseWords::apply("a\n\nb"));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', ReverseWords::apply(''));
        self::assertSame('x', ReverseWords::apply('x'));
        self::assertSame('z y x', ReverseWords::apply('x   y   z'));
    }
}

PHP;

$files['src/StringGames/QuoteCsvField.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class QuoteCsvField
{
    /**
     * Rules:
     * - If field contains comma, double quote, or newline => must be CSV-quoted:
     *   - wrap with double quotes
     *   - double each internal double quote
     * - Otherwise return field unchanged.
     * - Works on byte strings.
     */
    public static function apply(string $field): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/QuoteCsvFieldTest.php'] = <<<'PHP'
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

PHP;

/* =========================
 |  DATES (3 tasks)
 ========================= */

$files['src/DateGames/NextMondayIfWeekend.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NextMondayIfWeekend
{
    /**
     * Rules:
     * - If $dt is Saturday or Sunday => move forward to next Monday.
     * - Keep time.
     * - Preserve timezone.
     * - If already Mon-Fri => unchanged.
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/NextMondayIfWeekendTest.php'] = <<<'PHP'
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
    public function it_moves_saturday_and_sunday_to_next_monday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-20 10:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-18 10:00:00', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-01-20 10:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-19 10:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_keeps_weekdays_unchanged(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-20 10:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-20 10:00:00', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-01-15 09:00:00',
            NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-15 09:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = NextMondayIfWeekend::apply(new DateTimeImmutable('2025-01-18 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}

PHP;

$files['src/DateGames/DiffInFullDays.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class DiffInFullDays
{
    /**
     * Rules:
     * - Return absolute difference in FULL days between $a and $b.
     * - Time of day matters: use DateInterval->days (absolute).
     * - Example: 2025-01-01 23:00 to 2025-01-02 01:00 => 0 full days? Actually diff->days gives 0? No: it gives 0? (depends on interval)
     *   We avoid ambiguity by using DateTimeInterface::diff and taking ->days (absolute).
     */
    public static function between(DateTimeInterface $a, DateTimeInterface $b): int
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/DiffInFullDaysTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\DiffInFullDays;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DiffInFullDaysTest extends TestCase
{
    #[Test]
    public function it_returns_absolute_days_difference(): void
    {
        $tz = new \DateTimeZone('UTC');

        self::assertSame(0, DiffInFullDays::between(
            new DateTimeImmutable('2025-01-01 00:00:00', $tz),
            new DateTimeImmutable('2025-01-01 23:59:59', $tz),
        ));

        self::assertSame(1, DiffInFullDays::between(
            new DateTimeImmutable('2025-01-01 00:00:00', $tz),
            new DateTimeImmutable('2025-01-02 00:00:00', $tz),
        ));
    }

    #[Test]
    public function it_handles_multiple_days(): void
    {
        $tz = new \DateTimeZone('UTC');

        self::assertSame(10, DiffInFullDays::between(
            new DateTimeImmutable('2025-01-01 12:00:00', $tz),
            new DateTimeImmutable('2025-01-11 12:00:00', $tz),
        ));

        self::assertSame(365, DiffInFullDays::between(
            new DateTimeImmutable('2024-01-01 00:00:00', $tz),
            new DateTimeImmutable('2024-12-31 00:00:00', $tz),
        ));
    }

    #[Test]
    public function it_is_symmetric(): void
    {
        $tz = new \DateTimeZone('UTC');
        $a = new DateTimeImmutable('2025-01-10 10:00:00', $tz);
        $b = new DateTimeImmutable('2025-01-01 10:00:00', $tz);

        self::assertSame(9, DiffInFullDays::between($a, $b));
        self::assertSame(9, DiffInFullDays::between($b, $a));
    }
}

PHP;

$files['src/DateGames/SetTimeToNine.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class SetTimeToNine
{
    /**
     * Rules:
     * - Return $dt with time set to 09:00:00 in same timezone.
     * - Date stays unchanged.
     */
    public static function apply(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/SetTimeToNineTest.php'] = <<<'PHP'
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

echo "Batch 4 generated: " . count($files) . " files (" . (count($files) / 2) . " tasks).\n";
