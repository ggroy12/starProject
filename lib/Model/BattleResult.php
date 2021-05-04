<?php

declare(strict_types=1);

namespace Model;

class BattleResult implements \ArrayAccess
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

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset ($this->$offset);
    }
}