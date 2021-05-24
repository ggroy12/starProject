<?php

declare(strict_types=1);

abstract class AbstractColor
{
    /**
     * @var Implementation
     */
    protected $figure;

    public function __construct(Implementation $figure)
    {
        $this->figure = $figure;
    }

    abstract public function addColor(): string;
}
