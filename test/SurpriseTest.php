<?php
namespace PUG;

use Eris\Generator;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

class SurpriseTest extends TestCase
{
    use TestTrait;

    private function double(int $i)
    {
        return $i * 2;
    }

    public function testShallPass()
    {
        $this->forAll(Generator\int())
            ->then(function($number) {
                $this->assertGreaterThan($number, $this->double($number));
            });
    }
}
