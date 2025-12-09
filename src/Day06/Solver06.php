<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day06;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver06 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        $problems = new MathProblemsParser($this->input)->parseForA();
        $solutions = array_map(fn (MathProblem $problem) => $problem->solve(), $problems);

        return (string) array_sum($solutions);
    }

    public function solveB(): string
    {
        $problems = new MathProblemsParser($this->input)->parseForB();
        $solutions = array_map(fn (MathProblem $problem) => $problem->solve(), $problems);

        return (string) array_sum($solutions);
    }
}
