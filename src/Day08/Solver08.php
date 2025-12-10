<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day08;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver08 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        $mapper = new DistanceMapper($this->input);
        $mapper->buildDistanceMap();
        $mapper->connectClosest(count($this->input) === 20 ? 10 : 1000);

        $top3 = $mapper->countCircuits()
            ->sortByDesc(fn (int $count) => $count)
            ->shift(3);

        return (string) array_product($top3->all());
    }

    public function solveB(): string
    {
        return 'TBD';
    }
}
