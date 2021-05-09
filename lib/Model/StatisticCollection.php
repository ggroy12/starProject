<?php

declare(strict_types=1);

namespace Model;

class StatisticCollection implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var Statistic[]
     */
    private array $statistic;

    /**
     * $StatisticCollection constructor.
     * @param Statistic[] $statistic
     */
    public function __construct(
        array $statistic
    ) {
        foreach ($statistic as $data) {
            $this->add($data);
        }
    }

    public function add(Statistic $value): self
    {
        $this->statistic[] = $value;

        return $this;
    }

    public function getIterator(): \ArrayIterator
    {
        try {
            return new \ArrayIterator($this->statistic);
        } catch (\Throwable $e) {
            return new \ArrayIterator([]);
        }
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

    public function deleteByKey($key): void
    {
        unset($this->statistic[$key]);
    }

    public function deleteByObject(int $story): void
    {
        foreach ($this->statistic as $data) {
            if ($data->getId() === $story) {
                unset($this->statistic[$story]);
            }
        }
    }

    public function count($array): int
    {
        return count($array);
    }

    public function arrayReverse(): array
    {
        try {
            return array_reverse($this->statistic);
        } catch (\Throwable $e) {
            return [];
        }
    }

    public function arraySlice($array, $firstRecording, $totalLimit): array
    {
        return array_slice($array, $firstRecording, $totalLimit);
    }
}