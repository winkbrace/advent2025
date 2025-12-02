<?php declare(strict_types=1);

function dd(...$vars): void
{
    var_dump(...$vars);
    die;
}

function debug(string $msg): void
{
    if (defined('DEBUG')) {
        echo "{$msg}\n";
    }
}
