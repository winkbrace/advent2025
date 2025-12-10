<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day07\BeamTracer;
use Winkbrace\Advent2025\InputReader;

beforeEach(function() {
    $input = InputReader::read('07', 'example');
    $this->tracer = new BeamTracer($input);
});

it('should start the beam at S', function () {
    $tracer = new BeamTracer([
        '..S..',
        '.....',
    ]);
    $tracer->trace();

    expect($tracer->draw())->toBe(
        <<<DRAW
        ..S..
        ..|..
        DRAW
    );
});

it('should split the beams at a splitter', function () {
    $tracer = new BeamTracer([
        '..S..',
        '..^..',
        '.^...',
    ]);
    $tracer->trace();

    expect($tracer->draw())->toBe(
        <<<DRAW
        ..S..
        .|^|.
        |^||.
        DRAW
    );
});

it('should trace the beam', function () {
    $this->tracer->trace();

    expect($this->tracer->draw())->toBe(
        <<<DRAW
        .......S.......
        .......|.......
        ......|^|......
        ......|.|......
        .....|^|^|.....
        .....|.|.|.....
        ....|^|^|^|....
        ....|.|.|.|....
        ...|^|^|||^|...
        ...|.|.|||.|...
        ..|^|^|||^|^|..
        ..|.|.|||.|.|..
        .|^|||^||.||^|.
        .|.|||.||.||.|.
        |^|^|^|^|^|||^|
        |.|.|.|.|.|||.|
        DRAW
    );
});
