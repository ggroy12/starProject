<?php

declare(strict_types=1);

class AddWeaponPower extends Decorator
{
    public function operation(): array
    {
        $array = parent::operation();
        $array['weaponPower'] = 45;
        return $array;
    }

}