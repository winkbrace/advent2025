<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day06;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver06 implements Solver
{
    /** @var MathProblem[] */
    private array $problems;

    public function __construct(public readonly array $input)
    {
        $this->problems = new MathProblemsParser($input)->parse();
    }

    public function solveA(): string
    {
        $solutions = array_map(fn (MathProblem $problem) => $problem->solve(), $this->problems);

        return (string) array_sum($solutions);
    }

    public function solveB(): string
    {
        return 'TBD';
    }
}
