<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day01;

class Dial
{
    public function __construct(private readonly int $size, private int $value) {}

    public function value(): int
    {
        return $this->value;
    }

    public function isZero(): bool
    {
        return $this->value === 0;
    }

    public function turn(string $rotation): void
    {
        $direction = $rotation[0];
        $distance = (int) substr($rotation, 1);

        // Always turn right
        if ($direction === 'L') {
            $distance = $this->size - $distance;
        }

        $this->value = ($this->value + $distance) % $this->size;
    }
}
