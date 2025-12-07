<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day04\Cell;
use Winkbrace\Advent2025\Day04\PaperRollStorage;

beforeEach(function() {
    $input = array_map('trim', file(__DIR__ . "/../../src/Day04/input/example.txt"));
    $this->storage = new PaperRollStorage($input);
});

it('can create the grid from input', function () {
    $grid = $this->storage->toArray();

    $firstRow = array_map(fn(Cell $cell) => $cell->occupied, $grid[0]);
    expect($firstRow)->toEqual([
        false, false, true, true, false, true, true, true, true, false
    ]);
});

it('can return the expected cell', function() {
    $cell = $this->storage->cellAt(0,0);

    expect($cell->c)->toBe(0)
        ->and($cell->r)->toBe(0)
        ->and($cell->occupied)->toBeFalse();
});

it('can return the neighbouring cells at top left', function () {
    $cell = $this->storage->cellAt(0,0);
    $neighbours = $this->storage->neighbours($cell);

    expect($neighbours)->toEqual([
        $this->storage->cellAt(0, 1),
        $this->storage->cellAt(1, 0),
        $this->storage->cellAt(1, 1),
    ]);
});

it('can return the neighbouring cells at bottom right', function () {
    $cell = $this->storage->cellAt(9,9);
    $neighbours = $this->storage->neighbours($cell);

    expect($neighbours)->toEqual([
        $this->storage->cellAt(8, 8),
        $this->storage->cellAt(8, 9),
        $this->storage->cellAt(9, 8),
    ]);
});

it('determines if a paper roll is accessible when it has fewer than 4 occupied neighbours', function () {
    $cell = $this->storage->cellAt(0,2);

    expect($this->storage->isAccessible($cell))->toBeTrue();
});

it('a paper roll is not accessible when it is not present', function () {
    $cell = $this->storage->cellAt(0,0);
    expect($this->storage->isAccessible($cell))->toBeFalse();
});


