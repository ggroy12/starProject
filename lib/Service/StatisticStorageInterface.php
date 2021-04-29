<?php

declare(strict_types=1);

namespace Service;

use Model\Statistic;

interface StatisticStorageInterface
{
    /**
     * @return Statistic[]
     */
    public function getStatistic(): array;
}