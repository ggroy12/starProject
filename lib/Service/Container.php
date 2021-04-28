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

    private ?StatisticsWriteInterface $statisticsWrite = null;

    private ?StatisticsStorageInterface $statisticsStorage = null;

    public function __construct(
        array $configuration
    ) {
        $this->configuration = $configuration;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function getLocalFileShipsJson(): string
    {
        return __DIR__ . '/../../resources/ships.json';
    }

    public function getLocalFileStatisticsJson(): string
    {
        return __DIR__ . "/../../resources/statistics.json";
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

            return $this->shipStorage;
        }
    }

    public function getStatisticsWrite(): StatisticsWriteInterface
//    public function getStatisticsWrite()
    {
        if ($this->statisticsWrite === null) {
//                $this->statisticsWrite = new CreateStatisticsTable($this->getPDO());
                $this->statisticsWrite = new JsonFileStatisticsWrite($this->getLocalFileStatisticsJson());

            return $this->statisticsWrite;
        }
    }

    public function getStatisticsStorage(): StatisticsStorageInterface
    {
        if ($this->statisticsStorage === null) {
//                $this->statisticsStorage = new StatisticsLoaderFromDatabase($this->getPDO());
                $this->statisticsStorage = new JsonFileStatisticsLoader(
                    $this->getLocalFileStatisticsJson(),
                    $this->getLocalFileShipsJson(),
                );

            return $this->statisticsStorage;
        }
    }

    public function readShipStorage()
    {
        $session = new Session();
        return $session->set('methodStorage', get_class($this->statisticsStorage));
    }

    public function checkShipStorage()
    {
        $chekShipStorage = new Session();
        return $chekShipStorage->get('methodStorage');
    }
}