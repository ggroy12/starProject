<?php

declare(strict_types=1);

interface StatisticsWriteInterface
{
    public function addItemInTable(
        $aWinnerId,
        $shipNameId1,
        $shipQuantity1,
        $shipStrength1,
        $shipNameId2,
        $shipQuantity2,
        $shipStrength2,
    ): void;
}