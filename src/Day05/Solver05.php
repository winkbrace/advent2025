<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day05;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver05 implements Solver
{
    /** @var Range[] */
    private array $ranges = [];
    /** @var int[] */
    private array $ids = [];

    public function __construct(public readonly array $input)
    {
        foreach ($input as $line) {
            if (empty($line)) {
                continue;
            }
            if (str_contains($line, '-')) {
                [$min, $max] = explode('-', $line);
                $this->ranges[] = new Range($min, $max);
            } else {
                $this->ids[] = $line;
            }
        }
    }

    public function solveA(): string
    {
        $fresh = 0;

        foreach ($this->ids as $id) {
            if ($this->isFresh($id)) {
                $fresh++;
            }
        }

        return (string) $fresh;
    }

    public function solveB(): string
    {
        $merger = new RangeMerger();
        foreach ($this->ranges as $range) {
            $merger->merge($range);
        }

        $merged = $merger->ranges();
        usort($merged, fn (Range $a, Range $b) => $a->min <=> $b->min);
        array_walk($merged, function (Range $r) { debug((string) $r); });

        return (string) $merger->countFreshIds();
    }

    private function isFresh(string $id): bool
    {
        foreach ($this->ranges as $range) {
            if ($range->contains($id)) {
                debug("$id is in range $range");
                return true;
            }
        }

        return false;
    }
}
