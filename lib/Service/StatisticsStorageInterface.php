<?php

declare(strict_types=1);

namespace Service;

interface StatisticsStorageInterface
{
    /**
     * @return Statistic[]
     */
    public function getStatistics(): array;
}