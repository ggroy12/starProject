<?php

declare(strict_types=1);

class Cube implements Implementation
{
    public function addColor(): string
    {
        return "Куб<br>";
    }
}