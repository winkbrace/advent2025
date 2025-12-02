<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day01;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver01 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        $dial = new Dial(100, 50);

        $count = 0;
        foreach ($this->input as $rotation) {
            $dial->turn(trim($rotation));
            if ($dial->isZero()) $count++;
        }

        return (string) $count;
    }

    public function solveB(): string
    {
        return 'READY TO GO B';
    }
}
