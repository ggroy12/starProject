<?php


class Pagination
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }
    public function numberOfColumnsInTable():string {
        $result = $this->pdo->query("SELECT COUNT(*) as count FROM battle_history");
        foreach ($result as $item) {
            return $item['count'];
        }
    }

    public function pagination(
        $page,
        $count,
        $numberOfNextRecords,
    ) {
        $pagesCount = ceil($count/$numberOfNextRecords);
        $backPage = ($page-1);
        $onwardPage = ($page+1);
        if ($backPage !== 0){
            echo "<a href='?page=$backPage'><< </a>";}
        for ($i = 1; $i <= $pagesCount; $i++){
            if ($i == $page){
                echo "<b><a href='?page=$i'>$i </a></b>";
            }
            else {
                echo "<a href='?page=$i'>$i </a>";
            }
        }
        if ($onwardPage < $i){
            echo "<a href='?page=$onwardPage'>>> </a>";
        }
    }
}
