<?php

declare(strict_types=1);

namespace Service;

use Model\ShipCollection;
use Model\StatisticCollection;
use PDO;

class Pagination
{
    private int $page;

    private int $limitOnPage = 10;

    private int $firstRecording = 0;

    private int $totalLimit = 50;

    public function __construct(
        int $page,
    ) {
        $this->page = $page;
    }

    public function getLimitOnPage(): int
    {
        return $this->limitOnPage;
    }

    public function getFirstRecording(): int
    {
        return $this->firstRecording;
    }

    public function getTotalLimit(): int
    {
        return $this->totalLimit;
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
}
