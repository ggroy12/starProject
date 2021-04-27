<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

use Service\Container;

$configuration = [
    'db_dsn' => 'mysql:host=localhost;dbname=space_battle',
    'db_user' => 'space_battle',
    'db_password' => 'space_battle'
];

require __DIR__ . '/vendor/autoload.php';


$container = new Container($configuration);
