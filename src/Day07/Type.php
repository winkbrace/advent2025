<?php declare(strict_types=1);

namespace Winkbrace\Advent2025\Day07;

enum Type: string
{
    case Empty = '.';
    case Start = 'S';
    case Splitter = '^';
    case Beam = '|';
}
