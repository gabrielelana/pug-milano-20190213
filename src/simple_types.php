<?php

// All is ok
needAnInteger(1);

// Nope, needAnInteger required an integer
needAnInteger("foo");

// Nope, needAnInteger returns an integer
explode(",", needAnInteger(1));
