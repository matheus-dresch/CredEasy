<?php

namespace Sicredi\Credeasy\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sicredi\Credeasy\Entity\Cliente;
use Sicredi\Credeasy\Helper\FlashMessageTrait;
use Sicredi\Credeasy\Repository\ClienteRepository;

class PerformSignup implements RequestHandlerInterface
{

    use FlashMessageTrait;

    /** @var ClienteRepository $em */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();

        [
            'nome' => $nome,
            'cpf' => $cpf,
            'numero' => $numero,
            'profissao' => $profissao,
            'renda' => $renda,
            'email' => $email,

            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'bairro' => $bairro,
            'rua' => $rua,
            'numcasa' => $numcasa,

            'senha' => $senha
        ] = $post;

        $endereco = "$estado, $cidade - $cep, $bairro, $rua, $numcasa";

        $renda = preg_replace('/[\D]/', '', $renda);
        $renda = floatval($renda) / 100;

        $cliente = new Cliente(
            $cpf,
            $nome,
            $numero,
            $endereco,
            $profissao,
            $renda,
            $email,
            password_hash($senha, PASSWORD_ARGON2I)
        );

        $this->em->persist($cliente);
        $this->em->flush();

        return new Response(300, ['location' => '/login']);
    }
}