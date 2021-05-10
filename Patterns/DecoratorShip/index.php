<?php
declare (strict_types=1);

require __DIR__ . '/../Decorator.php';
require __DIR__ . '/AddStrength.php';
require __DIR__ . '/AddWeaponPower.php';
require __DIR__ . '/BaseShip.php';

$baseShip = new BaseShip();
$addWeaponPower = new AddWeaponPower($baseShip);
$addStrength = new AddStrength($addWeaponPower);
print_r($addStrength->operation());

