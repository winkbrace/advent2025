<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day08;

use BcMath\Number;

class JunctionBoxDistance implements \Stringable
{
    public function __construct(
        public readonly JunctionBox $a,
        public readonly JunctionBox $b,
        public readonly Number $distance,
    ) {}

    public function __toString(): string
    {
        return "$this->a to $this->b = $this->distance";
    }
}
