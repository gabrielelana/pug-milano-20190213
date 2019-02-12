<?php

$a = ['foo', 'bar'];

// Yep, swap expects an array<int, string>
swap($a);

$b = ['foo' => 0, 'bar' => 1];

// Nope, `swap` expects an array<int, string>
swap($b);
