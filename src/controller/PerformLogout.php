<?php

namespace Sicredi\Credeasy\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PerformLogout implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();
        return new Response(200, ['location' => '/login']);
    }
}