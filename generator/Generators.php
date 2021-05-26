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

    public function getRecords($limit = 0, $firstRecords = 0): Generator
    {

        $statement = $this->pdo->query(
            "SELECT * FROM random_records limit $firstRecords, $limit"
        );
        $statement->execute();
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $item) {
            yield $item;
        }
    }
}