<?php

declare(strict_types=1);

interface StatisticsStorageInterface
{
    /**
     * @return Statistic[]
     */
    public function getStatistics(): array;
}