<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day06;

class MathProblem
{
    /** @param int[] $numbers */
    public function __construct(public array $numbers, public Operator $operator) {}

    public function solve(): string
    {
        if ($this->operator === Operator::Plus) {
            return array_reduce($this->numbers, function (string $carry, string $nr) {
                return bcadd($carry, $nr);
            }, '0');
        }

        return array_reduce($this->numbers, function (string $carry, string $nr) {
            return bcmul($carry, $nr);
        }, '1');
    }
}
