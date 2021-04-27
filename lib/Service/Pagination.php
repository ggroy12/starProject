<?php

declare(strict_types=1);

namespace Service;

class Pagination
{
    private PDO $pdo;

    private string $filePath;

    private int $page;

    private int $numberOfNextRecords;

    public function __construct(
        PDO $pdo,
        string $filePath,
        int $page,
        int $numberOfNextRecords,
    ) {
        $this->pdo = $pdo;
        $this->filePath = $filePath;
        $this->page = $page;
        $this->numberOfNextRecords = $numberOfNextRecords;
    }

    public function getNumberOfFirstRecords(): int
    {
        return ($this->page - 1) * $this->numberOfNextRecords;
    }

    public function getBackPage(): int
    {
        return ($this->page - 1);
    }

    public function getOnwardPage(): int
    {
        return ($this->page + 1);
    }

    public function getPagesCount(): int
    {
        return ceil($this->getNumberOfColumnsInTable() / $this->numberOfNextRecords);
    }

    public function getNumberOfColumnsInTable()
    {
        $chekShipStorage = new Session();
        if ($chekShipStorage->get('shipStorage') === 'PdoShipStorage') {
            $result = $this->pdo->query("SELECT COUNT(*) as count FROM battle_history");
            foreach ($result as $item) {
                return $item['count'];
            }
        } elseif ($chekShipStorage->get('shipStorage') === 'JsonFileShipStorage') {
            $file = file_get_contents($this->filePath);
            $arrayBattles = json_decode($file, true);
            if ($arrayBattles) {
                $arrayBattles = array_reverse($arrayBattles);
                foreach ($arrayBattles as $item) {
                    return $item['id'];
                }
            }
        } else {
            return false;
        }
    }
}
