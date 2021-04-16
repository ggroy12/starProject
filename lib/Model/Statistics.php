<?php
declare(strict_types=1);

class Statistics
{
    private int $id;

    private string $nameWinningShip;

    private string $nameShip1;

    private int $ship1Quantity = 0;

    private int $remainingStrength1 = 0;

    private string $nameShip2;

    private int $ship2Quantity = 0;

    private int $remainingStrength2 = 0;

    private string $timeBattle;

    public function __construct(
        int $id,
        string $nameWinningShip,
        string $nameShip1,
        int $ship1Quantity,
        int $remainingStrength1,
        string $nameShip2,
        int $ship2Quantity,
        int $remainingStrength2,
        string $timeBattle
    ){
        $this->id = $id;
        $this->nameWinningShip = $nameWinningShip;
        $this->nameShip1 = $nameShip1;
        $this->ship1Quantity = $ship1Quantity;
        $this->remainingStrength1 = $remainingStrength1;
        $this->nameShip2 = $nameShip2;
        $this->ship2Quantity = $ship2Quantity;
        $this->remainingStrength2 = $remainingStrength2;
        $this->timeBattle = $timeBattle;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNameWinningShip(): string
    {
        return $this->nameWinningShip;
    }

    public function getNameShip1(): string
    {
        return $this->nameShip1;
    }

    public function getShip1Quantity(): int
    {
        return $this->ship1Quantity;
    }

    public function getRemainingStrength1(): int
    {
        return $this->remainingStrength1;
    }

    public function getNameShip2(): string
    {
        return $this->nameShip2;
    }

    public function getShip2Quantity(): int
    {
        return $this->ship2Quantity;
    }

    public function getRemainingStrength2(): int
    {
        return $this->remainingStrength2;
    }

    public function getTimeBattle(): string
    {
        return $this->timeBattle;
    }
}