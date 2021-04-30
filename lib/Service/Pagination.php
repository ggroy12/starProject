<?php

declare(strict_types=1);

namespace Service;

use PDO;

class Pagination
{
    private int $page;

    private int $limitOnPage = 10;

    private int $totalLimit = 50;

    public function __construct(
        int $page,
    ) {
        $this->page = $page;
    }

    public function getNumberOfFirstRecords(): int
    {
        return ($this->page - 1) * $this->limitOnPage;
    }

    public function getBackPage(): int
    {
        return ($this->page - 1);
    }

    public function getOnwardPage(): int
    {
        return ($this->page + 1);
    }

    public function getNumberPages($countNumber): float
    {
        return ceil($countNumber / $this->limitOnPage);
    }

    public function getCountNumber($array): int
    {
        $result = array_reverse($array);
        $result = array_slice($result, 0, $this->totalLimit);
        return count($result);
    }

    public function boundedStatisticArray($arr): array
    {
        $result = array_reverse($arr);
        $result = array_slice($result, 0, $this->totalLimit);
        return array_slice($result, $this->getNumberOfFirstRecords(), $this->limitOnPage);
    }
}
