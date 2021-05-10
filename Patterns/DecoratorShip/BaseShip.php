<?php

declare(strict_types=1);

class BaseShip
{
    public function operation(): array
    {
        $ship['name'] = 'Super Star Destroyer';
        return $ship;
    }
}