<?php

declare(strict_types=1);

class Generators
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function convert($size): string
    {
        $until = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');

        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . '' . $until[$i];
    }

    public function getRecords($limit)
    {
        $timeStart = microtime(true);
        $step = 0;

        while (true) {
            $firstRecord = ($step * $limit);
            $statement = $this->pdo->query(
                "SELECT * FROM random_records limit $firstRecord, $limit"
            );

            $statement->execute();
            if ($statement->rowCount() === 0){
                break;
            }

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                yield $row;
            }
            $step++;
        }

        echo $this->convert(memory_get_usage()) . "\n";
        $timeEnd = microtime(true);
        echo ($timeEnd - $timeStart) . ' seconds' . "\n";
    }
}