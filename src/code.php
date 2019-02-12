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

class Person
{
    public $name;
    public $surname;
    private $secret;
}
