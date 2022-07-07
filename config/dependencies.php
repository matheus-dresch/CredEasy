<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Sicredi\Credeasy\Infra\EntityManagerFactory;

$container = new ContainerBuilder();

$container->addDefinitions([
    EntityManagerInterface::class => function () {
        return EntityManagerFactory::GetEntityManager();
    }
]);

return $container->build();