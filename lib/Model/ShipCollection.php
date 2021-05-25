<?php

declare(strict_types=1);

namespace Model;

use Exception;
use Traversable;

class ShipCollection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * @var AbstractShip[]
     */
    private array $ships;

    /**
     * ShipCollection constructor.
     * @param AbstractShip[] $ships
     */
    public function __construct(
      array $ships
    ) {
        foreach ($ships as $ship){
            $this->add($ship);
        }
    }

    public function add(AbstractShip $ship): self
    {
        $this->ships[] = $ship;

        return $this;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->ships);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->ships);
    }

    public function offsetGet($offset)
    {
        return $this->ships[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->ships[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->ships[$offset]);
    }

    public function count(): int
    {
        return count($this->ships);
    }

    public function clear(): self
    {
        $this->ships = [];

        return $this;
    }
}