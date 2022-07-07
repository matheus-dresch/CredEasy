<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Sicredi\Credeasy\Infra\EntityManagerFactory;

require __DIR__ . '/vendor/autoload.php';

// replace with file to your own project bootstraprequire_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerFactory::GetEntityManager();

return ConsoleRunner::createHelperSet($entityManager);