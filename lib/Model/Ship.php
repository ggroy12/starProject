<?php

declare(strict_types=1);

namespace Model;

class Ship extends AbstractShip
{
    use SettableJediFactoryTrait;

    protected bool $underRepair;

    public function __construct(string $name, int $weaponPower = 0, int $strength = 0)
    {
        parent::__construct($name, $weaponPower, $strength);

        $this->underRepair = mt_rand(1, 100) < 30;
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
