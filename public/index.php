<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface;

session_start();

$dir = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home';

$freeRoutes = [
    '/home',
    '/login',
    '/signup',
    '/recover',
    '/do-login',
    '/do-signup'
];

if (! isset($_SESSION['logado']) && ! in_array($dir, $freeRoutes)) {
    header('location: /login');
}

$routes = require __DIR__ . '/../config/routes.php';

if (! key_exists($dir, $routes)) {
    http_response_code(404);
    exit();
}

$route = $routes[$dir];

$container = require __DIR__ . '/../config/dependencies.php';

/** @var RequestHandlerInterface $controller */
$controller = $container->get($route);

$psr17Factory = new Psr17Factory(); //psr 17 7

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory 
);

$serverRequest = $creator->fromGlobals();

$response = $controller->handle($serverRequest);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();