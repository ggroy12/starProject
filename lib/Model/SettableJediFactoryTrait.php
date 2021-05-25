<?php

declare(strict_types=1);

namespace Model;

trait SettableJediFactoryTrait
{
    private int $jediFactor;

    public function getJediFactor(): int
    {
        return $this->jediFactor;
    }

    public function setJediFactor(int $jediFactor): void
    {
        $this->jediFactor = $jediFactor;
    }
}