<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;

class LoggalableShipStorage implements ShipStorageInterface
{
    private ShipStorageInterface $shipStorage;

    public function __construct(
      ShipStorageInterface $shipStorage
    ) {
        $this->shipStorage = $shipStorage;
    }

    public function getAllShips(): array
    {
        $this->log('get all ships ');
        $ships = $this->shipStorage->getAllShips();
        $this->log('Ship count:'. count($ships));

        return $ships;
    }

    public function getSingleShip(int $id): ?AbstractShip
    {
        $this->log('get single ship');
        return $this->shipStorage->getSingleShip($id);
    }

    private function log(string $message): void
    {
        echo $message;
    }
}