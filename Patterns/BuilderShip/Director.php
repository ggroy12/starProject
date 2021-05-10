<?php

declare(strict_types=1);

class Director
{
    /**
     * @var BuilderShipInterface
     */
    private $builder;

    public function setBuilder(BuilderShipInterface $builder): void
    {
        $this->builder = $builder;
    }

    public function offName(): void
    {
        $this->builder->name();
    }

    public function offStrength(): void
    {
        $this->builder->strength();
    }

    public function offWeaponPower(): void
    {
        $this->builder->weaponPower();
    }

    public function fullShip(): void
    {
        $this->builder->name();
        $this->builder->strength();
        $this->builder->weaponPower();
    }
}