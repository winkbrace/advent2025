<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day04;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver04 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        $storage = new PaperRollStorage($this->input);

        return (string) $storage->countAccessibleCells();
    }

    public function solveB(): string
    {
        return 'TBD';
    }
}
