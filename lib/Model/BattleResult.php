<?php

declare(strict_types=1);

class BattleResult
{
    private ?AbstractShip $winningShip;

    private ?AbstractShip $losingShip;

    private bool $usedJediPowers;

    public function __construct(
        ?AbstractShip $winningShip,
        ?AbstractShip $losingShip,
        bool $usedJediPowers
    ) {
        $this->winningShip = $winningShip;
        $this->losingShip = $losingShip;
        $this->usedJediPowers = $usedJediPowers;
    }

    public function getWinningShip(): ?AbstractShip
    {
        return $this->winningShip;
    }

    public function getLosingShip(): ?AbstractShip
    {
        return $this->losingShip;
    }

    public function isUsedJediPowers(): bool
    {
        return $this->usedJediPowers;
    }

    public function isHereAWinner(): bool
    {
        return $this->winningShip !== null;
    }
}