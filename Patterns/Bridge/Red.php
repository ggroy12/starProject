<?php

declare(strict_types=1);

class Red extends AbstractColor
{
    public function addColor(): string
    {
        {
            return "Красный<br>" .
                $this->figure->addColor();
        }
    }
}