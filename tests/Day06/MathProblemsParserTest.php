<?php declare(strict_types=1);

use Winkbrace\Advent2025\Day06\MathProblem;
use Winkbrace\Advent2025\Day06\MathProblemsParser;
use Winkbrace\Advent2025\Day06\Operator;

beforeEach(function() {
    $input = array_map(
                fn (string $line) => rtrim($line, "\n\r"),
                file(__DIR__ . "/../../src/Day06/input/example.txt"),
            );
    $this->parser = new MathProblemsParser($input);
});

it('parses the input for puzzle A', function () {
    $problems = $this->parser->parseForA();

    expect($problems)->toHaveCount(4)
        ->and($problems[0])->toEqual(new MathProblem(['123', '45', '6'], Operator::Multiply))
        ->and($problems[1])->toEqual(new MathProblem(['328', '64', '98'], Operator::Plus))
        ->and($problems[2])->toEqual(new MathProblem(['51', '387', '215'], Operator::Multiply))
        ->and($problems[3])->toEqual(new MathProblem(['64', '23', '314'], Operator::Plus));
});

it('parses the input for puzzle B', function () {
    $problems = $this->parser->parseForB();

    expect($problems)->toHaveCount(4)
        ->and($problems[0])->toEqual(new MathProblem(['4', '431', '623'], Operator::Plus))
        ->and($problems[1])->toEqual(new MathProblem(['175', '581', '32'], Operator::Multiply))
        ->and($problems[2])->toEqual(new MathProblem(['8', '248', '369'], Operator::Plus))
        ->and($problems[3])->toEqual(new MathProblem(['356', '24', '1'], Operator::Multiply));
});
