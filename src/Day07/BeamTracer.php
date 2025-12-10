<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day07;

class BeamTracer
{
    /** @var array<int, array<int, Cell>> */
    private array $grid;
    private int $splitCount = 0;

    public function __construct(readonly array $input)
    {
        foreach ($input as $r => $row) {
            $this->grid[$r] = [];
            foreach (str_split($row) as $c => $char) {
                $cell = new Cell($r, $c, Type::from($char));
                $this->grid[$r][$c] = $cell;
            }
        }
    }

    public function trace(): void
    {
        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                if ($this->cellAboveHasBeam($cell)) {
                    $this->emitBeam($cell);
                }
            }
        }

        debug($this->draw());
    }

    public function draw(): string
    {
        return implode("\n", array_map(
            fn (array $row) => implode('', $row),
            $this->grid
        ));
    }

    public function splitCount(): int
    {
        return $this->splitCount;
    }

    private function cellAboveHasBeam(Cell $cell): bool
    {
        $above = $this->cellAt($cell->r - 1, $cell->c);

        return (bool) $above?->hasBeam();
    }

    private function emitBeam(?Cell $cell): void
    {
        if ($cell === null || $cell->hasBeam()) {
            return;
        }

        if ($cell->isEmpty()) {
            $cell->type = Type::Beam;
        }

        if ($cell->hasSplitter()) {
            $this->splitCount++;
            $this->emitBeam($this->cellAt($cell->r, $cell->c - 1));
            $this->emitBeam($this->cellAt($cell->r, $cell->c + 1));
        }
    }

    private function cellAt(int $r, int $c): ?Cell
    {
        return $this->grid[$r][$c] ?? null;
    }
}
