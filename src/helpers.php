<?php declare(strict_types=1);

function dd(mixed ...$vars): never
{
    var_dump(...$vars);
    exit(1);
}

function debug(string $msg): void
{
    if (defined('DEBUG')) {
        echo "{$msg}\n";
    }
}
