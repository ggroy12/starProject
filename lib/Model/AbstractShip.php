<?php


abstract class AbstractShip
{
    protected ?int $id = null;

    protected string $name;

    protected int $weaponPower = 0;

    protected int $strength = 0;

    protected string $team;

    public function __construct(
        string $name,
        int $weaponPower = 0,
        int $strength = 0
    ) {
        $this->name = $name;
        $this->weaponPower = $weaponPower;
        $this->strength = $strength;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    public function setWeaponPower(int $weaponPower): self
    {
        $this->weaponPower = $weaponPower;
        return $this;
    }

    public function getNameAndSpecs(bool $useShortSpec = true): string
    {
        if ($useShortSpec) {
            return sprintf(
                '%s %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->getJediFactor(),
                $this->strength
            );
        }

        return sprintf(
            '%s (w:%s, j:%s, s:%s)',
            $this->name,
            $this->weaponPower,
            $this->getJediFactor(),
            $this->strength
        );
    }

    public function setTeam(string $team): self
    {
        $this->team = $team;

        return $this;
    }

    abstract public function getTeam(): string;

    abstract public function isFunctional(): bool;

    abstract public function getJediFactor(): int;
}