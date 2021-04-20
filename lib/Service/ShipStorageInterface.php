<?php

declare(strict_types=1);

interface ShipStorageInterface
{
    /**
     * @return AbstractShip[]
     */
    public function getAllShips(): array;

    public  function getSingleShip(int $id): ?AbstractShip;
}