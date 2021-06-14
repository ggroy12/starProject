<?php

declare(strict_types=1);

class BuilderShip2 implements BuilderShipInterface
{
    private Ship2 $ship;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->ship = new Ship2();
    }

    public function name(): void
    {
        $this->ship->ship['name'] = "JediStarFighter";
    }

    public function strength(): void
    {
        $this->ship->ship['strength'] = 800;
    }

    public function weaponPower(): void
    {
        $this->ship->ship['weaponPower'] = 95;
    }

    public function getShip(): Ship2
    {
        $result = $this->ship;
        $this->reset();

        return $result;
    }
}

