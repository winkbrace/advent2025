<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day03;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver03 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        $sum = 0;
        foreach ($this->input as $bank) {
            $sum += (int) JoltageFinder::findMax($bank);
        }

        return (string) $sum;
    }

    public function solveB(): string
    {
        return 'TBD';
    }
}
