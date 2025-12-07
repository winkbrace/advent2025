<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day04;

class Cell
{
    public function __construct(
        public readonly int $c,
        public readonly int $r,
        public bool $occupied,
    ) {}

    public function __toString(): string
    {
        return "({$this->c},{$this->c}): " . ($this->occupied ? '@' : '.') . PHP_EOL;
    }
}
