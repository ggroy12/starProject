<?php

require __DIR__ . '/bootstrap.php';

$databaseName = 'space_battle';
$databaseUser = 'space_battle';
$databasePassword = 'space_battle';

$pdo = new PDO('mysql:host=localhost;dbname='.$databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('DROP TABLE IF EXISTS battle_history;');
$pdo->exec('CREATE TABLE `battle_history` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `nameWinningShip` int(6) COLLATE utf8mb4_unicode_ci NOT NULL,
        `nameShip1` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ship1Quantity` int NOT NULL,
        `remainingStrength1` int(6) NOT NULL,
        `nameShip2` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ship2Quantity` int NOT NULL,
        `remainingStrength2` int(6) NOT NULL,
        `timeBattle` DATETIME(0) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

echo 'Ding!';
