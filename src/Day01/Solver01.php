<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Solvers;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver01 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(string $part): string
    {
        return 'READY TO GO A';
    }

    public function solveB(string $part): string
    {
        return 'READY TO GO B';
    }
}
