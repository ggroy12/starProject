<?php

declare(strict_types=1);

class Ship extends AbstractShip
{
    protected bool $underRepair;

    protected int $jediFactor = 0;

    public function __construct(string $name, int $weaponPower = 0, int $strength = 0)
    {
        parent::__construct($name, $weaponPower, $strength);

        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function getJediFactor(): int
    {
        return $this->jediFactor;
    }

    public function setJediFactor(int $jediFactor): self
    {
        $this->jediFactor = $jediFactor;

        return $this;
    }

    public function isFunctional(): bool
    {
        return !$this->underRepair;
    }

    public function getTeam(): string
    {
        return 'Empire';
    }
}
