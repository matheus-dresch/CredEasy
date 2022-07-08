<?php

namespace Sicredi\Credeasy\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sicredi\Credeasy\Entity\Cliente;
use Sicredi\Credeasy\Helper\FlashMessageTrait;

class PerformLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();

        $cpf = $post['cpf'];
        $senha = $post['senha'];

        $cliente = $this->em->find(Cliente::class, $cpf);
        if (is_null($cliente)) {
            $this->defMessage('danger', 'CPF não encontrado');
            return new Response(200, ['location' => '/login']);
            exit();
        }

        $validate = $cliente->checkPassword($senha);
        if (! $validate) {
            $this->defMessage('danger', 'Senha incorreta');
            return new Response(200, ['location' => '/login']);
            exit();
        }

        $_SESSION['logado'] = true;
        $_SESSION['cpf'] = $cpf;
        return new Response(200, ['location' => '/dashboard']);
    }
}