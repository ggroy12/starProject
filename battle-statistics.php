<?php
ini_set('display_errors', 'on');
require __DIR__ . '/bootstrap.php';

if (!empty($_POST['cleanButton'])){
    $createTable = new CreateSessionTable;
    $createTable->recreateTheTable($container->getPDO());
}

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {$page = 1;}
$numberOfNextRecords = 50;
$form = ($page - 1) * $numberOfNextRecords;
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
        //Подсчёт количества записей в таблице БД
        $count = new Pagination;
        $count = $count->numberOfColumnsInTable($container->getPDO());
        //Подсчёт нужного количества страниц на количество записей в БД
        $pagesCount = new Pagination;
        $pagesCount = $pagesCount->pagesCount($count, $numberOfNextRecords);
        //Вывод кнопок пагинации на основе даных выше
        $pagination = new Pagination;
        $pagination->pagination($page, $pagesCount);
        /*______________________________________________*/
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
                $loadingTable = new CreateSessionTable;
                $arrayResult = $loadingTable->downloadStatisticalTable($container->getPDO(), $form, $numberOfNextRecords);
                $numberAndDelimiter = 0;
                foreach ($arrayResult as $key => $item) {
                    echo '<tr>';
                    $numberAndDelimiter++;
                    echo("<td>$numberAndDelimiter</td>");
                    echo('<td>' . $item['id'] . '</td>');
                    echo('<td>' . $item['nameWinningShip'] . '</td>');
                    echo('<td>' . $item['nameShip1'] . '</td>');
                    echo('<td>' . $item['ship1Quantity'] . '</td>');
                    echo('<td>' . $item['remainingStrength1'] . '</td>');
                    echo('<td>' . $item['nameShip2'] . '</td>');
                    echo('<td>' . $item['ship2Quantity'] . '</td>');
                    echo('<td>' . $item['remainingStrength2'] . '</td>');
                    echo('<td>' . $item['timeBattle'] . '</td>');
                    echo '</tr>';
                }
                ?>
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
