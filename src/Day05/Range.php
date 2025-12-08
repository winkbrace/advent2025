<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day05;

class Range
{
    public function __construct(public string $min, public string $max) {}

    /**
     * other can overlap with the min, overlap with the max, be enveloped by this (already covered), or envelop this.
     */
    public function overlaps(self $other): bool
    {
        return $this->contains($other->min) || $this->contains($other->max) || $other->contains($this->min);
    }

    public function contains(string $id): bool
    {
        return bccomp($id, $this->min) >= 0
            && bccomp($id, $this->max) <= 0;
    }

    public function __toString(): string
    {
        return $this->min . '-' . $this->max;
    }

    public function equals(Range $other): bool
    {
        return $this->min === $other->min && $this->max === $other->max;
    }
}
