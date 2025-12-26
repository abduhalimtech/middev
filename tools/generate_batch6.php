<?php

declare(strict_types=1);

$root = getcwd();
$files = [];

/* =========================
 |  ARRAYS (4 tasks)
 ========================= */

$files['src/ArrayGames/MapWithIndex.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class MapWithIndex
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Return array where each value becomes value + index (0-based).
     * - Preserve order, reindex output.
     *
     * Example: [10,10,10] => [10,11,12]
     */
    public static function apply(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/MapWithIndexTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\MapWithIndex;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapWithIndexTest extends TestCase
{
    #[Test]
    public function it_maps_value_plus_index(): void
    {
        self::assertSame([10, 11, 12], MapWithIndex::apply([10, 10, 10]));
        self::assertSame([1, 3, 5], MapWithIndex::apply([1, 2, 3]));
        self::assertSame([], MapWithIndex::apply([]));
    }

    #[Test]
    public function it_handles_negative_values(): void
    {
        self::assertSame([-1, 0, 1], MapWithIndex::apply([-1, -1, -1]));
        self::assertSame([-5], MapWithIndex::apply([-5]));
        self::assertSame([0, 2], MapWithIndex::apply([0, 1]));
    }

    #[Test]
    public function it_reindexes_even_with_weird_keys(): void
    {
        $in = [10 => 5, 20 => 5, 30 => 5];
        self::assertSame([5, 6, 7], MapWithIndex::apply($in));
    }
}

PHP;

$files['src/ArrayGames/FlattenDeep.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class FlattenDeep
{
    /**
     * Rules:
     * - Flatten arrays of arbitrary depth.
     * - Preserve left-to-right order.
     * - Reindex output.
     * - Non-arrays are kept as-is.
     */
    public static function apply(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/FlattenDeepTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\FlattenDeep;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FlattenDeepTest extends TestCase
{
    #[Test]
    public function it_flattens_nested_arrays(): void
    {
        self::assertSame([1, 2, 3, 4], FlattenDeep::apply([1, [2, [3]], 4]));
        self::assertSame(['a', 'b', 'c'], FlattenDeep::apply([['a'], [['b']], 'c']));
        self::assertSame([], FlattenDeep::apply([]));
    }

    #[Test]
    public function it_keeps_non_arrays_and_nulls(): void
    {
        self::assertSame([null, 1, 'x'], FlattenDeep::apply([null, [1, ['x']]]));
        self::assertSame([true, false], FlattenDeep::apply([[true], [[false]]]));
        self::assertSame([0, 0], FlattenDeep::apply([[0], 0]));
    }

    #[Test]
    public function it_preserves_order(): void
    {
        $in = [1, [2, [3, [4]]], 5, [[6]], 7];
        self::assertSame([1,2,3,4,5,6,7], FlattenDeep::apply($in));
    }
}

PHP;

$files['src/ArrayGames/PartitionByType.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class PartitionByType
{
    /**
     * Rules:
     * - Input: array of mixed values.
     * - Output: ['ints' => int[], 'strings' => string[], 'others' => array]
     * - ints: keep only int values (strict int, not numeric strings)
     * - strings: keep only string values
     * - others: everything else
     * - Preserve order in each bucket, reindex arrays.
     */
    public static function split(array $values): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/PartitionByTypeTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\PartitionByType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PartitionByTypeTest extends TestCase
{
    #[Test]
    public function it_partitions_into_three_buckets(): void
    {
        $in = [1, '1', 'a', null, 2, true, 'b'];
        $out = PartitionByType::split($in);

        self::assertSame([1, 2], $out['ints']);
        self::assertSame(['1', 'a', 'b'], $out['strings']);
        self::assertSame([null, true], $out['others']);
    }

    #[Test]
    public function it_preserves_order_and_reindexes(): void
    {
        $in = [10 => 1, 20 => 'x', 30 => 2, 40 => 'y'];
        $out = PartitionByType::split($in);

        self::assertSame([1, 2], $out['ints']);
        self::assertSame(['x', 'y'], $out['strings']);
        self::assertSame([], $out['others']);
    }

    #[Test]
    public function it_handles_empty_and_all_others(): void
    {
        self::assertSame(['ints' => [], 'strings' => [], 'others' => []], PartitionByType::split([]));

        $out = PartitionByType::split([null, false, 1.2, []]);
        self::assertSame([], $out['ints']);
        self::assertSame([], $out['strings']);
        self::assertSame([null, false, 1.2, []], $out['others']);
    }
}

PHP;

$files['src/ArrayGames/RunningSum.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\ArrayGames;

final class RunningSum
{
    /**
     * Rules:
     * - Input: array of ints.
     * - Return running sum array.
     * - Example: [1,2,3] => [1,3,6]
     * - Preserve order, reindex.
     */
    public static function from(array $nums): array
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/ArrayGames/RunningSumTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\ArrayGames;

use App\ArrayGames\RunningSum;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RunningSumTest extends TestCase
{
    #[Test]
    public function it_builds_running_sum(): void
    {
        self::assertSame([1, 3, 6], RunningSum::from([1, 2, 3]));
        self::assertSame([0, 0, 1], RunningSum::from([0, 0, 1]));
        self::assertSame([], RunningSum::from([]));
    }

    #[Test]
    public function it_handles_negative_values(): void
    {
        self::assertSame([-1, -3, -6], RunningSum::from([-1, -2, -3]));
        self::assertSame([5, 3, 3], RunningSum::from([5, -2, 0]));
        self::assertSame([10], RunningSum::from([10]));
    }

    #[Test]
    public function it_reindexes_even_with_weird_keys(): void
    {
        $in = [10 => 1, 20 => 2, 30 => 3];
        self::assertSame([1, 3, 6], RunningSum::from($in));
    }
}

PHP;

/* =========================
 |  STRINGS (3 tasks)
 ========================= */

$files['src/StringGames/RemoveDuplicateSpaces.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class RemoveDuplicateSpaces
{
    /**
     * Rules:
     * - Replace multiple consecutive spaces ' ' with a single space.
     * - Do NOT touch tabs/newlines (only the space character).
     * - Do not trim.
     */
    public static function apply(string $s): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/RemoveDuplicateSpacesTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\RemoveDuplicateSpaces;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RemoveDuplicateSpacesTest extends TestCase
{
    #[Test]
    public function it_collapses_only_spaces_not_other_whitespace(): void
    {
        self::assertSame('a b c', RemoveDuplicateSpaces::apply('a  b   c'));
        self::assertSame("a\t b", RemoveDuplicateSpaces::apply("a\t  b")); // tab stays, spaces collapse
        self::assertSame("a\n b", RemoveDuplicateSpaces::apply("a\n  b")); // newline stays, spaces collapse
    }

    #[Test]
    public function it_does_not_trim(): void
    {
        self::assertSame(' a', RemoveDuplicateSpaces::apply('  a'));
        self::assertSame('a ', RemoveDuplicateSpaces::apply('a  '));
        self::assertSame(' ', RemoveDuplicateSpaces::apply('   '));
    }

    #[Test]
    public function it_handles_edge_cases(): void
    {
        self::assertSame('', RemoveDuplicateSpaces::apply(''));
        self::assertSame('a', RemoveDuplicateSpaces::apply('a'));
        self::assertSame('a b', RemoveDuplicateSpaces::apply('a b'));
    }
}

PHP;

$files['src/StringGames/LeftPad.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

use InvalidArgumentException;

final class LeftPad
{
    /**
     * Rules:
     * - Left pad $s with $padChar until strlen($s) == $len.
     * - If strlen($s) >= $len => return $s unchanged.
     * - $padChar must be exactly 1 byte char, otherwise throw InvalidArgumentException.
     * - $len must be >= 0.
     */
    public static function apply(string $s, int $len, string $padChar): string
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/LeftPadTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\LeftPad;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LeftPadTest extends TestCase
{
    #[Test]
    public function it_pads_to_length(): void
    {
        self::assertSame('0005', LeftPad::apply('5', 4, '0'));
        self::assertSame('---a', LeftPad::apply('a', 4, '-'));
        self::assertSame('a', LeftPad::apply('a', 1, '0'));
    }

    #[Test]
    public function it_returns_original_if_already_long_enough(): void
    {
        self::assertSame('hello', LeftPad::apply('hello', 3, '0'));
        self::assertSame('', LeftPad::apply('', 0, '0'));
        self::assertSame('ab', LeftPad::apply('ab', 2, 'x'));
    }

    #[Test]
    public function it_throws_on_invalid_pad_char(): void
    {
        $this->expectException(InvalidArgumentException::class);
        LeftPad::apply('a', 3, 'xx');
    }
}

PHP;

$files['src/StringGames/ParseBoolLike.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\StringGames;

final class ParseBoolLike
{
    /**
     * Rules:
     * - Accept true values (case-insensitive, trim): "1", "true", "yes", "on"
     * - Accept false values: "0", "false", "no", "off"
     * - Anything else => null
     */
    public static function parse(string $s): ?bool
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/StringGames/ParseBoolLikeTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\StringGames;

use App\StringGames\ParseBoolLike;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParseBoolLikeTest extends TestCase
{
    #[Test]
    public function it_parses_true_values(): void
    {
        self::assertSame(true, ParseBoolLike::parse('1'));
        self::assertSame(true, ParseBoolLike::parse(' true '));
        self::assertSame(true, ParseBoolLike::parse('YES'));
    }

    #[Test]
    public function it_parses_false_values(): void
    {
        self::assertSame(false, ParseBoolLike::parse('0'));
        self::assertSame(false, ParseBoolLike::parse(' false '));
        self::assertSame(false, ParseBoolLike::parse('off'));
    }

    #[Test]
    public function it_returns_null_for_unknown(): void
    {
        self::assertNull(ParseBoolLike::parse('maybe'));
        self::assertNull(ParseBoolLike::parse(''));
        self::assertNull(ParseBoolLike::parse('2'));
    }
}

PHP;

/* =========================
 |  DATES (3 tasks)
 ========================= */

$files['src/DateGames/AddMinutesClampToDay.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class AddMinutesClampToDay
{
    /**
     * Rules:
     * - Add $minutes to $dt.
     * - If result crosses into a different calendar date (local Y-m-d),
     *   clamp to 23:59:59 of the original date.
     * - Preserve timezone.
     */
    public static function add(DateTimeImmutable $dt, int $minutes): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/AddMinutesClampToDayTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\AddMinutesClampToDay;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AddMinutesClampToDayTest extends TestCase
{
    #[Test]
    public function it_adds_minutes_within_same_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 10:00:00', $tz);

        self::assertSame('2025-01-15 10:30:00', AddMinutesClampToDay::add($dt, 30)->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 09:00:00', AddMinutesClampToDay::add($dt, -60)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_clamps_if_crossing_to_next_day(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 23:50:00', $tz);

        // +20 minutes would go to next day => clamp
        self::assertSame('2025-01-15 23:59:59', AddMinutesClampToDay::add($dt, 20)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $dt = new DateTimeImmutable('2025-01-15 23:50:00', $tz);
        $out = AddMinutesClampToDay::add($dt, 20);

        self::assertSame('UTC', $out->getTimezone()->getName());
        self::assertSame('2025-01-15 23:59:59', $out->format('Y-m-d H:i:s'));
    }
}

PHP;

$files['src/DateGames/BusinessHoursWindow.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class BusinessHoursWindow
{
    /**
     * Rules:
     * - Business hours are [09:00:00, 18:00:00) local time.
     * - If $dt is before 09:00 => return same date at 09:00.
     * - If $dt is within hours => unchanged.
     * - If $dt is >= 18:00 => return next day at 09:00.
     * - Preserve timezone.
     */
    public static function normalize(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/BusinessHoursWindowTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\BusinessHoursWindow;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class BusinessHoursWindowTest extends TestCase
{
    #[Test]
    public function it_moves_time_up_to_9_if_before_open(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        $dt = new DateTimeImmutable('2025-01-15 08:30:00', $tz);

        self::assertSame('2025-01-15 09:00:00', BusinessHoursWindow::normalize($dt)->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_keeps_time_if_within_business_hours(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame('2025-01-15 09:00:00', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-15 09:00:00', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 17:59:59', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-15 17:59:59', $tz))->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_moves_to_next_day_9_if_after_close(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');
        self::assertSame('2025-01-16 09:00:00', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-15 18:00:00', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-02-01 09:00:00', BusinessHoursWindow::normalize(new DateTimeImmutable('2025-01-31 19:00:00', $tz))->format('Y-m-d H:i:s'));
    }
}

PHP;

$files['src/DateGames/NearestPastQuarterHour.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace App\DateGames;

use DateTimeImmutable;

final class NearestPastQuarterHour
{
    /**
     * Rules:
     * - Round DOWN to nearest past 15-minute mark.
     * - Seconds must become 00.
     * - Example: 10:14:59 => 10:00:00
     *           10:15:00 => 10:15:00
     *           10:29:10 => 10:15:00
     * - Preserve date and timezone.
     */
    public static function round(DateTimeImmutable $dt): DateTimeImmutable
    {
        throw new \RuntimeException('Not implemented');
    }
}

PHP;

$files['tests/DateGames/NearestPastQuarterHourTest.php'] = <<<'PHP'
<?php

declare(strict_types=1);

namespace Tests\DateGames;

use App\DateGames\NearestPastQuarterHour;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NearestPastQuarterHourTest extends TestCase
{
    #[Test]
    public function it_rounds_down_correctly(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame('2025-01-15 10:00:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:14:59', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 10:15:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:15:00', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 10:15:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:29:10', $tz))->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_handles_hour_boundary(): void
    {
        $tz = new \DateTimeZone('Asia/Tashkent');

        self::assertSame('2025-01-15 11:45:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 11:59:59', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 12:00:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 12:00:01', $tz))->format('Y-m-d H:i:s'));
        self::assertSame('2025-01-15 12:30:00', NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 12:44:00', $tz))->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_preserves_timezone(): void
    {
        $tz = new \DateTimeZone('UTC');
        $out = NearestPastQuarterHour::round(new DateTimeImmutable('2025-01-15 10:14:59', $tz));
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

echo "Batch 6 generated: " . count($files) . " files (" . (count($files) / 2) . " tasks).\n";
