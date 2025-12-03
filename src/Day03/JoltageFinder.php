<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day03;

/**
 * Find the max "joltage" from the digits in a "bank".
 */
class JoltageFinder
{
    /**
     * Find the highest 2-digit number, using the digits in the bank in the given order.
     */
    public static function findMax(string $bank, int $length): string
    {
        $remainder = $bank;
        $joltage = '';
        for ($i=$length; $i>0; $i--) {
            [$max, $remainder] = self::findNextMax($remainder, $i);
            $joltage .= $max;

            if (strlen($remainder) === $i-1) {
                $joltage .= $remainder;
                break;
            }
        }

        debug("$bank: $joltage");

        return $joltage;
    }

    /** @return string[] */
    private static function findNextMax(string $remainder, int $length): array
    {
        $search = $length === 1
            ? $remainder // Last digit can use the entire string
            : substr($remainder, 0, 1-$length); // Keep length digits in the string, minus one for the current digit
        $max = max(str_split($search));
        $newRemainder = substr($remainder, strpos($remainder, $max) + 1);

        return [$max, $newRemainder];
    }
}
