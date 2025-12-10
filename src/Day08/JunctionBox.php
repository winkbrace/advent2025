<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day08;

class JunctionBox implements \Stringable
{
    public static function fromString(string $str, int $circuit): self
    {
        [$x, $y, $z] = explode(',', $str);
        return new self($x, $y, $z, $circuit);
    }

    public function __construct(
        public readonly string $x,
        public readonly string $y,
        public readonly string $z,
        public int $circuit,
    ) {}

    public function __toString(): string
    {
        return "{$this->x},{$this->y},{$this->z} on #{$this->circuit}";
    }
}
