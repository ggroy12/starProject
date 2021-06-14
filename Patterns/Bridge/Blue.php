<?php

declare(strict_types=1);

class Blue extends AbstractColor
{
    public function addColor(): string
    {
        return "Синий<br>" .
            $this->figure->addColor();
    }
}