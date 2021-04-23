<?php

declare(strict_types=1);

class Session
{
    private bool $startSession;

    public function __construct()
    {
        $this->startSession = $this->start();
    }

    public function start(): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return true;
        }
        return session_start();
    }

    public function set($name, $value)
    {
        return $_SESSION["$name"] = $value;
    }

    public function get($name)
    {
        return $_SESSION["$name"];
    }

    public function destroy(): bool
    {
        return session_destroy();
    }

    public function checkForEmptinessString($nameSession)
    {
        if (!isset($_SESSION["$nameSession"])) {
            $_SESSION["$nameSession"] = 0;
        }
    }

    public function checkForEmptinessArray($nameSession)
    {
        if (!isset($_SESSION["$nameSession"])) {
            $_SESSION["$nameSession"] = [];
        }
    }
}