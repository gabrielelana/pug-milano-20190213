<?php

// A function `increment` exists
$callable = "increment";

// Ok
$callable(1);

// A function foo doesn't exists
$callable = "foo";

// Nope, `foo` is not callable
$callable(1);
