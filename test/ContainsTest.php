<?php
namespace PUG;

use Eris\Generator;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

class ContainsTest extends TestCase
{
    use TestTrait;

    public function testShrinking()
    {
        $this
            // ->limitTo(10000)
            ->forAll(Generator\string())
            ->then(function ($string) {
                var_dump($string);
                $this->assertNotContains('B', $string);
            });
    }
}
