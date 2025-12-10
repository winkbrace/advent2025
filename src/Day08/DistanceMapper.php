<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day08;

use BcMath\Number;
use Illuminate\Support\Collection;

class DistanceMapper
{
    /** @var JunctionBoxDistance[] */
    private array $distanceMap = [];
    /** @var JunctionBox[] */
    public array $boxes = [];

    /** @param string[] $input */
    public function __construct(array $input)
    {
        // sort the input by coordinates, so $a will always be smaller than $b in the distance map
        usort($input, fn(string $a, string $b) => explode(',', $a) <=> explode(',', $b));

        foreach ($input as $i => $str) {
            $this->boxes[] = JunctionBox::fromString($str, $i);
        }
    }

    public function connectClosest(int $amount): void
    {
        foreach ($this->distanceMap as $i => $dist) {
            // stop after $amount connection attempts (not the same as cables!)
            if ($i >= $amount) {
                break;
            }

            // if the boxes are already in the same network, we skip connecting them
            if ($dist->a->circuit === $dist->b->circuit) {
                debug("skipped $dist");
                continue;
            }

            // We always use the lowest number as the new circuit id.
            $new = min($dist->a->circuit, $dist->b->circuit);
            $old = max($dist->a->circuit, $dist->b->circuit);
            debug("connecting $dist: #$old to #$new");

            // Update all boxes on the old circuit to the new one
            foreach ($this->boxes as $box) {
                if ($box->circuit === $old) {
                    $box->circuit = $new;
                }
            }
        }
    }

    /** @return Collection<int $circuit, int $count> */
    public function countCircuits(): Collection
    {
        return collect($this->boxes)->countBy('circuit');
    }

    /** @return JunctionBoxDistance[] */
    public function buildDistanceMap(): array
    {
        $size = count($this->boxes);

        foreach ($this->boxes as $i => $a) {
            // For calculating distance between two points, we don't have to process them both ways.
            for ($j = $i+1; $j<$size; $j++) {
                $b = $this->boxes[$j];
                $this->distanceMap[] = new JunctionBoxDistance($a, $b, $this->calculateDistance($a, $b));
            }
        }

        usort($this->distanceMap, fn($a, $b) => $a->distance <=> $b->distance);

        return $this->distanceMap;
    }

    /**
     * Eucledian distance formula: d = √(Δx²+Δy²+Δz²)
     */
    public function calculateDistance(JunctionBox $a, JunctionBox $b): Number
    {
        return new Number(bcpow(bcsub($b->x, $a->x), '2'))
            ->add(bcpow(bcsub($b->y, $a->y), '2'))
            ->add(bcpow(bcsub($b->z, $a->z), '2'))
            ->sqrt(8);
    }

    public function dumpMap(): void
    {
        print_r(array_map('strval', $map));
    }
}
