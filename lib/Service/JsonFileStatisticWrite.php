<?php

declare(strict_types=1);

namespace Service;

class JsonFileStatisticWrite implements StatisticWriteInterface
{
    private string $filePath;

    public function __construct(
        string $filePath,
    ) {
        $this->filePath = $filePath;
    }

    public function add(
        $aWinnerId,
        $shipNameId1,
        $shipQuantity1,
        $shipStrength1,
        $shipNameId2,
        $shipQuantity2,
        $shipStrength2,
    ): void {
        $file = file_get_contents($this->filePath);
        $arrayBattles = json_decode($file, true);
        unset($file);

        $arrayBattles[] = array(
            'id' => $this->idBattle($arrayBattles),
            'aWinner' => $aWinnerId,
            'shipName1' => $shipNameId1,
            'shipQuantity1' => $shipQuantity1,
            'shipStrength1' => $shipStrength1,
            'shipName2' => $shipNameId2,
            'shipQuantity2' => $shipQuantity2,
            'shipStrength2' => $shipStrength2,
            'timeBattle' => $this->timeBattle()
        );

        file_put_contents($this->filePath, json_encode($arrayBattles, JSON_PRETTY_PRINT));
        unset($arrayBattles);
    }

    public function idBattle($arr): int
    {
        if ($arr === null) {
            return 1;
        } else {
            $array = array_reverse($arr);
            foreach ($array as $item) {
                $id = $item['id'];
                $id++;
                return $id;
            }
        }
    }

    public function timeBattle(): string
    {
        return date('Y:m:d:H:i:s');
    }

    public function recreateTheTable(): void
    {
        fopen($this->filePath, 'w');
    }
}