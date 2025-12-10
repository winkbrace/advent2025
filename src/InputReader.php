<?php declare(strict_types=1);

namespace Winkbrace\Advent2025;

class InputReader
{
    public static function read(string $day, string $source): array
    {
        return array_map(
            fn (string $line) => rtrim($line, "\n\r"),
            file(__DIR__ . "/Day{$day}/input/{$source}.txt"),
        );
    }
}
