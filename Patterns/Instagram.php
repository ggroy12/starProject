<?php

declare(strict_types=1);

class Instagram extends AbstractConnection
{
    public function setMessage(): string
    {
        return 'Connection Instagram';
    }

    public function logIn(): bool
    {
        if ($this->username === 'userI' and $this->password === 87654321) {
            return true;
        } else {
            return false;
        }
    }
}