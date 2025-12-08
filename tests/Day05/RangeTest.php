<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day05\Range;

it('contains numbers', function (string $id, bool $expected) {
    $range = new Range('10', '30');
    expect($range->contains($id))->toBe($expected);
})->with([
    ['1', false],
    ['9', false],
    ['10', true],
    ['30', true],
    ['31', false],
    ['200', false],
]);
