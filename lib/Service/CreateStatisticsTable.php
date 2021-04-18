<?php
declare(strict_types=1);

class CreateStatisticsTable
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    /*Функция для кнопки сброса таблицы БД battle_history*/
    public function recreateTheTable():void {
        $this->pdo->exec('DROP TABLE IF EXISTS battle_history;');
        $this->pdo->exec('CREATE TABLE `battle_history` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `nameWinningShip` int(6) COLLATE utf8mb4_unicode_ci NOT NULL,
        `nameShip1` int(6) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ship1Quantity` int NOT NULL,
        `remainingStrength1` int(6) NOT NULL,
        `nameShip2` int(6) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ship2Quantity` int NOT NULL,
        `remainingStrength2` int(6) NOT NULL,
        `timeBattle` DATETIME(0) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    }

    public function createItemInTable(
        $nameWinningShip,
        $shipName1,
        $ship1Quantity,
        $remainingStrength1,
        $shipName2,
        $ship2Quantity,
        $remainingStrength2):void {
            $this->pdo->exec("INSERT INTO battle_history(
                nameWinningShip, 
                nameShip1, 
                ship1Quantity, 
                remainingStrength1, 
                nameShip2, 
                ship2Quantity, 
                remainingStrength2, 
                timeBattle
                )VALUES(
                '{$nameWinningShip}', 
                '{$shipName1}', 
                '{$ship1Quantity}', 
                '{$remainingStrength1}', 
                '{$shipName2}', 
                '{$ship2Quantity}', 
                '{$remainingStrength2}', 
                '{$this->timeNow()}')"
            );
        }

    public function timeNow(){
        return date('Y:m:d:H:i:s');
    }
}
