<?php

namespace Sicredi\Credeasy\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sicredi\Credeasy\Helper\RenderHtmlTrait;

class RenderSignup implements RequestHandlerInterface
{

    use RenderHtmlTrait;
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderHtml('cadastro/cadastro.php', []);

        return new Response(200, [], $html);
    }
}