<?php

declare(strict_types=1);

$root = getcwd();
$files = [];

/* =========================
 |  ARRAYS (4 tasks)
 ========================= */

$files['src/ArrayGames/CompactNulls.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class CompactNulls
{
    /**
     * Rules:
     * - Remove ONLY null values from the array.
     * - Keep false, 0, '', and other values.
     * - Preserve order and reindex.
     */
    public static function apply(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/CompactNullsTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\CompactNulls;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CompactNullsTest extends TestCase
{
    #[Test]
    public function it_removes_only_nulls(): void
    {
        self::assertSame([1, 2], CompactNulls::apply([1, null, 2]));
        self::assertSame([false, 0, '', '0'], CompactNulls::apply([null, false, 0, '', '0', null]));
        self::assertSame([], CompactNulls::apply([null, null]));
    }

    #[Test]
    public function it_preserves_order_and_reindexes(): void
    {
        $in = [10 => 1, 20 => null, 30 => 2, 40 => null, 50 => 3];
        self::assertSame([1, 2, 3], CompactNulls::apply($in));
    }

    #[Test]
    public function it_handles_empty_input(): void
    {
        self::assertSame([], CompactNulls::apply([]));
        self::assertSame([0], CompactNulls::apply([0]));
        self::assertSame([''], CompactNulls::apply(['']));
    }
}

PHP;

$files['src/ArrayGames/FirstDuplicateValue.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class FirstDuplicateValue
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Return the first value that appears twice (second occurrence decides).
     * - Compare by strict equality (===).
     * - If no duplicates => throw InvalidArgumentException.
     *
     * Example: [1,2,3,2,1] => 2 (because 2 is first to have a second occurrence)
     */
    public static function find(array $values): mixed
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/FirstDuplicateValueTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FirstDuplicateValue;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FirstDuplicateValueTest extends TestCase
{
    #[Test]
    public function it_returns_first_value_that_repeats(): void
    {
        self::assertSame(2, FirstDuplicateValue::find([1, 2, 3, 2, 1]));
        self::assertSame('a', FirstDuplicateValue::find(['a', 'b', 'a']));
        self::assertSame(0, FirstDuplicateValue::find([0, 1, 0, 1])); // 0 repeats first
    }

    #[Test]
    public function it_uses_strict_equality(): void
    {
        // '1' !== 1, so duplicate is 1 when second 1 appears
        self::assertSame(1, FirstDuplicateValue::find(['1', 1, 2, 1]));
        self::assertSame('1', FirstDuplicateValue::find(['1', 1, '1']));
    }

    #[Test]
    public function it_throws_when_no_duplicates(): void
    {
        $this->expectException(InvalidArgumentException::class);
        FirstDuplicateValue::find([1, 2, 3]);
    }
}

PHP;

$files['src/ArrayGames/SplitByPredicate.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class SplitByPredicate
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Output: [ $trues, $falses ]
     * - Put values where predicate is true into $trues, others into $falses.
     * - Predicate: "is even" (value % 2 === 0)
     * - Preserve order.
     *
     * @return array{0:int[],1:int[]}
     */
    public static function split(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/SplitByPredicateTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\SplitByPredicate;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SplitByPredicateTest extends TestCase
{
    #[Test]
    public function it_splits_evens_and_odds_preserving_order(): void
    {
        self::assertSame([[2, 4], [1, 3]], SplitByPredicate::split([1, 2, 3, 4]));
        self::assertSame([[0, -2], [-1, 3]], SplitByPredicate::split([0, -1, -2, 3]));
        self::assertSame([[], []], SplitByPredicate::split([]));
    }

    #[Test]
    public function it_handles_all_even_or_all_odd(): void
    {
        self::assertSame([[2, 6], []], SplitByPredicate::split([2, 6]));
        self::assertSame([[], [1, 5]], SplitByPredicate::split([1, 5]));
        self::assertSame([[0], []], SplitByPredicate::split([0]));
    }

    #[Test]
    public function it_keeps_duplicates(): void
    {
        self::assertSame([[2, 2], [1, 1]], SplitByPredicate::split([2, 1, 2, 1]));
        self::assertSame([[4, 4, 4], []], SplitByPredicate::split([4, 4, 4]));
        self::assertSame([[], [3, 3]], SplitByPredicate::split([3, 3]));
    }
}

PHP;

$files['src/ArrayGames/RotateRight.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class RotateRight
{
    /**
     * Rules:
     * - Rotate array RIGHT by $k positions.
     * - If $k can be larger than count($values).
     * - Empty array => [].
     * - Reindex output.
     *
     * Example: [1,2,3,4], k=1 => [4,1,2,3]
     */
    public static function apply(array $values, int $k): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/RotateRightTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\RotateRight;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RotateRightTest extends TestCase
{
    #[Test]
    public function it_rotates_right_basic_cases(): void
    {
        self::assertSame([4, 1, 2, 3], RotateRight::apply([1, 2, 3, 4], 1));
        self::assertSame([3, 4, 1, 2], RotateRight::apply([1, 2, 3, 4], 2));
        self::assertSame([1, 2, 3], RotateRight::apply([1, 2, 3], 0));
    }

    #[Test]
    public function it_handles_k_larger_than_length(): void
    {
        self::assertSame([3, 1, 2], RotateRight::apply([1, 2, 3], 4)); // 4 % 3 = 1
        self::assertSame([2, 3, 1], RotateRight::apply([1, 2, 3], 5)); // 5 % 3 = 2
        self::assertSame([], RotateRight::apply([], 10));
    }

    #[Test]
    public function it_reindexes_output(): void
    {
        $in = [10 => 'a', 20 => 'b', 30 => 'c'];
        self::assertSame(['c', 'a', 'b'], RotateRight::apply($in, 1));
    }
}

PHP;

/* =========================
 |  STRINGS (3 tasks)
 ========================= */

$files['src/StringGames/StripPrefix.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class StripPrefix
{
    /**
     * Rules:
     * - If $s starts with $prefix => remove it.
     * - Otherwise return $s unchanged.
     * - If $prefix is empty => return $s.
     */
    public static function apply(string $s, string $prefix): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/StripPrefixTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\StripPrefix;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StripPrefixTest extends TestCase
{
    #[Test]
    public function it_strips_prefix_when_present(): void
    {
        self::assertSame('hello', StripPrefix::apply('pre-hello', 'pre-'));
        self::assertSame('site.com', StripPrefix::apply('https://site.com', 'https://'));
        self::assertSame('', StripPrefix::apply('pre', 'pre'));
    }

    #[Test]
    public function it_returns_original_when_missing_or_empty_prefix(): void
    {
        self::assertSame('hello', StripPrefix::apply('hello', 'pre-'));
        self::assertSame('hello', StripPrefix::apply('hello', ''));
        self::assertSame('', StripPrefix::apply('', 'pre-'));
    }

    #[Test]
    public function it_is_case_sensitive(): void
    {
        self::assertSame('Pre-hello', StripPrefix::apply('Pre-hello', 'pre-'));
        self::assertSame('hello', StripPrefix::apply('pre-hello', 'pre-'));
        self::assertSame('pre-hello', StripPrefix::apply('pre-hello', 'Pre-'));
    }
}

PHP;

$files['src/StringGames/RemoveOuterQuotes.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class RemoveOuterQuotes
{
    /**
     * Rules:
     * - If string starts and ends with the same quote char (single ' or double "),
     *   remove ONLY the outer pair.
     * - Otherwise return original.
     * - Works on byte strings.
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/RemoveOuterQuotesTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RemoveOuterQuotes;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveOuterQuotesTest extends TestCase
{
    #[Test]
    public function it_removes_outer_matching_quotes(): void
    {
        self::assertSame('hello', RemoveOuterQuotes::apply('"hello"'));
        self::assertSame('hello', RemoveOuterQuotes::apply("'hello'"));
        self::assertSame('', RemoveOuterQuotes::apply('""'));
    }

    #[Test]
    public function it_keeps_when_not_matching_or_not_both_sides(): void
    {
        self::assertSame('"hello\'', RemoveOuterQuotes::apply('"hello\''));
        self::assertSame('hello"', RemoveOuterQuotes::apply('hello"'));
        self::assertSame("'hello\"", RemoveOuterQuotes::apply("'hello\""));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', RemoveOuterQuotes::apply(''));
        self::assertSame('a', RemoveOuterQuotes::apply('a'));
        self::assertSame('""x""', RemoveOuterQuotes::apply('""x""')); // outer quotes are " and ", inside remains
    }
}

PHP;

$files['src/StringGames/RepeatString.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class RepeatString
{
    /**
     * Rules:
     * - Repeat $s exactly $times times.
     * - If $times < 0 => throw InvalidArgumentException.
     * - If $times === 0 => return ''.
     */
    public static function make(string $s, int $times): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/RepeatStringTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RepeatString;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RepeatStringTest extends TestCase
{
    #[Test]
    public function it_repeats_strings_correctly(): void
    {
        self::assertSame('aaa', RepeatString::make('a', 3));
        self::assertSame('abab', RepeatString::make('ab', 2));
        self::assertSame('', RepeatString::make('x', 0));
    }

    #[Test]
    public function it_handles_empty_string_input(): void
    {
        self::assertSame('', RepeatString::make('', 3));
        self::assertSame('', RepeatString::make('', 0));
        self::assertSame('   ', RepeatString::make(' ', 3));
    }

    #[Test]
    public function it_throws_on_negative_times(): void
    {
        $this->expectException(InvalidArgumentException::class);
        RepeatString::make('a', -1);
    }
}

PHP;

/* =========================
 |  DATES (3 tasks)
 ========================= */

$files['src/DateGames/IsHoliday.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsHoliday
{
    /**
     * Rules:
     * - Holidays: array of date-only strings ['Y-m-d', ...]
     * - Return true if $dt's local date (Y-m-d in its timezone) is in holidays.
     */
    public static function check(DateTimeInterface $dt, array $holidays): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/IsHolidayTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\IsHoliday;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsHolidayTest extends TestCase
{
    #[Test]
    public function it_detects_holidays_by_local_date(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $holidays = ['2025-01-01', '2025-03-08'];

        self::assertTrue(IsHoliday::check(new DateTimeImmutable('2025-01-01 10:00:00', $tz), $holidays));
        self::assertTrue(IsHoliday::check(new DateTimeImmutable('2025-03-08 00:00:00', $tz), $holidays));
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-01-02 10:00:00', $tz), $holidays));
    }

    #[Test]
    public function it_handles_empty_holidays(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-01-01', $tz), []));
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-03-08', $tz), []));
        self::assertFalse(IsHoliday::check(new DateTimeImmutable('2025-12-31', $tz), []));
    }

    #[Test]
    public function it_uses_timezone_for_date_comparison(): void
    {
        // UTC time late night may be next day in Asia/Tashkent
        $holidays = ['2025-01-02'];

        $utc = new DateTimeImmutable('2025-01-01 22:30:00', new \DateTimeZone('UTC'));
        $tash = $utc->setTimezone(new \DateTimeZone('Asia/Tashkent')); // +5 => 2025-01-02

        self::assertFalse(IsHoliday::check($utc, $holidays));
        self::assertTrue(IsHoliday::check($tash, $holidays));
    }
}

PHP;

$files['src/DateGames/NextDay.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NextDay
{
    /**
     * Rules:
     * - Return $dt moved by +1 day (same time).
     * - Preserve timezone.
     */
    public static function from(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/NextDayTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\NextDay;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NextDayTest extends TestCase
{
    #[Test]
    public function it_adds_one_day_preserving_time(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame(
            '2025-01-16 10:00:00',
            NextDay::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_handles_month_rollover(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame(
            '2025-02-01 23:59:59',
            NextDay::from(new DateTimeImmutable('2025-01-31 23:59:59', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = NextDay::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}

PHP;

$files['src/DateGames/ShiftToNextBusinessDay.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class ShiftToNextBusinessDay
{
    /**
     * Rules:
     * - Business day = Mon-Fri and not holiday.
     * - Holidays are Y-m-d strings.
     * - If $dt is already business day => return unchanged (keep time).
     * - Else move forward day-by-day until business day.
     * - Preserve timezone.
     */
    public static function shift(DateTimeImmutable $dt, array $holidays): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/ShiftToNextBusinessDayTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\ShiftToNextBusinessDay;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ShiftToNextBusinessDayTest extends TestCase
{
    #[Test]
    public function it_returns_same_date_if_business_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 10:00:00', $tz); // Wed

        self::assertSame('2025-01-15 10:00:00', ShiftToNextBusinessDay::shift($dt, [])->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_weekend_to_monday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz); // Sat

        self::assertSame('2025-01-20 10:00:00', ShiftToNextBusinessDay::shift($dt, [])->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_weekend_and_holidays_chain(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-18 10:00:00', $tz); // Sat

        // Mon+Tue holidays => Wed
        self::assertSame(
            '2025-01-22 10:00:00',
            ShiftToNextBusinessDay::shift($dt, ['2025-01-20', '2025-01-21'])->format('Y-m-d H:i:s')
        );
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

echo "Batch 5 generated: " . count($files) . " files (" . (count($files) / 2) . " tasks).\n";
