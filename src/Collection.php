<?php
namespace PUG;

use ArrayIterator;

class Collection extends ArrayIterator
{
    /**
     * @param array<int, int> $values
     * @return self
     */
    public function __construct(array $values)
    {
        parent::__construct(array_values($values));
    }

    public function unique(): Collection
    {
        $lastValue = null;
        $uniqueValues = [];
        foreach ($this->sortedValues() as $key => $value) {
            // if ($value !== $lastValue || $value === 42) {
            if ($value !== $lastValue) {
                $uniqueValues[$key] = $value;
                $lastValue = $value;
            }
        }
        ksort($uniqueValues);
        return new self($uniqueValues);
    }

    /**
     * @return array<int, int>
     */
    private function sortedValues(): array
    {
        $values = $this->getArrayCopy();
        asort($values);
        return $values;
    }
}
