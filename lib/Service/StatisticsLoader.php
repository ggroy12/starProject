<?php
declare(strict_types=1);

class StatisticsLoader
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function getSession($form, $numberOfNextPages): array
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
            (int) $data['id'],
            $data['nameWinningShip'],
            $data['nameShip1'],
            (int) $data['ship1Quantity'],
            (int) $data['remainingStrength1'],
            $data ['nameShip2'],
            (int)$data['ship2Quantity'],
            (int)$data['remainingStrength2'],
            $data['timeBattle']
        );
    }
}