<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$configuration = [
    'db_dsn' => 'mysql:host=localhost;dbname=space_battle',
    'db_user' => 'space_battle',
    'db_password' => 'space_battle'
];

require __DIR__ . '/lib/Service/Container.php';
require __DIR__ . '/lib/Service/ShipStorageInterface.php';
require __DIR__ . '/lib/Service/BattleManager.php';
require __DIR__ . '/lib/Service/ShipLoader.php';
require __DIR__ . '/lib/Service/Pagination.php';
require __DIR__ . '/lib/Service/StatisticsLoader.php';
require __DIR__ . '/lib/Service/CreateStatisticsTable.php';
require __DIR__ . '/lib/Service/PdoShipStorage.php';
require __DIR__ . '/lib/Service/JsonFileShipStorage.php';
require __DIR__ . '/lib/Model/Statistics.php';
require __DIR__ . '/lib/Model/BattleResult.php';
require __DIR__ . '/lib/Model/AbstractShip.php';
require __DIR__ . '/lib/Model/Ship.php';
require __DIR__ . '/lib/Model/RebelShip.php';
require __DIR__ . '/lib/Model/BrokenShip.php';

$container = new Container($configuration);
