<?php

declare(strict_types=1);

class AddStrength extends Decorator
{
    public function operation(): array
    {
        $array = parent::operation();
        $array['strength'] = 2400;
        return $array;
    }
}