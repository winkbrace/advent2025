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
    public static function findMax(string $bank): string
    {
        // Find highest, but not at the end of the string
        $max = max(str_split(substr($bank, 0, -1)));

        // Get substring after first occurrence of max
        $remainder = substr($bank, strpos($bank, $max) + 1);

        $remainderMax = max(str_split($remainder));
        $joltage = $max . $remainderMax;

        debug("$bank: $joltage");

        return $joltage;
    }
}
