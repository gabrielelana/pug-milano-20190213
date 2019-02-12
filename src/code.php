<?php

function needAnInteger(int $i): int
{
    return $i + 1;
}

function maybeReturnsAnInteger(bool $b): ?int
{
    if ($b) {
        return rand(1, 100);
    }
    return null;
}

function increment(int $i): int
{
    return $i + 1;
}

/**
 * @param array<int, string> $a
 * @return array<string, int>
 */
function swap(array $a): array
{
    return array_flip($a);
}

class Person
{
    public $name;
    public $surname;
    private $secret;
}
