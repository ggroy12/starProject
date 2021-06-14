<?php

declare(strict_types=1);

class Ship1
{
    public array $ship = [];

    public function listParameters(): void
    {
        print_r($this->ship);
        echo  '<br>';
    }
}