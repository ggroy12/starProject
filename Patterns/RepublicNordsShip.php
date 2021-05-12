<?php

declare(strict_types=1);

class RepublicNordsShip extends AbstractShip
{
    public function getTeam(): string
    {
        return 'Republic Nords';
    }

    public function descriptionTeam(): string
    {
        return 'An ancient republic that has only recently been revived from the 
        ashes thanks to Emperor Imgyr.';
    }
}