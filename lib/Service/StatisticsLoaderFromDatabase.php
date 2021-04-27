<?php

declare(strict_types=1);

namespace Service;

use Model\Statistic;
use PDO;

class StatisticsLoaderFromDatabase implements StatisticsStorageInterface
{
    private PDO $pdo;
    private ?PdoShipStorage $shipLoader = null;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function getStatistics(): array
    {
        $session = new Session();
        $numberOfFirstRecords = $session->get('numberOfFirstRecords');
        $numberOfNextPages = $session->get('numberOfNextRecords');
        $statement = $this->pdo->query(
            "SELECT * FROM battle_history ORDER BY id DESC LIMIT $numberOfFirstRecords, $numberOfNextPages"
        );
        $statement->execute();
        $dbStatistic = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statistic = [];
        foreach ($dbStatistic as $dbStat) {
            $statistic[] = $this->transformDataToStatistic($dbStat);
        }
        return $statistic;
    }

    private function transformDataToStatistic(array $data): Statistic
    {
        return $statistic = new Statistic(
            (int) $data['id'],
            (int) $data['aWinnerId'],
            (int) $data['nameShipId1'],
            (int) $data['ship1Quantity'],
            (int) $data['remainingStrength1'],
            (int) $data ['nameShipId2'],
            (int) $data['ship2Quantity'],
            (int) $data['remainingStrength2'],
            (string) $data['timeBattle']
        );
    }

    public function transformIdToShip($idShip): string
    {
        if ($this->shipLoader === null) {
            $this->shipLoader = new PdoShipStorage($this->pdo);
        }
        if ($idShip == null) {
            return 'Ничья';
        }
        $ships = $this->shipLoader->getAllShips();
        $ship = $this->shipLoader->getSingleShip($idShip);

        return $ship->getName();
    }
}