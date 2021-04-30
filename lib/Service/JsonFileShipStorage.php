<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;
use Model\RebelShip;
use Model\Ship;

class JsonFileShipStorage implements ShipStorageInterface
{
    private string $filePath;

    function __construct(
        string $filePath
    ) {
        $this->filePath = $filePath;
    }

    /**
     * @return AbstractShip[]
     */
    public function getAllShips(): array
    {
        $fileContent = file_get_contents($this->filePath);
        $jsonShips = json_decode($fileContent, true);
        $ships = [];
        foreach ($jsonShips as $jsonShip) {
            $ships[] = $this->transformDataToShip($jsonShip);
        }
        return $ships;
    }

    public function getSingleShip(int $id): ?AbstractShip
    {
        foreach ($this->getAllShips() as $ship) {
            if ($ship->getId() === $id) {
                return $ship;
            }
        }
        return null;
    }

    private function transformDataToShip(array $data): AbstractShip
    {
        if ($data['team'] === 'rebel') {
            $ship = new RebelShip($data['name']);
        } else {
            $ship = new Ship($data['name']);
            $ship->setJediFactor((int) $data['jedi_factor']);
        }
        $ship->setId((int) $data['id'])
            ->setWeaponPower((int) $data['weapon_power'])
            ->setStrength((int) $data['strength']);

        return $ship;
    }
}