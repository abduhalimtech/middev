<?php

declare(strict_types=1);

$root = getcwd();
$files = [];

/* =========================
 |  ARRAYS (4 tasks)
 ========================= */

$files['src/ArrayGames/DedupePreserveOrder.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class DedupePreserveOrder
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Keep only strings.
     * - Normalize each string: trim (keep case).
     * - Ignore empty after trim.
     * - Return unique values preserving first appearance order.
     *
     * @return string[]
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/DedupePreserveOrderTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\DedupePreserveOrder;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DedupePreserveOrderTest extends TestCase
{
    #[Test]
    public function it_dedupes_strings_preserving_order(): void
    {
        self::assertSame(['A', 'B'], DedupePreserveOrder::from(['A', 'B', 'A', 'B']));
        self::assertSame(['x', 'X'], DedupePreserveOrder::from(['x', 'X', 'x']));
        self::assertSame(['hi', 'HI'], DedupePreserveOrder::from([' hi ', 'HI', 'hi']));
    }

    #[Test]
    public function it_ignores_non_strings_and_empty(): void
    {
        self::assertSame(['a'], DedupePreserveOrder::from([' a ', '', '   ', null, 1, true, 'a']));
        self::assertSame([], DedupePreserveOrder::from([null, 1, false, [], new \stdClass()]));
        self::assertSame([], DedupePreserveOrder::from([]));
    }

    #[Test]
    public function it_handles_many_values(): void
    {
        $in = array_merge([' A '], array_fill(0, 3, 'B'), ['A', 'C', ' C ']);
        self::assertSame(['A', 'B', 'C'], DedupePreserveOrder::from($in));
    }
}

PHP;

$files['src/ArrayGames/TakeUntil.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class TakeUntil
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Return elements from start until the first element that is < 0 (negative).
     * - The negative element is NOT included.
     * - If no negatives => return original.
     */
    public static function from(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/TakeUntilTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\TakeUntil;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TakeUntilTest extends TestCase
{
    #[Test]
    public function it_takes_until_first_negative(): void
    {
        self::assertSame([1, 2], TakeUntil::from([1, 2, -1, 3]));
        self::assertSame([], TakeUntil::from([-1, 1, 2]));
        self::assertSame([0, 0, 1], TakeUntil::from([0, 0, 1, -5, 9]));
    }

    #[Test]
    public function it_returns_original_if_no_negative(): void
    {
        self::assertSame([1, 2, 3], TakeUntil::from([1, 2, 3]));
        self::assertSame([], TakeUntil::from([]));
        self::assertSame([0], TakeUntil::from([0]));
    }

    #[Test]
    public function it_handles_large_arrays_fast_enough(): void
    {
        $in = array_merge(range(1, 100), [-1], range(1, 100));
        $out = TakeUntil::from($in);
        self::assertCount(100, $out);
        self::assertSame(100, $out[99]);
    }
}

PHP;

$files['src/ArrayGames/GroupByFirstChar.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class GroupByFirstChar
{
    /**
     * Rules:
     * - Input: array of strings.
     * - Normalize each: trim.
     * - Ignore empty after trim.
     * - Group by first character LOWERCASED.
     * - Preserve order within each group.
     *
     * @return array<string, string[]>
     */
    public static function group(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/GroupByFirstCharTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\GroupByFirstChar;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GroupByFirstCharTest extends TestCase
{
    #[Test]
    public function it_groups_by_first_char_lowercased(): void
    {
        self::assertSame(
            ['a' => ['Apple', 'apricot'], 'b' => ['Banana']],
            GroupByFirstChar::group(['Apple', 'Banana', 'apricot'])
        );

        self::assertSame(
            ['x' => ['x', 'Xy'], 'y' => ['y']],
            GroupByFirstChar::group(['x', 'y', 'Xy'])
        );
    }

    #[Test]
    public function it_trims_and_ignores_empty(): void
    {
        self::assertSame(['a' => ['A']], GroupByFirstChar::group(['  ', ' A ', '']));
        self::assertSame([], GroupByFirstChar::group([]));
        self::assertSame(['h' => ['hi']], GroupByFirstChar::group(["\nhi\n"]));
    }

    #[Test]
    public function it_preserves_order_within_groups(): void
    {
        $in = ['Apple', 'Axe', 'apricot', 'Banana', 'boat'];
        $out = GroupByFirstChar::group($in);
        self::assertSame(['Apple', 'Axe', 'apricot'], $out['a']);
        self::assertSame(['Banana', 'boat'], $out['b']);
    }
}

PHP;

$files['src/ArrayGames/DropEveryNth.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

use InvalidArgumentException;

final class DropEveryNth
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Drop every N-th element (1-indexed).
     *   N=2 drops 2nd, 4th, 6th...
     * - Reindex output.
     * - If N <= 0 => throw InvalidArgumentException.
     */
    public static function apply(array $values, int $n): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/DropEveryNthTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\DropEveryNth;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DropEveryNthTest extends TestCase
{
    #[Test]
    public function it_drops_every_nth_element(): void
    {
        self::assertSame([1, 3, 5], DropEveryNth::apply([1, 2, 3, 4, 5, 6], 2));
        self::assertSame(['a', 'b', 'd', 'e'], DropEveryNth::apply(['a', 'b', 'c', 'd', 'e', 'f'], 3));
        self::assertSame([], DropEveryNth::apply([], 2));
    }

    #[Test]
    public function it_handles_n_equals_one(): void
    {
        self::assertSame([], DropEveryNth::apply([1, 2, 3], 1)); // drop all
        self::assertSame([], DropEveryNth::apply(['x'], 1));
        self::assertSame([], DropEveryNth::apply([], 1));
    }

    #[Test]
    public function it_throws_on_invalid_n(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DropEveryNth::apply([1, 2, 3], 0);
    }
}

PHP;

/* =========================
 |  STRINGS (3 tasks)
 ========================= */

$files['src/StringGames/WrapWords.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class WrapWords
{
    /**
     * Rules:
     * - Normalize spaces in input (any whitespace -> single space, trim).
     * - Wrap words into lines of max length $width.
     * - Words are separated by spaces; do not split a word.
     * - If a single word length > $width, keep it on its own line (even if exceeds).
     * - Return lines joined by "\n".
     * - width must be >= 1.
     */
    public static function wrap(string $s, int $width): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/WrapWordsTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\WrapWords;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class WrapWordsTest extends TestCase
{
    #[Test]
    public function it_wraps_words_by_width(): void
    {
        self::assertSame("a b\nc", WrapWords::wrap('a b c', 3));
        self::assertSame("hello\nworld", WrapWords::wrap('hello world', 5));
        self::assertSame("one two\nthree", WrapWords::wrap('one two three', 7));
    }

    #[Test]
    public function it_normalizes_whitespace_before_wrapping(): void
    {
        self::assertSame("a b\nc", WrapWords::wrap("  a\tb \n c  ", 3));
        self::assertSame("", WrapWords::wrap("   ", 3));
        self::assertSame("a", WrapWords::wrap("a", 1));
    }

    #[Test]
    public function it_keeps_long_word_on_its_own_line(): void
    {
        self::assertSame("toolongword", WrapWords::wrap('toolongword', 4));
        self::assertSame("a\ntoolongword\nb", WrapWords::wrap('a toolongword b', 4));
        self::assertSame("xx\nyyy", WrapWords::wrap('xx yyy', 2));
    }
}

PHP;

$files['src/StringGames/IsPalindromeNormalized.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class IsPalindromeNormalized
{
    /**
     * Rules:
     * - Consider only ASCII letters/digits.
     * - Ignore case.
     * - Return true if normalized string is a palindrome.
     * - Empty normalized string => true.
     */
    public static function check(string $s): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/IsPalindromeNormalizedTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\IsPalindromeNormalized;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsPalindromeNormalizedTest extends TestCase
{
    #[Test]
    public function it_detects_palindromes_ignoring_non_alnum_and_case(): void
    {
        self::assertTrue(IsPalindromeNormalized::check('A man, a plan, a canal: Panama'));
        self::assertTrue(IsPalindromeNormalized::check('No lemon, no melon'));
        self::assertFalse(IsPalindromeNormalized::check('hello'));
    }

    #[Test]
    public function it_handles_empty_and_symbols_only(): void
    {
        self::assertTrue(IsPalindromeNormalized::check(''));
        self::assertTrue(IsPalindromeNormalized::check('***'));
        self::assertTrue(IsPalindromeNormalized::check('  '));
    }

    #[Test]
    public function it_handles_digits_and_mixed_cases(): void
    {
        self::assertTrue(IsPalindromeNormalized::check('1a2A1'));
        self::assertFalse(IsPalindromeNormalized::check('12a'));
        self::assertTrue(IsPalindromeNormalized::check('0P0'));
    }
}

PHP;

$files['src/StringGames/CollapseRepeats.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class CollapseRepeats
{
    /**
     * Rules:
     * - Collapse consecutive repeating characters into a single character.
     * - Example: "aaabbc" => "abc"
     * - Works on byte strings (ASCII).
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/CollapseRepeatsTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\CollapseRepeats;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CollapseRepeatsTest extends TestCase
{
    #[Test]
    public function it_collapses_basic_repeats(): void
    {
        self::assertSame('abc', CollapseRepeats::apply('aaabbc'));
        self::assertSame('ab', CollapseRepeats::apply('aabb'));
        self::assertSame('a', CollapseRepeats::apply('aaaa'));
    }

    #[Test]
    public function it_handles_empty_and_single(): void
    {
        self::assertSame('', CollapseRepeats::apply(''));
        self::assertSame('x', CollapseRepeats::apply('x'));
        self::assertSame('xy', CollapseRepeats::apply('xy'));
    }

    #[Test]
    public function it_preserves_spaces_and_symbols(): void
    {
        self::assertSame('a b', CollapseRepeats::apply('a  b'));
        self::assertSame('!-', CollapseRepeats::apply('!!--'));
        self::assertSame('a-b', CollapseRepeats::apply('a--b'));
    }
}

PHP;

/* =========================
 |  DATES (3 tasks)
 ========================= */

$files['src/DateGames/ParseFlexibleDate.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;
use InvalidArgumentException;

final class ParseFlexibleDate
{
    /**
     * Rules:
     * - Accept formats:
     *   1) "YYYY-MM-DD"
     *   2) "DD.MM.YYYY"
     *   3) "YYYY/MM/DD"
     * - Reject invalid dates (e.g. 2025-02-30)
     * - Return normalized "Y-m-d"
     * - Use timezone "UTC" for parsing (output is date-only anyway).
     */
    public static function normalize(string $input): string
    {
        throw new \RuntimeException('Not implemented');
    }

    private static function parse(string $input): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/ParseFlexibleDateTest.php'] = <<<'PHP'
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

PHP;

$files['src/DateGames/AddBusinessDays.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddBusinessDays
{
    /**
     * Rules:
     * - Add $days business days to $dt.
     * - Business day = Mon-Fri and not a holiday.
     * - Holidays are date-only strings Y-m-d.
     * - $days can be negative (go backwards).
     * - Preserve time and timezone.
     */
    public static function add(DateTimeImmutable $dt, int $days, array $holidays): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/AddBusinessDaysTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\AddBusinessDays;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AddBusinessDaysTest extends TestCase
{
    #[Test]
    public function it_adds_business_days_skipping_weekends(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-17 10:00:00', $tz); // Fri

        // +1 business day => Mon
        self::assertSame('2025-01-20 10:00:00', AddBusinessDays::add($dt, 1, [])->format('Y-m-d H:i:s'));

        // +2 => Tue
        self::assertSame('2025-01-21 10:00:00', AddBusinessDays::add($dt, 2, [])->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_skips_holidays_as_non_business_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-17 10:00:00', $tz); // Fri

        // Mon is holiday => +1 should land on Tue
        self::assertSame(
            '2025-01-21 10:00:00',
            AddBusinessDays::add($dt, 1, ['2025-01-20'])->format('Y-m-d H:i:s')
        );

        // Tue is also holiday => land on Wed
        self::assertSame(
            '2025-01-22 10:00:00',
            AddBusinessDays::add($dt, 1, ['2025-01-20', '2025-01-21'])->format('Y-m-d H:i:s')
        );
    }

    #[Test]
    public function it_supports_negative_days(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-20 10:00:00', $tz); // Mon

        // -1 business day => Fri
        self::assertSame('2025-01-17 10:00:00', AddBusinessDays::add($dt, -1, [])->format('Y-m-d H:i:s'));

        // -1 with Fri as holiday => Thu
        self::assertSame(
            '2025-01-16 10:00:00',
            AddBusinessDays::add($dt, -1, ['2025-01-17'])->format('Y-m-d H:i:s')
        );
    }
}

PHP;

$files['src/DateGames/IsSameDate.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeInterface;

final class IsSameDate
{
    /**
     * Rules:
     * - Return true if $a and $b are the same calendar date in their own timezones.
     * - Compare by formatting each as 'Y-m-d' using its own timezone.
     */
    public static function check(DateTimeInterface $a, DateTimeInterface $b): bool
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/IsSameDateTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\IsSameDate;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class IsSameDateTest extends TestCase
{
    #[Test]
    public function it_returns_true_for_same_date_same_tz(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertTrue(IsSameDate::check(
            new DateTimeImmutable('2025-01-15 00:00:00', $tz),
            new DateTimeImmutable('2025-01-15 23:59:59', $tz),
        ));
    }

    #[Test]
    public function it_returns_false_for_different_dates(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertFalse(IsSameDate::check(
            new DateTimeImmutable('2025-01-15 23:59:59', $tz),
            new DateTimeImmutable('2025-01-16 00:00:00', $tz),
        ));
    }

    #[Test]
    public function it_uses_each_objects_timezone(): void
    {
        // Same instant, but different local dates
        $a = new DateTimeImmutable('2025-01-15 23:30:00', new \DateTimeZone('UTC'));
        $b = new DateTimeImmutable('2025-01-16 04:30:00', new \DateTimeZone('Asia/Tashkent')); // UTC+5

        self::assertFalse(IsSameDate::check($a, $b));
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

echo "Batch 3 generated: " . count($files) . " files (" . (count($files) / 2) . " tasks).\n";
