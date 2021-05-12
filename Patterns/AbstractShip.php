<?php

declare(strict_types=1);

abstract class AbstractShip
{
    protected ?int $id = null;

    protected string $name;

    protected int $weaponPower = 0;

    protected int $strength = 0;

    protected string $team;

    public function __construct(?int $id, string $name, int $weaponPower, int $strength)
    {
        $this->id = $id;
        $this->name = $name;
        $this->weaponPower = $weaponPower;
        $this->strength = $strength;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    public function setWeaponPower(int $weaponPower): void
    {
        $this->weaponPower = $weaponPower;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }

    abstract protected function getTeam(): string;

    abstract protected function descriptionTeam(): string;
}