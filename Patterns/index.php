<?php

declare(strict_types=1);

require __DIR__ . '/AbstractConnection.php';
require __DIR__ . '/Instagram.php';
require __DIR__ . '/Telegram.php';

$connectionTelegram = new Telegram('userT', 12345678);
echo $connectionTelegram->publish();

echo '<br>';

$connectionInstagram = new Instagram('userI', 87654321);
echo $connectionInstagram->publish();
echo 'Completed';
