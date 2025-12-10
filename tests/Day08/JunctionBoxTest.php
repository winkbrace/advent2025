<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day08\JunctionBox;

it('maps from and to string', closure: function () {
    $input = '100,200,300';
    $box = JunctionBox::fromString($input);

    expect($box->x)->toBe('100')
        ->and($box->y)->toBe('200')
        ->and($box->z)->toBe('300')
        ->and($box->__toString())->toBe($input);
});
