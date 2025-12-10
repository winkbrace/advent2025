<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day07;

class QuantumTracer
{
    /** @var array<int, array<int, Cell>> */
    private array $grid;
    /** @var array<int, Cell> */
    private array $timelines = [];

    public function __construct(readonly array $input)
    {
        foreach ($input as $r => $row) {
            $this->grid[$r] = [];
            foreach (str_split($row) as $c => $char) {
                $cell = new Cell($r, $c, Type::from($char));
                $this->grid[$r][$c] = $cell;
            }
        }

        $start = $this->findBeamStart();
        $start->timelines = 1;
    }

    /**
     * Tracing all paths recursively is not optimal for such a big number of possibilities.
     * Instead, we want to track the number of possibilities to get at each position per line.
     */
    public function trace(): void
    {
        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                $above = $this->cellAt($cell->r - 1, $cell->c);
                if ($above?->timelines > 0) {
                    $this->addCounts($cell, $above);
                }
            }
        }
    }

    private function addCounts(Cell $cell, Cell $above): void
    {
        $timelines = $above->timelines;
        if ($cell->hasSplitter()) {
            $this->cellAt($cell->r, $cell->c - 1)?->addTimelines($timelines);
            $this->cellAt($cell->r, $cell->c + 1)?->addTimelines($timelines);
        } else {
            $cell->addTimelines($timelines);
        }
    }

    public function drawTimelineCounts(): string
    {
        $size = strlen((string) $this->sumTimelineCounts());

        return collect($this->grid)
            ->map(function (array $row) use ($size) {
                return collect($row)
                        ->map(fn (Cell $cell) => str_pad((string) $cell->timelines, $size, ' ', STR_PAD_LEFT))
                        ->implode(' ');
            })
            ->implode("\n");
    }

    public function sumTimelineCounts(): int
    {
        $r = count($this->grid) - 1;

        return collect($this->grid[$r])
            ->sum(fn (Cell $cell) => $cell->timelines);
    }

    /**
     * Use this to collect all the paths for drawing.
     * Can only be used with a small sample size.
     */
    public function traceForSmallSampleDrawing(?Cell $cell = null, array $timeline = []): void
    {
        $cell ??= $this->findBeamStart();
        $timeline[] = $cell;

        if ($cell->r === count($this->grid) - 1) {
            $this->timelines[] = $timeline;
            return;
        }

        foreach ($this->findNext($cell) as $next) {
            $this->traceForSmallSampleDrawing($next, $timeline);
        }
    }

    public function drawAll(): string
    {
        $output = '';

        $drawings = [];
        foreach (array_keys($this->timelines) as $i) {
            $drawings[] = $this->draw($i);
        }

        $cols = 8;
        $rows = (int) ceil(count($this->timelines) / $cols);
        for ($r = 0; $r < $rows; $r++) {
            $lines = [];
            for ($c = 0; $c < $cols; $c++) {
                $i = (8 * $r) + $c;
                if (empty($drawings[$i])) {
                    break;
                }
                foreach (explode("\n", $drawings[$i]) as $i => $line) {
                    $lines[$i][$c] = $line;
                }
            }
            foreach ($lines as $parts) {
                $output .= implode('  ', $parts) . "\n";
            }
            $output .= "\n\n";
        }

        return $output;
    }

    public function draw(int $i): string
    {
        // set the timeline
        foreach ($this->timelines[$i] as $cell) {
            if ($cell->type !== Type::Start) {
                $cell->type = Type::Beam;
            }
        }

        $output = implode("\n", array_map(
            fn (array $row) => implode('', $row),
            $this->grid
        ));

        // reset
        foreach ($this->timelines[$i] as $cell) {
            if ($cell->type !== Type::Start) {
                $cell->type = Type::Empty;
            }
        }

        return $output;
    }

    public function timelines(): array
    {
        return $this->timelines;
    }

    /** @return Cell[] */
    private function findNext(Cell $cell): array
    {
        $below = $this->cellAt($cell->r + 1, $cell->c);
        if ($below === null) {
            throw new \RuntimeException("We should not look for next cell on the final row");
        }
        if ($below->hasSplitter()) {
            return [
                $this->cellAt($cell->r + 1, $cell->c - 1),
                $this->cellAt($cell->r + 1, $cell->c + 1),
            ];
        }
        return [$below];
    }

    private function findBeamStart(): Cell
    {
        foreach ($this->grid[0] as $cell) {
            if ($cell->type === Type::Start) {
                return $cell;
            }
        }

        throw new \RunTimeException("There should be an S on the first line");
    }

    private function cellAt(int $r, int $c): ?Cell
    {
        return $this->grid[$r][$c] ?? null;
    }
}
