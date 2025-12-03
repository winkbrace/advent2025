<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day03\JoltageFinder;

it('finds max 2-length joltage', function (string $bank, string $expected) {
    expect(JoltageFinder::findMax($bank, 2))->toBe($expected);
})->with([
    ['987654321111111', '98'],
    ['811111111111119', '89'],
    ['234234234234278', '78'],
    ['818181911112111', '92'],
]);

it('finds max 12-length joltage', function (string $bank, string $expected) {
    expect(JoltageFinder::findMax($bank, 12))->toBe($expected);
})->with([
    ['987654321111111', '987654321111'],
    ['811111111111119', '811111111119'],
    ['234234234234278', '434234234278'],
    ['818181911112111', '888911112111'],
])->only();
