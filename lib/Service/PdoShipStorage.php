<?php

declare(strict_types=1);

namespace Service;

use Model\AbstractShip;
use Model\RebelShip;
use Model\Ship;
use PDO;

class PdoShipStorage implements ShipStorageInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo =$pdo;
    }

    /**
     * @return AbstractShip[]
     */
    public function getAllShips(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ship;');
        $statement->execute();
        $dbShips = $statement->fetchAll(PDO::FETCH_ASSOC);

        $ships = [];
        foreach ($dbShips as $dbShip) {
            $ships[] = $this->transformDataToShip($dbShip);
        }

        return $ships;
    }

    public function getSingleShip(int $id): ?AbstractShip
    {
        $statement = $this->pdo->prepare('SELECT * FROM ship WHERE id = :id;');
        $statement->execute(['id' => $id]);
        $dbShip = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$dbShip) {
            return null;
        }

        return $this->transformDataToShip($dbShip);
    }

    private function transformDataToShip(array $data): AbstractShip
    {
        if ($data['team'] === 'rebel'){
            $ship = new RebelShip($data['name']);
        }
        else {
            $ship = new Ship($data['name']);
            $ship->setJediFactor((int) $data['jedi_factor']);

        }
        $ship->setId((int) $data['id'])
            ->setWeaponPower((int) $data['weapon_power'])
            ->setStrength((int) $data['strength'])
        ;

        return $ship;
    }
}