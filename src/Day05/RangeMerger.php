<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day05;

class RangeMerger
{
    /** @var Range[] */
    private array $ranges = [];

    /**
     * Merge a new range recursively in all previously merged ranges.
     */
    public function merge(Range $new): void
    {
        while ($this->doMerge($new)) {
            $this->ranges = array_values($this->ranges);
        }

        $this->ranges = array_unique($this->ranges);
    }

    private function doMerge(Range $new): bool
    {
        foreach ($this->ranges as $i => $range) {
            $before = (string) $new;
            if ($new->overlaps($range) && ! $new->equals($range)) {
                $new = $this->setMinAndMax($new, $range);
                debug("$before & $range = $new");
                unset($this->ranges[$i]);

                return true;
            }
        }

        // No overlapping ranges found, so add to the list
        $this->ranges[] = $new;
        debug("$new added");
        return false;
    }

    public function countFreshIds(): int
    {
        $count = 0;
        foreach ($this->ranges as $range) {
            $count += (int) bcsub($range->max, $range->min) + 1; // add one because ranges are inclusive
        }
        return $count;
    }

    /** @return Range[] */
    public function ranges(): array
    {
        return $this->ranges;
    }

    private function setMinAndMax(Range $range, Range $other): Range
    {
        $range->min = bccomp($other->min, $range->min) <= 0 ? $other->min : $range->min;
        $range->max = bccomp($other->max, $range->max) >= 0 ? $other->max : $range->max;

        return $range;
    }
}
