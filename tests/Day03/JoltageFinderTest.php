<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day03\JoltageFinder;

it('finds max joltage', function (string $bank, string $expected) {
    expect(JoltageFinder::findMax($bank))->toBe($expected);
})->with([
    ['987654321111111', '98'],
    ['811111111111119', '89'],
    ['234234234234278', '78'],
    ['818181911112111', '92'],
]);
