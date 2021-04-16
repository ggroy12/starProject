<?php
ini_set('display_errors', 'on');
require __DIR__ . '/bootstrap.php';

$count = new Pagination($container->getPDO());
$pagination = new Pagination($container->getPDO());

if (!empty($_POST['cleanButton'])){
    $createTable = new CreateStatisticsTable($container->getPDO());
    $createTable->recreateTheTable();
}

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {$page = 1;}
$numberOfNextRecords = 50;
$form = ($page - 1) * $numberOfNextRecords;

$statisticsLoader = $container->getSessionLoader();
$statistics = $statisticsLoader->getSession($form, $numberOfNextRecords);
$numberOfDelimiter = 0;
?>

<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Статистика</title>
    <link href="css/style-battle-statistics.css" rel="stylesheet">
</head>
<body>
<div class="divBasic">
    <h2 class="headlines">Сухая статистика</h2>
    <?php
    /*_________________Кнопки пагинации______________*/
    $count = $count->numberOfColumnsInTable();
    $pagination->pagination($page, $count, $numberOfNextRecords);
    ?>
    <table cellpadding="5" class="table">
        <tr class="tr">
            <th width="1%">⠀№⠀</th>
            <th width="3%">Номер боя</th>
            <th width="15%">Победившие корабли</th>
            <th width="15%">Первая група игравших кораблей</th>
            <th width="11%">Количество первых кораблей</th>
            <th width="11%">Оставшиеся очки прочности первых</th>
            <th>Вторая група игравших кораблей</th>
            <th width="11%">Количество вторых кораблей</th>
            <th width="11%">Оставшиеся очки прочности вторых</th>
            <th width="">Время битвы</th>

        </tr>
        <tr>
            <?php
            foreach ($statistics as $item) {
            $numberOfDelimiter++; ?>
        <tr>
            <td><?php echo $numberOfDelimiter; ?></td>
            <td><?php echo $item->getId(); ?></td>
            <td><?php echo $item->getNameWinningShip(); ?></td>
            <td><?php echo $item->getNameShip1(); ?></td>
            <td><?php echo $item->getShip1Quantity(); ?></td>
            <td><?php echo $item->getRemainingStrength1(); ?></td>
            <td><?php echo $item->getNameShip2(); ?></td>
            <td><?php echo $item->getShip2Quantity(); ?></td>
            <td><?php echo $item->getRemainingStrength2(); ?></td>
            <td><?php echo $item->getTimeBattle(); ?></td>
        </tr>
        <?php } ?>
        </tr>
    </table>
</div>
<div id="buttons">
    <form action="battle-statistics.php" method="POST">
        <input type="submit" name="cleanButton" id="buttonCleanImg" title="Очистить статистику" value="Clean">
    </form>
    <a href='/mysite/lesson3/index.php' title="Обратно в бой!"><img src="picture/swords.png" id="buttonBattleImg" ></a>
</div>
</body>
</html>
