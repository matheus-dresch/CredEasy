<?php

namespace Sicredi\Credeasy\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public static function GetEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../..';
        $paths = [$rootDir . '/src/entity'];

        $config = ORMSetup::createAnnotationMetadataConfiguration($paths);

        $driver = [
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'dbname' => 'credeasy',
            'user' => 'root',
            'password' => 'root'
        ];

        return EntityManager::create($driver, $config);
    }
}