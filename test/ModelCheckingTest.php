<?php
namespace PUG;

use Eris\Generator;
use Eris\TestTrait;
use PHPUnit\Framework\TestCase;

class ModelCheckingTest extends TestCase
{
    use TestTrait;

    public function testShallPass()
    {
        $this
            ->forAll(Generator\seq(Generator\oneOf(
                Generator\map(
                    function($keyAndValue) {
                        return ['set', $keyAndValue[0], $keyAndValue[1]];
                    },
                    Generator\tuple(
                        Generator\regex('[a-z0-9]{1,5}'),
                        Generator\string()
                    )
                ),
                Generator\map(
                    function($key) {
                        return ['get', $key];
                    },
                    Generator\regex('[a-z0-9]{1,5}')
                ),
                Generator\map(
                    function($key) {
                        return ['del', $key];
                    },
                    Generator\regex('[a-z0-9]{1,5}')
                )
            )))
            ->then(function($commands) {
                $model = new ModelKeyValueStore();
                $real = new RealKeyValueStore();

                foreach ($commands as $command) {
                    $this->executeCommandOn($command, $model);
                    $this->executeCommandOn($command, $real);
                }

                foreach ($model->keys() as $key) {
                    $this->assertEquals(
                        $model->get($key), $real->get($key),
                        $this->explain($key, $commands));
                }
            });
    }

    private function executeCommandOn($command, $target)
    {
        switch ($command[0]) {
            case 'set':
                $target->set($command[1], $command[2]);
                break;
            case 'get':
                $target->get($command[1]);
                break;
            case 'del':
                $target->del($command[1]);
                break;
        }
    }

    private function explain($key, $commands) {
        return implode(
            PHP_EOL,
            [
                "After the following commands",
                implode(
                    PHP_EOL,
                    array_map(function($command) {
                        return '[' . implode(', ', $command) . ']';
                    }, $commands)
                ),
                "the value associated to key `{$key}` is different between the models"
            ]
        );
    }
}
