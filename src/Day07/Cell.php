<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day07;

class Cell implements \Stringable
{
    public function __construct(
        public readonly int $r,
        public readonly int $c,
        public Type $type,
        public int $timelines = 0,
    ) {}

    public function addTimelines(int $count): void
    {
        $this->timelines += $count;
    }

    public function hasBeam(): bool
    {
        return $this->type === Type::Beam || $this->type === Type::Start;
    }

    public function isEmpty(): bool
    {
        return $this->type === Type::Empty;
    }

    public function hasSplitter(): bool
    {
        return $this->type === Type::Splitter;
    }

    public function __toString(): string
    {
        return $this->type->value;
    }
}
