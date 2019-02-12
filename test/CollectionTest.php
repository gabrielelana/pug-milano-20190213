<?php
namespace PUG;

use Eris\Generator;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    use TestTrait;

    public function testEqualsWorks()
    {
        $this->assertEquals(new Collection([1, 2, 3]), new Collection([1, 2, 3]));
        $this->assertNotEquals(new Collection([1, 2, 3]), new Collection([1, 2, 3, 4]));
        $this->assertNotEquals(new Collection([2, 1, 3]), new Collection([1, 2, 3]));
    }

    public function testUniqueCanOnlyRemoveValues()
    {
        $this
            ->forAll(Generator\seq(Generator\nat()))
            ->then(function($values) {
                $original = new Collection($values);
                $unique = $original->unique();

                $this->assertLessThanOrEqual($original->count(), $unique->count());
            });
    }

    public function testUniqueMustShortenTheNumberOfValuesWhenThereAreDuplicates()
    {
        $this
            // ->limitTo(10000)
            ->forAll(
                Generator\bind(
                    Generator\seq(Generator\nat()),
                    function ($values) {
                        if (!empty($values)) {
                            shuffle($values);
                            $values[] = $values[0];
                            shuffle($values);
                        }
                        return Generator\constant($values);
                    }
                )
            )
            ->when(function($values) { return !empty($values); })
            ->then(function($values) {
                $original = new Collection($values);
                $unique = $original->unique();

                $this->assertLessThan(
                    $original->count(),
                    $unique->count(),
                    var_export($values, true)
                );
            });
    }

    public function testUniqueShouldWorkLikeArrayUniqueFromStandardLibrary()
    {
        $this->forAll(Generator\seq(Generator\nat()))
            ->then(function($values) {
                $unique = array_unique($values);

                sort($values);
                sort($unique);

                $this->assertEquals(
                    (new Collection($values))->unique(),
                    new Collection($unique),
                    var_export($values, true)
                );
            });

    }

    public function testUniqueIsIdempotent()
    {
        $this->forAll(new CollectionGenerator())
            ->then(function($collection) {
                $this->assertEquals(
                    $collection->unique(),
                    $collection->unique()->unique()
                );
            });
    }
}
