<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day01\Dial;

/**
 * @var Dial $dial - For IDE type-hinting
 */
beforeEach(function() {
    $this->dial = new Dial(100, 5);
});

it('should turn right', function () {
    $this->dial->turn('R10');
    expect($this->dial->value())->toBe(15);
});

it('should turn right to zero', function () {
    $dial = new Dial(100, 95);
    $dial->turn('R5');
    expect($dial->value())->toBe(0)
        ->and($dial->isZero())->toBeTrue();
});

it('should turn left through zero', function () {
    $this->dial->turn('L10');
    expect($this->dial->value())->toBe(95);
});

it('should turn left through zero 4 times', function () {
    $this->dial->turn('L310');
    expect($this->dial->value())->toBe(95)
        ->and($this->dial->zeroesPassed())->toBe(4);
});

it('should count zero when ending on 0', function () {
    $this->dial->turn('L5');
    expect($this->dial->value())->toBe(0)
        ->and($this->dial->zeroesPassed())->toBe(1);
});

it('should count zeroes when ending on 100', function () {
    $this->dial->turn('R295');
    expect($this->dial->value())->toBe(0)
        ->and($this->dial->zeroesPassed())->toBe(3);
});
