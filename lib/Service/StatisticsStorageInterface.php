<?php

declare(strict_types=1);

namespace Service;

use Model\Statistic;

interface StatisticsStorageInterface
{
    /**
     * @return Statistic[]
     */
    public function getStatistics(): array;
}