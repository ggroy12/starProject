<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require __DIR__ . '/Implementation.php';
require __DIR__ . '/AbstractColor.php';
require __DIR__ . '/Blue.php';
require __DIR__ . '/Red.php';
require __DIR__ . '/Cube.php';
require __DIR__ . '/Triangle.php';

function clientCode(AbstractColor $abstraction)
{
    echo $abstraction->addColor();
}

$cube = new Cube();
$triangle = new Triangle();

$blueCube = new Blue($cube);
clientCode($blueCube);
echo "<br>";
$redCube = new Red($cube);
clientCode($redCube);
echo "<br>";
$blueTriangle = new Blue($triangle);
clientCode($blueTriangle);
echo "<br>";
$redTriangle = new Red($triangle);
clientCode($redTriangle);

