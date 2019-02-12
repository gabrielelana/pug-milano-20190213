<?php
namespace PUG;

class RealKeyValueStore implements KeyValueStore
{
    /** @var array<string, mixed> */
    private $values;

    public function __construct()
    {
        $this->values = [];
    }

    /**
     * @param string $key
     * @return ?mixed
     */
    public function get(string $key)
    {
        return $this->values[$key] ?? null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value): void
    {
        if (array_key_exists($key, $this->values)) {
            $this->del($key);
        } else {
            $this->values[$key] = $value;
        }
    }

    /**
     * @param string $key
     * @return void
     */
    public function del(string $key): void
    {
        unset($this->values[$key]);
    }

    /**
     * @return iterable
     */
    public function keys(): iterable
    {
        return array_keys($this->values);
    }
}
