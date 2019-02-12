<?php

$p = new Person();
$p->name = "Gabriele";
$p->surname = "Lana";

// Nope, doesn't exists
$p->foo = "Something";

// Nope, doesn't exists
echo $p->bar;

// Nope, a secret is a secret after all
echo $p->secret;
