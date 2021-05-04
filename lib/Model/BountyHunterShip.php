<?php

declare(strict_types=1);

namespace Model;

class BountyHunterShip extends AbstractShip
{
    use SettableJediFactoryTrait;

    public function getTeam(): string
    {
        return 'Bounty Hunter';
    }

    public function isFunctional(): bool
    {
        return true;
    }

}