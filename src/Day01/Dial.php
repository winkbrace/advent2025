<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day01;

class Dial
{
    private int $zeroesPassed = 0;

    public function __construct(private readonly int $size, private int $value) {}

    public function value(): int
    {
        return $this->value;
    }

    public function zeroesPassed(): int
    {
        return $this->zeroesPassed;
    }

    public function isZero(): bool
    {
        return $this->value === 0;
    }

    public function turn(string $rotation): void
    {
        $startedAtZero = $this->isZero();

        $direction = $rotation[0];
        $distance = (int) substr($rotation, 1);

        // count the full rotations
        $this->zeroesPassed = (int) floor($distance / $this->size);

        // keep only the remainder
        $distance %= $this->size;

        if ($direction === 'L') {
            $this->value -= $distance;
        } else {
            $this->value += $distance;
        }

        // count if we passed zero again
        if ($this->value === 0
            || (! $startedAtZero && $this->value <= 0)
            || $this->value >= $this->size)
        {
            $this->zeroesPassed++;
        }

        // correct the value for the rotation
        if ($this->value < 0) {
            $this->value += $this->size;
        } elseif ($this->value >= $this->size) {
            $this->value -= $this->size;
        }

        if (defined('DEBUG')) {
            echo "{$rotation}: zeroes:{$this->zeroesPassed} value:{$this->value}\n";
        }
    }
}
