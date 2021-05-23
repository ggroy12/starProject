<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;

class ShipLoader
{
    private ShipStorageInterface $shipStorage;

    public function __construct(
        ShipStorageInterface $shipStorage
    ) {
        $this->shipStorage = $shipStorage;
    }

    /**
     * @return AbstractShip[]
     */
    public function getShips(): array
    {
        return $this->shipStorage->getAllShips();
    }

    public function find(int $id): ?AbstractShip
    {
        return $this->shipStorage->getSingleShip($id);
    }
}