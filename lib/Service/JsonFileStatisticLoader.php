<?php

declare(strict_types=1);

namespace Service;

use Model\Statistic;
use Model\StatisticCollection;

class JsonFileStatisticLoader implements StatisticStorageInterface
{
    private string $filePath;

    private string $fileShipsPath;

    private ?JsonFileShipStorage $shipLoader = null;

    public function __construct(
        string $filePath,
        string $fileShipsPath,
    ) {
        $this->filePath = $filePath;
        $this->fileShipsPath = $fileShipsPath;
    }

    public function getStatistic(): StatisticCollection
    {
        try {
            $fileContent = file_get_contents($this->filePath);
            $jsonStatistic = json_decode($fileContent, true);
            $statistic = [];
            if ($jsonStatistic) {
                foreach ($jsonStatistic as $dbStat) {
                    $statistic[] = $this->transformDataToStatistic($dbStat);
                }
            }
            return new StatisticCollection($statistic);
        } catch (\Throwable $e) {
            trigger_error($e->getMessage());
            return new StatisticCollection([]);
        }
    }

    private function transformDataToStatistic(array $data): Statistic
    {
        return $statistic = new Statistic(
            (int) $data['id'],
            (int) $data['aWinner'],
            (int) $data['shipName1'],
            (int) $data['shipQuantity1'],
            (int) $data['shipStrength1'],
            (int) $data ['shipName2'],
            (int) $data['shipQuantity2'],
            (int) $data['shipStrength2'],
            (string) $data['timeBattle']
        );
    }

    public function transformIdToShip($idShip): string
    {
        if ($this->shipLoader === null) {
            $this->shipLoader = new JsonFileShipStorage($this->fileShipsPath);
        }
        if (empty($idShip)) {
            return 'Ничья';
        }
        $ships = $this->shipLoader->getAllShips();
        $ship = $this->shipLoader->getSingleShip($idShip);

        return empty($ship) ? "ID '$idShip' is not correct!" : $ship->getName();
    }
}