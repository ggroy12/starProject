<?php

require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/Generators.php';

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$generator = new Generators($container->getPDO());

foreach ($generator->getRecords(10000) as $text) {
    echo $generator->convert(memory_get_usage()) . '<br>';
    print_r($text) . "<br>";
}

echo 'Completed!';