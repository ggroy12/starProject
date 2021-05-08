<?php

declare(strict_types=1);

namespace Model;

class StatisticCollection implements \ArrayAccess, \IteratorAggregate
{
    private array $statistic;

    public function __construct(
        array $statistic
    ) {
        $this->statistic = $statistic;
    }

    public function add($statistic): self
    {
        $this->statistic[] = $statistic;

        return $this;
    }

//    public function deleteById($id): self
//    {
//        $this->statistic[$id] = [];
//        foreach ($this->statistic as $item) {
//            if ($item->getId() === $id) {
//               $item = [];
//            }
//            return $this;
//        }
//    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->statistic);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->statistic);
    }

    public function offsetGet($offset)
    {
        return $this->statistic[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->statistic[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->statistic[$offset]);
    }

    public function clear(): self
    {
        $this->statistic = [];

        return $this;
    }
}