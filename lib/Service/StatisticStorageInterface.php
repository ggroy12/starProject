<?php

declare(strict_types=1);

namespace Service;

use Model\StatisticCollection;

interface StatisticStorageInterface
{
    /**
     * @return StatisticCollection
     */
    public function getStatistic(): StatisticCollection;
}