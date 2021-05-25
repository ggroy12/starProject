<?php

require __DIR__ . '/bootstrap.php';

use Service\CreateStatisticTable;
use Service\JsonFileStatisticWrite;
use Service\Pagination;
use Service\Session;

$session = new Session();

if (!empty($_POST['cleanButton'])) {
    if ($container->checkShipStorage() == 'Service\StatisticLoaderFromDatabase') {
        $recreateTable = new CreateStatisticTable($container->getPDO());
        $recreateTable->recreateTheTable();
    } elseif ($container->checkShipStorage() == 'Service\JsonFileStatisticLoader') {
        $recreateTable = new JsonFileStatisticWrite($container->getLocalFileStatisticJson());
        $recreateTable->recreateTheTable();
    }
}

if (isset($_GET['page'])) {
    $page = $_GET['page'] ?? 1;
} else {
    $page = 1;
}

$statisticLoader = $container->getStatisticStorage();
$statistic = $statisticLoader->getStatistic();
$container->readShipStorage();
?>

<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Статистика</title>
    <link href="css/style-battle-statistic.css" rel="stylesheet">
</head>
<body>
<div class="divBasic">
    <h2 class="headlines">Сухая статистика</h2>
    <?php
    /*_________________Pagination button______________*/
    $pagination = new Pagination(
        $page
    );
    $numberOfDelimiter = 0;
    $statisticReverse = $statistic->reverse();
    $statisticSlice = $statistic->slice($statisticReverse,
        $pagination->getFirstRecording(),
        $pagination->getTotalLimit(),
    );
    $statisticCount = $statistic->count($statisticSlice);
    $statisticResult = $statistic->slice(
        $statisticSlice,
        $pagination->getNumberOfFirstRecords(),
        $pagination->getLimitOnPage(),
    );
    
    if ($pagination->getBackPage() !== 0): ?>
        <a href='?page=<?php echo $pagination->getBackPage(); ?>'><< </a>
    <?php
    endif;

    for ($i = 1; $i <= $pagination->getNumberPages($statisticCount); $i++):
        if ($i == $page): ?>
            <b><a href='?page=<?php echo $i; ?>'><?php echo $i; ?></a></b>
        <?php else:  ?>
            <a href='?page=<?php echo $i; ?>'><?php echo $i; ?></a>
        <?php
        endif;
    endfor;

    if ($pagination->getOnwardPage() < $i): ?>
        <a href='?page=<?php echo $pagination->getOnwardPage(); ?>'>>> </a>
    <?php
    endif; ?>

    <table cellpadding="5" class="table">
        <tr class="tr">
            <th>⠀№⠀</th>
            <th>Номер боя</th>
            <th>Победившие корабли</th>
            <th>Первая група игравших кораблей</th>
            <th>Количество первых кораблей</th>
            <th>Оставшиеся очки прочности первых</th>
            <th>Вторая група игравших кораблей</th>
            <th>Количество вторых кораблей</th>
            <th>Оставшиеся очки прочности вторых</th>
            <th>Время битвы</th>

        </tr>
        <tr>
            <?php
            foreach ($statisticResult as $item):
            if (!empty($item)):
            $numberOfDelimiter++; ?>
        <tr>
            <td><?php echo $numberOfDelimiter; ?></td>
            <td><?php echo $item->getId(); ?></td>
            <td><?php echo $statisticLoader->transformIdToShip($item->getNameWinningShip()) ?></td>
            <td><?php echo $statisticLoader->transformIdToShip($item->getNameShip1()); ?></td>
            <td><?php echo $item->getShip1Quantity(); ?></td>
            <td><?php echo $item->getRemainingStrength1(); ?></td>
            <td><?php echo $statisticLoader->transformIdToShip($item->getNameShip2()); ?></td>
            <td><?php echo $item->getShip2Quantity(); ?></td>
            <td><?php echo $item->getRemainingStrength2(); ?></td>
            <td><?php echo $item->getTimeBattle(); ?></td>
        </tr>
        <?php endif; endforeach; ?>
        </tr>
    </table>
</div>
<div id="buttons">
    <form action="/battle-statistic.php" method="POST">
        <input type="submit" name="cleanButton" id="buttonCleanImg" title="Очистить статистику" value="Clean">
    </form>
    <a href='/index.php' title="Обратно в бой!"><img src="picture/swords.png" id="buttonBattleImg"></a>
</div>
</body>
</html>
