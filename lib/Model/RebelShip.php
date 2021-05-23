<?php

declare(strict_types=1);

namespace Model;

class RebelShip extends AbstractShip
{
    public function getFavoriteJedi(): string
    {
        $jedis = ['Yoda', 'Ben Kenobi'];
        $key = array_rand($jedis);

        return $jedis[$key];
    }

    public function getTeam(): string
    {
        return 'Rebel';
    }

    public function isFunctional(): bool
    {
        return true;
    }

    public function getNameAndSpecs(bool $useShortSpec = true): string
    {
        $spec = parent::getNameAndSpecs($useShortSpec);
        $spec .= ' (Rebel)';

        return $spec;
    }

    public function getJediFactor(): int
    {
        return mt_rand(10, 30);
    }
}