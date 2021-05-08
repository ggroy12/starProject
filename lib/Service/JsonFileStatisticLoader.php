<?php

declare(strict_types=1);

namespace Service;

use Model\Statistic;

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

    public function getStatistic(): array
    {
        try {
            $fileContent = file_get_contents($this->filePath);
            $jsonStatistic = json_decode($fileContent, true);
            $statistic = [];
            foreach ($jsonStatistic as $data) {
                $statistic[] = $this->transformDataToStatistic($data);
            }
            return $statistic;
        } catch (\Throwable $e) {
            trigger_error($e->getMessage());
            return [];
        }
    }

    private function transformDataToStatistic(array $data): Statistic
    {
        return new Statistic(
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