<?php

// Nope, can return something that is null
needAnInteger(maybeReturnsAnInteger(true));

// But...
$x = maybeReturnsAnInteger(true);
if (!is_null($x)) {
    needAnInteger($x);
}
