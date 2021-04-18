<?php
declare(strict_types=1);

class StatisticsLoader
{
    private PDO $pdo;
    private ?ShipLoader $shipLoader = null;

    public function __construct(
        PDO $pdo,
    ) {
        $this->pdo = $pdo;
    }

    public function getStatistics($form, $numberOfNextPages): array
    {
        $statement = $this->pdo->query("SELECT * FROM battle_history ORDER BY id DESC LIMIT $form, $numberOfNextPages");
        $statement->execute();
        $dbStatistic = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statistic = [];
        foreach ($dbStatistic as $dbStat) {
            $statistic[] = $this->transformDataToStatistic($dbStat);
        }
        return $statistic;
    }

    private function transformDataToStatistic(array $data): Statistics
    {
        return $statistic = new Statistics(
            (int)$data['id'],
            (int)$data['nameWinningShip'],
            (int)$data['nameShip1'],
            (int)$data['ship1Quantity'],
            (int)$data['remainingStrength1'],
            (int)$data ['nameShip2'],
            (int)$data['ship2Quantity'],
            (int)$data['remainingStrength2'],
            (string)$data['timeBattle']
        );
    }

    public function transformIdToShip($idShip): string
    {
        if ($this->shipLoader === null) {
            $this->shipLoader = new ShipLoader($this->pdo);
        }
        if ($idShip == 0){
            return 'Ничья';
        }
        $ships = $this->shipLoader->getShips();
        $ship = $this->shipLoader->find($idShip);
        return $ship->getName();
    }
}