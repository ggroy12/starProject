<?php

declare(strict_types=1);

class Decorator
{
    protected $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    protected function getObject()
    {
        return $this->object;
    }

    public function operation()
    {
        return $this->getObject()->operation();
    }

}
