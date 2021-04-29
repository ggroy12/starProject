<?php

require __DIR__ . '/bootstrap.php';

$databaseName = 'space_battle';
$databaseUser = 'space_battle';
$databasePassword = 'space_battle';

$pdo = new PDO('mysql:host=localhost;dbname=' . $databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('DROP TABLE IF EXISTS battle_history;');
$pdo->exec(
    'CREATE TABLE `battle_history` (
        `id` int (6) NOT NULL AUTO_INCREMENT,
        `aWinnerId` int (6) DEFAULT NULL,
        `nameShipId1` int (6) NOT NULL ,
        `ship1Quantity` int (6) NOT NULL,
        `remainingStrength1` int (6) NOT NULL,
        `nameShipId2` int (6) NOT NULL,
        `ship2Quantity` int (6) NOT NULL,
        `remainingStrength2` int (6) NOT NULL,
        `timeBattle` DATETIME (0) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
);

echo 'Ding Hi!';
