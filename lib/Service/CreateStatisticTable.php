<?php

declare(strict_types=1);

namespace Service;

use PDO;

class CreateStatisticTable implements StatisticWriteInterface
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    /*Function for the table reset button BD of battle_history*/
    public function recreateTheTable(): void
    {
        $this->pdo->exec('DROP TABLE IF EXISTS battle_history;');
        $this->pdo->exec(
            'CREATE TABLE `battle_history` (
        `id` int (6) NOT NULL AUTO_INCREMENT,
        `winnerId` int (6) DEFAULT NULL,
        `nameShipId1` int (6) NOT NULL ,
        `ship1Quantity` int (6) NOT NULL,
        `remainingStrength1` int (6) NOT NULL,
        `nameShipId2` int (6) NOT NULL,
        `ship2Quantity` int (6) NOT NULL,
        `remainingStrength2` int (6) NOT NULL,
        `timeBattle` DATETIME (0) NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (winnerId) REFERENCES ship (id),
        FOREIGN KEY (nameShipId1) REFERENCES ship (id),
        FOREIGN KEY (nameShipId2) REFERENCES ship (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }

    public function add(
        $winnerId,
        $shipNameId1,
        $shipQuantity1,
        $shipStrength1,
        $shipNameId2,
        $shipQuantity2,
        $shipStrength2
    ): void {
        $this->pdo->exec(
            "INSERT INTO battle_history(
                winnerId, 
                nameShipId1, 
                ship1Quantity, 
                remainingStrength1, 
                nameShipId2, 
                ship2Quantity, 
                remainingStrength2, 
                timeBattle
                )VALUES(
                '{$winnerId}', 
                '{$shipNameId1}', 
                '{$shipQuantity1}', 
                '{$shipStrength1}', 
                '{$shipNameId2}', 
                '{$shipQuantity2}', 
                '{$shipStrength2}', 
                '{$this->timeNow()}')"
        );
    }

    public function timeNow()
    {
        return date('Y:m:d:H:i:s');
    }
}
