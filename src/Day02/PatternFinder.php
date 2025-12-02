<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day02;

class PatternFinder
{
    public static function existsOfTwoRepeatedSequences(string $input): bool
    {
        if (strlen($input) % 2 === 1) {
            return false;
        }

        $half = strlen($input) / 2;
        if (substr($input, 0, $half) === substr($input, $half)) {
            debug($input . ': ' . substr($input, $half));
            return true;
        }

        return false;
    }

    public static function existsOfRepeatedSequences(string $input): bool
    {
        for ($length = 1; $length <= strlen($input) / 2; $length++) {
            $sequences = str_split($input, $length);
            if (array_all($sequences, fn($seq) => $sequences[0] === $seq)) {
                debug("{$input}: {$sequences[0]}");
                return true;
            }
        }

        return false;
    }

    /**
     * See if a numeric string contains a repeated sequence of digits.
     */
    public static function containsRepeatedDigits(string $input): bool
    {
        for ($length = 1; $length <= strlen($input) / 2; $length++) {
            for ($i=0; $i<$length; $i++) {
                $substring = substr($input, $i); // the sequence doesn't have to start at 0
                if (self::findNeighbouringSequences($substring, $length)) {
                    return true;
                }
            }
        }

        return false;
    }

    private static function findNeighbouringSequences(string $input, int $length): bool
    {
        $digits = str_split($input, $length);

        foreach ($digits as $i => $value) {
            if ($i === 0) {
                continue;
            }
            if ($digits[$i - 1] === $value) {
                debug("{$input}: {$value}\n");
                return true;
            }
        }

        return false;
    }
}
