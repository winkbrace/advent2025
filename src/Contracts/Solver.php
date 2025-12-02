<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Contracts;

interface Solver {
    public function solveA(string $part): string;
    public function solveB(string $part): string;
}
