<?php
declare(strict_types=1);

class BrokenShip extends AbstractShip
{

    public function getTeam(): string
    {
        return 'Broken';
    }

    public function isFunctional(): bool
    {
        return false;
    }

    public function getJediFactor(): int
    {
        return 0;
    }
}