<?php

declare(strict_types=1);

$root = getcwd();

$files = [];

/* =========================
 |  ARRAYS (4 tasks)
 ========================= */

$files['src/ArrayGames/SecondSmallestUniqueInt.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class SecondSmallestUniqueInt
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Valid integers:
     *   - int
     *   - string representing integer (spaces allowed), within PHP int range
     * - Ignore everything else.
     * - Consider UNIQUE integers only.
     * - Return second smallest unique integer.
     * - If fewer than 2 unique integers => throw InvalidArgumentException.
     */
    public static function from(array $values): int
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/SecondSmallestUniqueIntTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\SecondSmallestUniqueInt;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SecondSmallestUniqueIntTest extends TestCase
{
    #[Test]
    public function it_finds_second_smallest_unique_in_common_cases(): void
    {
        self::assertSame(2, SecondSmallestUniqueInt::from([3, 1, 2]));
        self::assertSame(2, SecondSmallestUniqueInt::from([2, 2, 3, 3, 1]));
        self::assertSame(-7, SecondSmallestUniqueInt::from([-10, -5, -7]));
    }

    #[Test]
    public function it_handles_mixed_values_and_int_strings_and_extremes(): void
    {
        self::assertSame(5, SecondSmallestUniqueInt::from([10, ' -2 ', 'x', 1.2, null, [], true, '5', '-2']));
        self::assertSame(0, SecondSmallestUniqueInt::from([PHP_INT_MIN, PHP_INT_MAX, 0]));
        self::assertSame(2, SecondSmallestUniqueInt::from([' 1 ', '001', '2', ' 3 ']));
    }

    #[Test]
    public function it_throws_when_less_than_two_unique_ints_exist(): void
    {
        $this->expectException(InvalidArgumentException::class);
        SecondSmallestUniqueInt::from([2, '2', ' 2 ', 'x']);
    }
}

PHP;

$files['src/ArrayGames/RemoveFirstLast.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class RemoveFirstLast
{
    /**
     * Rules:
     * - If count <= 2: return original array unchanged.
     * - Else: remove first and last elements.
     * - Reindex output (0..n-1).
     */
    public static function apply(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/RemoveFirstLastTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\RemoveFirstLast;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveFirstLastTest extends TestCase
{
    #[Test]
    public function it_removes_first_and_last_when_possible(): void
    {
        self::assertSame([2, 3], RemoveFirstLast::apply([1, 2, 3, 4]));
        self::assertSame(['b'], RemoveFirstLast::apply(['a', 'b', 'c']));
        self::assertSame([1, 1], RemoveFirstLast::apply([9, 1, 1, 8]));
    }

    #[Test]
    public function it_returns_original_for_small_arrays(): void
    {
        self::assertSame([], RemoveFirstLast::apply([]));
        self::assertSame([1], RemoveFirstLast::apply([1]));
        self::assertSame([1, 2], RemoveFirstLast::apply([1, 2]));
    }

    #[Test]
    public function it_reindexes_output(): void
    {
        $in = [10 => 'x', 20 => 'y', 30 => 'z', 40 => 'w'];
        self::assertSame(['y', 'z'], RemoveFirstLast::apply($in));
    }
}

PHP;

$files['src/ArrayGames/NormalizeUniqueSortedSum.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class NormalizeUniqueSortedSum
{
    /**
     * Rules:
     * - Keep only valid integers (int or int-string with trim allowed).
     * - Ignore invalid values (floats, float-strings, bool, null, arrays, objects, etc).
     * - Unique the integers.
     * - Sort ascending.
     * - Return the sum of the resulting integers.
     * - If none found => return 0.
     */
    public static function from(array $values): int
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/NormalizeUniqueSortedSumTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\NormalizeUniqueSortedSum;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NormalizeUniqueSortedSumTest extends TestCase
{
    #[Test]
    public function it_normalizes_uniques_sorts_and_sums(): void
    {
        // valid ints => -1, 2, 3, 10 => sum 14
        self::assertSame(14, NormalizeUniqueSortedSum::from([3, '2', ' 2 ', -1, '0010']));
        self::assertSame(1, NormalizeUniqueSortedSum::from([1, 1, 1]));
        self::assertSame(0, NormalizeUniqueSortedSum::from([0, '0', ' 000 ']));
    }

    #[Test]
    public function it_ignores_invalid_values_and_handles_empty(): void
    {
        self::assertSame(5, NormalizeUniqueSortedSum::from(['x', '1.2', null, true, 2.5, '5']));
        self::assertSame(0, NormalizeUniqueSortedSum::from(['', '  ', [], new \stdClass()]));
        self::assertSame(0, NormalizeUniqueSortedSum::from([]));
    }

    #[Test]
    public function it_handles_extreme_ints(): void
    {
        self::assertSame(PHP_INT_MIN + PHP_INT_MAX, NormalizeUniqueSortedSum::from([PHP_INT_MAX, PHP_INT_MIN]));
        self::assertSame(PHP_INT_MIN, NormalizeUniqueSortedSum::from([PHP_INT_MIN, PHP_INT_MIN]));
    }
}

PHP;

$files['src/ArrayGames/WindowMax.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class WindowMax
{
    /**
     * Rules:
     * - Input: array of ints (assume values are ints).
     * - Return array of maximum value in each sliding window of size $k.
     * - If k <= 0 OR k > count($nums) => throw InvalidArgumentException.
     *
     * Example: nums=[1,3,-1,-3,5], k=3 => [3,3,5]
     */
    public static function compute(array $nums, int $k): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/WindowMaxTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\WindowMax;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class WindowMaxTest extends TestCase
{
    #[Test]
    public function it_computes_window_max_for_normal_cases(): void
    {
        self::assertSame([3, 3, 5], WindowMax::compute([1, 3, -1, -3, 5], 3));
        self::assertSame([2, 2, 2], WindowMax::compute([2, 2, 2, 2], 2));
        self::assertSame([10], WindowMax::compute([10], 1));
    }

    #[Test]
    public function it_handles_negative_numbers(): void
    {
        self::assertSame([-1, -1], WindowMax::compute([-1, -2, -3], 2));
        self::assertSame([-5], WindowMax::compute([-5, -10], 2));
        self::assertSame([-2, 0], WindowMax::compute([-2, 0, -1], 2));
    }

    #[Test]
    public function it_throws_on_invalid_k(): void
    {
        $this->expectException(InvalidArgumentException::class);
        WindowMax::compute([1, 2, 3], 0);
    }
}

PHP;

/* =========================
 |  STRINGS (3 tasks)
 ========================= */

$files['src/StringGames/CamelToSnake.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class CamelToSnake
{
    /**
     * Rules:
     * - Convert camelCase / PascalCase to snake_case (ASCII).
     * - Output must be lowercase.
     * - Handle consecutive capitals:
     *   "myURLValue" => "my_url_value"
     *   "UserID2"    => "user_id2"
     * - Digits remain.
     * - Empty string => empty string.
     */
    public static function convert(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/CamelToSnakeTest.php'] = <<<'PHP'
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
        self::assertSame('ip_v6_address', CamelToSnake::convert('IPv6Address'));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', CamelToSnake::convert(''));
        self::assertSame('a', CamelToSnake::convert('A'));
        self::assertSame('already_snake', CamelToSnake::convert('already_snake'));
    }
}

PHP;

$files['src/StringGames/ReplaceFirst.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class ReplaceFirst
{
    /**
     * Rules:
     * - Replace only the first occurrence of $search with $replace.
     * - If $search is empty OR not found => return original string.
     */
    public static function apply(string $s, string $search, string $replace): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/ReplaceFirstTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ReplaceFirst;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReplaceFirstTest extends TestCase
{
    #[Test]
    public function it_replaces_only_first_occurrence(): void
    {
        self::assertSame('a-x-b', ReplaceFirst::apply('a-b-b', 'b', 'x'));
        self::assertSame('heLlo', ReplaceFirst::apply('hello', 'l', 'L'));
        self::assertSame('Xabab', ReplaceFirst::apply('ababab', 'ab', 'X'));
    }

    #[Test]
    public function it_returns_original_when_search_missing_or_empty(): void
    {
        self::assertSame('abc', ReplaceFirst::apply('abc', 'z', 'x'));
        self::assertSame('abc', ReplaceFirst::apply('abc', '', 'x'));
        self::assertSame('', ReplaceFirst::apply('', 'a', 'x'));
    }

    #[Test]
    public function it_handles_overlapping_patterns(): void
    {
        self::assertSame('baa', ReplaceFirst::apply('aaaa', 'aa', 'b'));
        self::assertSame('baba', ReplaceFirst::apply('aaba', 'aa', 'b'));
        self::assertSame('a', ReplaceFirst::apply('a', 'aa', 'b'));
    }
}

PHP;

$files['src/StringGames/Truncate.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class Truncate
{
    /**
     * Rules:
     * - If strlen($s) <= $max => return $s unchanged.
     * - If $max < 3 => throw InvalidArgumentException.
     * - Otherwise return substr($s, 0, $max - 3) . '...'
     * - Special: if $max === 3 => return '...'
     */
    public static function apply(string $s, int $max): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/TruncateTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\Truncate;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TruncateTest extends TestCase
{
    #[Test]
    public function it_returns_original_if_not_longer_than_max(): void
    {
        self::assertSame('hello', Truncate::apply('hello', 5));
        self::assertSame('', Truncate::apply('', 3));
        self::assertSame('ab', Truncate::apply('ab', 3));
    }

    #[Test]
    public function it_truncates_and_adds_ellipsis(): void
    {
        self::assertSame('h...', Truncate::apply('hello', 4));
        self::assertSame('...', Truncate::apply('hello', 3));
        self::assertSame('az...', Truncate::apply('aziz', 5));
    }

    #[Test]
    public function it_throws_when_max_too_small(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Truncate::apply('hello', 2);
    }
}

PHP;

/* =========================
 |  DATES (3 tasks)
 ========================= */

$files['src/DateGames/StartOfWeekMonday.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class StartOfWeekMonday
{
    /**
     * Rules:
     * - Return the Monday of the same week as $dt (ISO week: Monday is first day).
     * - Set time to 00:00:00.
     * - Preserve timezone.
     */
    public static function from(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/StartOfWeekMondayTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\StartOfWeekMonday;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StartOfWeekMondayTest extends TestCase
{
    #[Test]
    public function it_returns_monday_for_weekdays(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-13 00:00:00',
            StartOfWeekMonday::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz))->format('Y-m-d H:i:s')
        ); // Wed -> Mon

        self::assertSame(
            '2025-01-13 00:00:00',
            StartOfWeekMonday::from(new DateTimeImmutable('2025-01-13 23:59:59', $tz))->format('Y-m-d H:i:s')
        ); // Mon -> Mon
    }

    #[Test]
    public function it_handles_sunday_correctly(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-01-13 00:00:00',
            StartOfWeekMonday::from(new DateTimeImmutable('2025-01-19 12:00:00', $tz))->format('Y-m-d H:i:s')
        ); // Sun -> previous Mon
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = StartOfWeekMonday::from(new DateTimeImmutable('2025-01-15 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}

PHP;

$files['src/DateGames/EndOfMonth.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class EndOfMonth
{
    /**
     * Rules:
     * - Return the last day of the month of $dt at 23:59:59.
     * - Preserve timezone.
     * - Must correctly handle leap years (e.g., Feb 2024 has 29 days).
     */
    public static function for(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/EndOfMonthTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\EndOfMonth;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EndOfMonthTest extends TestCase
{
    #[Test]
    public function it_returns_last_day_for_common_months(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2025-04-30 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2025-04-10 01:02:03', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-01-31 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2025-01-01 00:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_handles_leap_year_february(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame(
            '2024-02-29 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2024-02-10 10:00:00', $tz))->format('Y-m-d H:i:s')
        );

        self::assertSame(
            '2025-02-28 23:59:59',
            EndOfMonth::for(new DateTimeImmutable('2025-02-10 10:00:00', $tz))->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = EndOfMonth::for(new DateTimeImmutable('2025-02-10 10:00:00', $tz));
        self::assertSame('UTC', $out->getTimezone()->getName());
    }
}

PHP;

$files['src/DateGames/AddDaysSkippingHolidays.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddDaysSkippingHolidays
{
    /**
     * Rules:
     * - Add $days calendar days to $dt (can be 0 or positive).
     * - After adding: if resulting date is a holiday (Y-m-d in $holidays),
     *   move forward by +1 day repeatedly until not a holiday.
     * - Preserve timezone and time.
     */
    public static function add(DateTimeImmutable $dt, int $days, array $holidays): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/AddDaysSkippingHolidaysTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\AddDaysSkippingHolidays;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AddDaysSkippingHolidaysTest extends TestCase
{
    #[Test]
    public function it_adds_days_and_skips_single_holiday(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-10 12:00:00', $tz);

        // +3 => 2025-01-13, but 13 is holiday => 14
        self::assertSame(
            '2025-01-14 12:00:00',
            AddDaysSkippingHolidays::add($dt, 3, ['2025-01-13'])->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_skips_holiday_chains_and_handles_zero_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-10 12:00:00', $tz);

        // +1 => 11, but 11 and 12 are holidays => 13
        self::assertSame(
            '2025-01-13 12:00:00',
            AddDaysSkippingHolidays::add($dt, 1, ['2025-01-11', '2025-01-12'])->format('Y-m-d H:i:s')
        );

        // +0 lands on holiday => move forward
        self::assertSame(
            '2025-01-11 12:00:00',
            AddDaysSkippingHolidays::add($dt, 0, ['2025-01-10'])->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_preserves_timezone_and_time(): void
    {
        $tz = new \DateTimeZone('UTC');
        $dt = new DateTimeImmutable('2025-01-10 23:59:59', $tz);

        $out = AddDaysSkippingHolidays::add($dt, 1, []);
        self::assertSame('UTC', $out->getTimezone()->getName());
        self::assertSame('2025-01-11 23:59:59', $out->format('Y-m-d H:i:s'));
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

echo "Batch 1 generated: " . count($files) . " files (" . (count($files) / 2) . " tasks).\n";
