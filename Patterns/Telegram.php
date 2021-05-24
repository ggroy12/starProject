<?php

declare(strict_types=1);

class Telegram extends AbstractConnection
{
    public function setMessage(): string
    {
        return 'Connection Telegram';
    }

    public function logIn(): bool
    {
        if ($this->username === 'userT' and $this->password === 12345678) {
            return true;
        } else {
            return false;
        }
    }
}