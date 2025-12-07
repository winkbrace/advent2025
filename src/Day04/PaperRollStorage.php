<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day04;

class PaperRollStorage
{
    /** @var array<int, array<int, Cell>> */
    private array $grid;

    public readonly int $cols;
    public readonly int $rows;

    /** @param string[] $input */
    public function __construct(array $input)
    {
        if (empty($input) || empty($input[0])) {
            throw new \InvalidArgumentException("Empty input when creating roll storage.");
        }

        $this->cols = count($input);
        $this->rows = strlen($input[0]);

        foreach ($input as $c => $row) {
            $this->grid[$c] = [];
            foreach (str_split($row) as $r => $char) {
                $this->grid[$c][$r] = new Cell($c, $r, $char === '@'); // roll present is true
            }
        }
    }

    /**
     * Recursively remove paper rolls until there is nothing left to get.
     */
    public function getAllPaperRolls(): int
    {
        $total = 0;
        while (($count = $this->removePaperRolls()) > 0) {
            $total += $count;
        }

        return $total;
    }

    private function removePaperRolls(): int
    {
        $count = 0;
        foreach ($this->grid as $c => $rows) {
            foreach ($rows as $r => $cell) {
                if ($this->isAccessible($cell)) {
                    $cell->occupied = false;
                    $count++;
                }
            }
        }

        return $count;
    }

    public function countAccessibleCells(): int
    {
        $count = 0;
        foreach ($this->grid as $c => $rows) {
            foreach ($rows as $r => $cell) {
                if ($this->isAccessible($cell)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function isAccessible(Cell $cell): bool
    {
        if (! $cell->occupied) {
            return false;
        }

        $occupiedNeighbours = array_filter($this->neighbours($cell), fn (Cell $c) => $c->occupied);

        return count($occupiedNeighbours) < 4;
    }

    /** @return Cell[] */
    public function neighbours(Cell $cell): array
    {
        $neighbours = [];
        for ($c = max(0, $cell->c - 1); $c <= min($this->cols - 1, $cell->c + 1); $c++) {
            for ($r = max(0, $cell->r - 1); $r <= min($this->rows - 1, $cell->r + 1); $r++) {
                if ($cell->c === $c && $cell->r === $r) {
                    continue;
                }
                $neighbours[] = $this->cellAt($c, $r);
            }
        }

        return $neighbours;
    }

    public function cellAt(int $c, int $r): Cell
    {
        return $this->grid[$c][$r];
    }

    public function toArray(): array
    {
        return $this->grid;
    }
}
