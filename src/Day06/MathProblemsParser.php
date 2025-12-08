<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day06;

class MathProblemsParser
{
    /** @var MathProblem[] */
    private array $problems = [];

    public function __construct(readonly array $input) {}

    /** @return MathProblem[] */
    public function parse(): array
    {
        $columns = [];

        foreach ($this->input as $r => $line) {
            $chars = array_values(array_filter(explode(' ', $line)));
            if (is_numeric($chars[0])) {
                // Group the input by column.
                $numbers = array_map('intval', $chars);
                foreach ($numbers as $c => $nr) {
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
}
