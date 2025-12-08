<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day06;

class MathProblem
{
    /** @param int[] $numbers */
    public function __construct(public array $numbers, public Operator $operator) {}

    public function solve(): int
    {
        if ($this->operator === Operator::Plus) {
            return array_sum($this->numbers);
        }

        return array_product($this->numbers);
    }
}
