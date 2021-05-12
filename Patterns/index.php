<?php

declare(strict_types=1);

require __DIR__ . '/AbstractShip.php';
require __DIR__ . '/StarEmpireShip.php';
require __DIR__ . '/RepublicNordsShip.php';

$starEmpireShip = new StarEmpireShip(1, 'Star Ship', 65, 1500);
$nordsCrusaderShip = new RepublicNordsShip(1, 'Crusader Ship', 88, 1200);

echo $starEmpireShip->getTeam() . '<br>';
echo $starEmpireShip->descriptionTeam() . '<br>';

echo $nordsCrusaderShip->getTeam() . '<br>';
echo $nordsCrusaderShip->descriptionTeam() . '<br>';


