<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day07;

use Winkbrace\Advent2025\Contracts\Solver;

class Solver07 implements Solver
{
    public function __construct(public readonly array $input) {}

    public function solveA(): string
    {
        $tracer = new BeamTracer($this->input);
        $tracer->trace();

        return (string) $tracer->splitCount();
    }

    public function solveB(): string
    {
        $tracer = new QuantumTracer($this->input);

//        $tracer->traceForSmallSampleDrawing();
//        debug($tracer->drawAll());
//        return (string) count($tracer->timelines());

        $tracer->trace();
        debug($tracer->drawTimelineCounts());
        return (string) $tracer->sumTimelineCounts();
    }
}
