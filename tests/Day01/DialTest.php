<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day01\Dial;

describe('day 01 Dial', function () {
    it('should turn right', function () {
        $dial = new Dial(100, 5);
        $dial->turn('R10');
        expect($dial->value())->toBe(15);
    });

    it('should turn right to zero', function () {
        $dial = new Dial(100, 95);
        $dial->turn('R5');
        expect($dial->value())->toBe(0)
            ->and($dial->isZero())->toBeTrue();
    });

    it('should turn left through zero', function () {
        $dial = new Dial(100, 5);
        $dial->turn('L10');
        expect($dial->value())->toBe(95);
    });
});
