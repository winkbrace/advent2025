<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day02;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver02 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        return $this->loopThroughInputWith(fn (string $nr): bool => PatternFinder::existsOfTwoRepeatedSequences($nr));
    }

    public function solveB(): string
    {
        return $this->loopThroughInputWith(fn (string $nr): bool => PatternFinder::existsOfRepeatedSequences($nr));
    }

    private function loopThroughInputWith(\Closure $closure): string
    {
        $invalidIds = [];

        $ranges = explode(',', $this->input[0]);
        foreach ($ranges as $range) {
            debug("\n" . $range);
            [$from, $to] = array_map('intval', explode('-', $range));
            for ($nr = $from; $nr <= $to; $nr++) {
                if ($closure((string) $nr)) {
                    $invalidIds[] = $nr;
                }
            }
        }

        return (string) array_sum($invalidIds);
    }
}
