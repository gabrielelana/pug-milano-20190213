<?php
namespace PUG;

use Eris\Generator;
use Eris\Generator\GeneratedValueSingle;
use Eris\Random\RandomRange;

class CollectionGenerator implements Generator
{
    /** @var Generator */
    private $generator;

    public function __construct()
    {
        $this->generator = Generator\seq(Generator\nat());
    }

    public function __invoke($size, RandomRange $rand)
    {
        $input =  $this->generator->__invoke($size, $rand);
        return $input->map(
            /** @param array<int, int> $value */
            function($value) {
                return new Collection($value);
            },
            self::class
        );
    }

    public function shrink(GeneratedValueSingle $value)
    {
        return $this->generator->shrink($value);
    }
}
