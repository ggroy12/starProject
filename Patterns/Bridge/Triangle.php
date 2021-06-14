<?php

declare(strict_types=1);

class Triangle implements Implementation
{
    public function addColor(): string
    {
        return "Треугольник<br>";
    }
}