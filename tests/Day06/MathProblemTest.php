<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day06\MathProblem;
use Winkbrace\Advent2025\Day06\Operator;

it('solves addition problems', function () {
    $problem = new MathProblem(['10', '11', '12'], Operator::Plus);

    expect($problem->solve())->toBe('33');
});

it('solves multiplication problems', function () {
    $problem = new MathProblem(['10', '11', '12'], Operator::Multiply);

    expect($problem->solve())->toBe('1320');
});
