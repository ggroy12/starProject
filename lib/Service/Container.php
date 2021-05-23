<?php

declare(strict_types=1);

namespace Service;

use PDO;

class Container
{
    private array $configuration;

    private ?PDO $pdo = null;

    private ?BattleManager $battleManager = null;

    private ?ShipLoader $shipLoader = null;

    private ?ShipStorageInterface $shipStorage = null;

    private ?StatisticWriteInterface $statisticWrite = null;

    private ?StatisticStorageInterface $statisticStorage = null;

    public function __construct(
        array $configuration,
    ) {
        $this->configuration = $configuration;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_password'],
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function getLocalFileShipsJson(): string
    {
        return __DIR__ . $this->configuration['localFileShipsJson'];
    }

    public function getLocalFileStatisticJson(): string
    {
        return __DIR__ . $this->configuration['localFileStatisticJson'];
    }

    public function getBattleManager(): BattleManager
    {
        if ($this->battleManager === null) {
            $this->battleManager = new BattleManager();
        }

        return $this->battleManager;
    }

    public function getShipLoader(): ShipLoader
    {
        if ($this->shipLoader === null) {
            $this->shipLoader = new ShipLoader($this->getShipStorage());
        }

        return $this->shipLoader;
    }

    public function getShipStorage(): ShipStorageInterface
    {
        if ($this->shipStorage === null) {
            $this->shipStorage = new PdoShipStorage($this->getPDO());
//            $this->shipStorage = new JsonFileShipStorage($this->getLocalFileShipsJson());
        }

        return $this->shipStorage;
    }

    public function getStatisticWrite(): StatisticWriteInterface
//    public function getStatisticWrite()
    {
        if ($this->statisticWrite === null) {
//                $this->statisticWrite = new CreateStatisticTable($this->getPDO());
            $this->statisticWrite = new JsonFileStatisticWrite($this->getLocalFileStatisticJson());
        }

        return $this->statisticWrite;
    }

    public function getStatisticStorage(): StatisticStorageInterface
    {
        if ($this->statisticStorage === null) {
//                $this->statisticStorage = new StatisticLoaderFromDatabase($this->getPDO());
            $this->statisticStorage = new JsonFileStatisticLoader(
                $this->getLocalFileStatisticJson(),
                $this->getLocalFileShipsJson(),
            );
        }

        return $this->statisticStorage;
    }

    public function readShipStorage()
    {
        $session = new Session();
        return $session->set('methodStorage', get_class($this->statisticStorage));
    }

    public function checkShipStorage()
    {
        $chekShipStorage = new Session();
        return $chekShipStorage->get('methodStorage');
    }
}