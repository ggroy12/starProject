<?php

require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/Generators.php';

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$generator = new Generators($container->getPDO());

foreach ($generator->getRecords(10000) as $item){
    echo $generator->convert(memory_get_usage()) . "\n";
    print_r($item);
}

echo 'Completed!';