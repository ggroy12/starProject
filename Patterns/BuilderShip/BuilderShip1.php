<?php

declare(strict_types=1);

class BuilderShip1 implements BuilderShipInterface
{
    private Ship1 $ship;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->ship = new Ship1();
    }

    public function name(): void
    {
        $this->ship->ship['name'] = "SuperStarDestroyer";
    }

    public function strength(): void
    {
        $this->ship->ship['strength'] = 1500;
    }

    public function weaponPower(): void
    {
        $this->ship->ship['weaponPower'] = 85;
    }

    public function getShip(): Ship1
    {
        $result = $this->ship;
        $this->reset();

        return $result;
    }
}

