<?php

declare(strict_types=1);

abstract class AbstractConnection
{
    protected string $username;

    protected int $password;

    public function __construct(string $username, int $password)
    {
        $this->username = $username;
        $this->password = $password;
    }


    public function publish(): string
    {
        if ($this->logIn() === true) {
            return $this->setMessage() . '<br>';
        } else {
            return 'Не верный логин или пароль';
        }
    }

    abstract public function setMessage(): string;

    abstract public function logIn(): bool;
}