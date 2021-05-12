<?php

declare(strict_types=1);

class StarEmpireShip extends AbstractShip
{
    public function getTeam(): string
    {
        return 'Star Empire';
    }

    public function descriptionTeam(): string
    {
        return 'The Galactic Empire, also known as the New Order.';
    }

}