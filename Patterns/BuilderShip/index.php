<?php

declare(strict_types=1);

require __DIR__ . '/BuilderShipInterface.php';
require __DIR__ . '/BuilderShip1.php';
require __DIR__ . '/BuilderShip2.php';
require __DIR__ . '/Ship1.php';
require __DIR__ . '/Ship2.php';
require __DIR__ . '/Director.php';


function clientCode(Director $director)
{
    $builder1 = new BuilderShip1();
    $director->setBuilder($builder1);

    echo "Full Ship 1: <br>";
    $director->fullShip();
    $builder1->getShip()->listParameters();

    $builder2 = new BuilderShip2();
    $director->setBuilder($builder2);

    echo "Full Ship 2: <br>";
    $director->fullShip();
    $builder2->getShip()->listParameters();
}

$director = new Director();
clientCode($director);
