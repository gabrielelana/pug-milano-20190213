<?php
namespace PUG;

interface KeyValueStore
{
    /**
     * @param string $key
     * @return ?mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value): void;

    /**
     * @param string $key
     * @return void
     */
    public function del(string $key): void;

    /**
     * @return iterable
     */
    public function keys(): iterable;
}
