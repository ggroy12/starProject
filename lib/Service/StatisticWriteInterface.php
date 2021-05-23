<?php

declare(strict_types=1);

namespace Service;

interface StatisticWriteInterface
{
    public function add(
        $aWinnerId,
        $shipNameId1,
        $shipQuantity1,
        $shipStrength1,
        $shipNameId2,
        $shipQuantity2,
        $shipStrength2,
    ): void;
}