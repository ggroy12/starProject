<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;
use Model\ShipCollection;

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
    public function getShips(): ShipCollection
    {
        try {
            return new ShipCollection($this->shipStorage->getAllShips());
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
            return [];
        }
    }

    public function find(int $id): ?AbstractShip
    {
        return $this->shipStorage->getSingleShip($id);
    }
}