<?php

// Ok
printf("This is a number %d", 1);

// Nope
printf("This is a number %d", 1, "bar");

// Nope, it worked until PHPStan 11 :-@
printf("This is a string %d", null);
