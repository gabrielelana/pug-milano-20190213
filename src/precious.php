<?php

require __DIR__ . '/../vendor/autoload.php';

$a = PUG\Amount::fromString('10.00/EUR');

echo $a->aaa . PHP_EOL;
// echo $tenEuros->currency . PHP_EOL;
// echo $tenEuros->precision . PHP_EOL;
