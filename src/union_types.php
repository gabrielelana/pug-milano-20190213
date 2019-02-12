<?php

$d = null;

if (rand(0, 1) > 0) {
    $d = 1;
} else {
    $d = 'foo';
}

// Nope $d can be an int or a string and we need an int
needAnInteger($d);
