<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day06;

class MathProblemsParser
{
    /** @var MathProblem[] */
    private array $problems = [];

    public function __construct(readonly array $input) {}

    /** @return MathProblem[] */
    public function parseForA(): array
    {
        $columns = [];

        foreach ($this->input as $r => $line) {
            $chars = array_values(array_filter(explode(' ', $line)));
            if (is_numeric($chars[0])) {
                // Group the input by column.
                foreach ($chars as $c => $nr) {
                    $columns[$c] ??= [];
                    $columns[$c][$r] = $nr;
                }
            } else {
                // we are at the bottom line, which contains the operators
                foreach ($chars as $c => $operator) {
                    $this->problems[] = new MathProblem($columns[$c], Operator::from($operator));
                }
            }
        }

        return $this->problems;
    }

    /** @return MathProblem[] */
    public function parseForB(): array
    {
        $width = max(array_map('strlen', $this->input));
        $height = count($this->input);

        // Start at top right and process all columns top-to-bottom in the left direction
        $numbers = [];
        for ($c = $width - 1; $c >= 0; $c--) {
            $number = '';
            for ($r = 0; $r < $height; $r++) {
                $char = $this->input[$r][$c] ?? ' ';
                if (is_numeric($char)) {
                    $number .= $char;
                } elseif ($r === $height - 1) {
                    $numbers[] = $number;
                }
                if ($operator = Operator::tryFrom($char)) {
                    // When we reach the operator, we know we have found all numbers in the collection.
                    $this->problems[] = new MathProblem($numbers, $operator);
                    $numbers = [];

                    // we can skip the next empty column
                    $c--;
                }
            }
        }

        return $this->problems;
    }
}
