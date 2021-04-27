<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;

interface ShipStorageInterface
{
    /**
     * @return AbstractShip[]
     */
    public function getAllShips(): array;

    public  function getSingleShip(int $id): ?AbstractShip;
}